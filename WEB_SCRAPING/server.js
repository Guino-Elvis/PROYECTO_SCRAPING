const express = require('express');
const bodyParser = require('body-parser');
const cors = require('cors');
const puppeteer = require('puppeteer');
const randomUseragent = require('random-useragent');
const mysql = require('mysql2'); // Importa mysql2
const db = require('./db'); // Importa la conexión a la base de datos
const moment = require('moment');

const app = express();

// Configura CORS para permitir solicitudes desde cualquier origen
app.use(cors());

app.use(bodyParser.json()); // Asegúrate de usar el middleware para manejar JSON
app.use(express.static('public')); // Servir archivos estáticos como HTML

let scrapingProcess = null; // Variable para almacenar el proceso de scraping
let cancelScraping = false; // Variable para controlar la cancelación del scraping

const convertirFecha = (fecha) => {
    return moment(fecha, 'DD-MM-YYYY').format('YYYY-MM-DD');
};

const delay = (ms) => new Promise(resolve => setTimeout(resolve, ms));

// Asegura que la conexión a la base de datos esté activa
const ensureDbConnection = () => {
    return new Promise((resolve, reject) => {
        db.query('SELECT 1', (err) => {
            if (err) {
                console.log('Conexión perdida. Creando una nueva conexión...');
                db.end(() => {
                    // Nota: La conexión se reiniciará automáticamente cuando se vuelva a necesitar
                    resolve(); // En caso de error, se maneja en el lugar donde se usa
                });
            } else {
                resolve(); // La conexión está activa
            }
        });
    });
};

const insertDataIntoDB = async (data, uploadedFile) => {
    try {
        await ensureDbConnection(); // Asegura la conexión antes de insertar

        // Crea un array de promesas para cada fila
        const insertPromises = data.map(async (row) => {
            try {
                // 1. Inserta la categoría
                const queryCategoria = `
                    INSERT INTO categories (name, slug, user_id, created_at)
                    VALUES (?, ?, ?, ?)
                `;

                const categoriaValues = [
                    row.categoria,
                    row.slug,
                    row.user_id,
                    row.created_at,
                ];

                const categoriaResult = await new Promise((resolve, reject) => {
                    db.query(queryCategoria, categoriaValues, (err, results) => {
                        if (err) {
                            console.error('Error insertando la categoría:', err);
                            reject(err);
                        } else {
                            console.log('Categoría insertada con éxito:', results);
                            resolve(results.insertId);
                        }
                    });
                });

                // 2. Inserta la empresa
                const queryEmpresa = `
                    INSERT INTO empresas (ra_social, ruc, direccion, telefono, correo, whatsap, category_id, user_id, created_at)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
                `;
                const empresaValues = [
                    row.nombreempresa,
                    row.ruc,
                    row.direccion,
                    row.telefono,
                    row.correo,
                    row.image,
                    categoriaResult, // ID de la categoría
                    row.user_id,
                    row.created_at,
                ];

                const empresaResult = await new Promise((resolve, reject) => {
                    db.query(queryEmpresa, empresaValues, (err, results) => {
                        if (err) {
                            console.error('Error insertando la empresa:', err);
                            reject(err);
                        } else {
                            console.log('Empresa insertada con éxito:', results);
                            resolve(results.insertId);
                        }
                    });
                });

                // 3. Inserta la oferta laboral con los IDs de la categoría y la empresa
                const queryOfertaLaboral = `
                    INSERT INTO oferta_laborals (titulo, ubicacion, remuneracion, descripcion, body, fecha_inicio, fecha_fin, state, limite_postulante, empresa_id, user_id, created_at)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                `;
                const ofertaValues = [
                    row.titulo,
                    row.ubicacion,
                    row.remuneracion,
                    row.descripcion,
                    row.body,
                    row.fecha_inicio,
                    row.fecha_fin,
                    row.state,
                    row.limite_postulante,
                    empresaResult, // ID de la empresa
                    row.user_id,
                    row.created_at,
                ];

                const ofertaResult = await new Promise((resolve, reject) => {
                    db.query(queryOfertaLaboral, ofertaValues, (err, results) => {
                        if (err) {
                            console.error('Error insertando la oferta laboral:', err);
                            reject(err);
                        } else {
                            console.log('Oferta laboral insertada con éxito:', results);
                            resolve({ id: results.insertId, ...row });
                        }
                    });
                });

                return ofertaResult; // Retorna los resultados de la oferta laboral para ser almacenados
            } catch (err) {
                console.error('Error al procesar una fila:', err);
                throw err; // Lanza error para que lo capture Promise.all
            }
        });

        // Espera a que todas las promesas se resuelvan
        const insertResults = await Promise.all(insertPromises);
        console.log('Resultados de la inserción:', insertResults);
        return insertResults;

    } catch (err) {
        console.error('Error al insertar datos en la base de datos:', err);
    }
};

const processPage = async (page, url) => {
    console.log('Visitando página ==>', url);
    await page.goto(url, { waitUntil: 'networkidle2' });

    const jobSelector = '.sc-bXLHrc'; // Cambia esto según el selector adecuado de la página
    try {
        await page.waitForSelector(jobSelector, { timeout: 5000 });
    } catch (error) {
        console.log(`No se encontraron resultados en la página ${url}. Deteniendo...`);
        return false;
    }

    const listaDeItems = await page.$$('.sc-izRtNG');
    let pageData = [];

    // Función para obtener la fecha actual en formato timestamp
    const fecha_hoy = () => {
        return moment().format('YYYY-MM-DD HH:mm:ss');
    };

    const generarNumeroAleatorio = () => {
        return Math.floor(Math.random() * 9000) + 1000; // Genera un número aleatorio entre 1000 y 9999
    };


    const generarCorreoAleatorio = () => {
        const caracteres = 'abcdefghijklmnopqrstuvwxyz0123456789';
        let nombreUsuario = '';
        for (let i = 0; i < 8; i++) { // Puedes cambiar el 8 por la longitud que desees para el nombre de usuario
            nombreUsuario += caracteres.charAt(Math.floor(Math.random() * caracteres.length));
        }

        const dominio = 'example.com'; // Puedes cambiar esto por el dominio que prefieras
        return `${nombreUsuario}@${dominio}`;
    };

    const generarOpcionAleatoria = () => {
        const opciones = ["Hibrido", "Remoto", "Presencial"];
        const indiceAleatorio = Math.floor(Math.random() * opciones.length); // Genera un índice aleatorio
        return opciones[indiceAleatorio]; // Devuelve la opción correspondiente
    };


    const fecha_requerida = fecha_hoy(); // Llama a la función para obtener la fecha actual
    const remuneracion_requerida = generarNumeroAleatorio();
    const categoria_requerida = generarOpcionAleatoria();
    const correo_requerido = generarCorreoAleatorio();

    for (const item of listaDeItems) {
        console.log("Procesando item...", item); // Para saber si entra al ciclo.
        //categoria
        const categoria_requerida = generarOpcionAleatoria();
        const slug = categoria_requerida;

        //end categoria

        //empresa
        const nombreempresa = await item.$(".sc-eCXBzT h3");
        const ruc = await item.$(".dIB.mr10");
        const direccion = await item.$(".sc-gkfylT h3");
        const telefono = await item.$(".dIB.mr10");
        const correo = generarCorreoAleatorio();
        //end empresa

        //oferta
        const titulo = await item.$(".sc-jFpLkX h3");
        const ubicacion = await item.$(".sc-gkfylT h3");
        const remuneracion = generarNumeroAleatorio();
        const descripcion = await item.$(".sc-jFpLkX h3");
        const body = await item.$(".sc-hfLElm p");
        const fecha_inicio = await item.$(".dIB.mr10");
        const fecha_fin = await item.$(".dIB.mr10");
        const state = await item.$(".dIB.mr10");
        const limite_postulante = await item.$(".dIB.mr10");
        //end oferta

        //campo por defecto
        const user_id = await item.$(".dIB.mr10");
        const created_at = fecha_requerida; // Asigna directamente la fecha actual
        const image = await item.$(".sc-fGSyRc img");
        // end campo por efecto
        // Nuevos campos





        //categoria
        // const getCategoria = await page.evaluate(el => el ? el.innerText : 'N/A', categoria);
        // const getSlug = await page.evaluate(el => el ? el.innerText : 'N/A', slug);
        // end categoria

        //empresa
        const getNombreempresa = await page.evaluate(el => el ? el.innerText : 'N/A', nombreempresa);
        const getRuc = await page.evaluate(el => el ? el.innerText : '74321221', ruc);
        const getDireccion = await page.evaluate(el => el ? el.innerText : 'N/A', direccion);
        const getTelefono = await page.evaluate(el => el ? el.innerText : '916545454', telefono);
        // const getCorreo = await page.evaluate(el => el ? el.innerText : 'empresa@gmail.com', correo);
        //end empresa

        // oferta
        const getTitulo = await page.evaluate(el => el ? el.innerText : 'N/A', titulo);
        const getUbicacion = await page.evaluate(el => el ? el.innerText : 'N/A', ubicacion);
        // const getRemuneracion = await page.evaluate(el => el ? el.innerText : 's/. 2500', remuneracion);
        const getDescripcion = await page.evaluate(el => el ? el.innerText : 'N/A', descripcion);
        const getBody = await page.evaluate(el => el ? el.innerText : 'N/A', body);
        const getFechaInicio = convertirFecha(await page.evaluate(el => el ? el.innerText : '02-09-2024', fecha_inicio));
        const getFechaFin = convertirFecha(await page.evaluate(el => el ? el.innerText : '15-09-2024', fecha_fin));
        const getState = await page.evaluate(el => el ? el.innerText : '2', state);
        const getLimitePostulante = await page.evaluate(el => el ? el.innerText : 'N/A', limite_postulante);
        //end oferta

        // campos clasicos
        const getImage = await page.evaluate(el => el ? el.getAttribute('src') : 'N/A', image);
        const getUserId = await page.evaluate(el => el ? el.innerText : '2', user_id);
        // end campos clasicos

        pageData.push({
            //Categoria
            categoria: categoria_requerida,
            slug: categoria_requerida,
            //end cateogoria

            //empresa
            nombreempresa: getNombreempresa,
            ruc: getRuc,
            direccion: getDireccion,
            telefono: getTelefono,
            correo: correo,
            //end empresa

            //oferta
            titulo: getTitulo,
            ubicacion: getUbicacion,
            remuneracion: remuneracion,
            descripcion: getDescripcion,
            body: getBody,
            fecha_inicio: getFechaInicio,
            fecha_fin: getFechaFin,
            state: getState,
            limite_postulante: getLimitePostulante,
            //end oferta

            //campos especiales
            image: getImage,
            user_id: getUserId,
            created_at: created_at,
            // end campos especiales

        });
    }

    await insertDataIntoDB(pageData);
    console.log(`Datos de la página ${url} insertados en la base de datos.`);

    await delay(2000);

    return !cancelScraping; // Si se canceló, no hay más páginas
};

app.post('/start-scraping', async (req, res) => {
    const { link_web } = req.body;

    console.log('Enlace recibido:', link_web);

    if (!link_web || !link_web.startsWith('https://www.bumeran.com.pe/')) {
        return res.status(400).send('Link incorrecto');
    }

    if (scrapingProcess) {
        return res.status(400).send('El scraping ya está en curso.');
    }

    cancelScraping = false;
    scrapingProcess = (async () => {
        await ensureDbConnection(); // Asegura la conexión antes de iniciar el scraping

        const browser = await puppeteer.launch({
            headless: true,
            ignoreHTTPSErrors: true
        });

        const page = await browser.newPage();
        const header = randomUseragent.getRandom((ua) => ua.browserName === 'Firefox');
        await page.setUserAgent(header);
        await page.setViewport({ width: 1920, height: 1080 });

        let pageNumber = 1;
        let hasMorePages = true;

        while (hasMorePages && !cancelScraping) {
            const currentUrl = `${link_web}empleos.html?page=${pageNumber}`;
            console.log('URL actual:', currentUrl);
            hasMorePages = await processPage(page, currentUrl);

            if (hasMorePages) {
                pageNumber++;
            } else {
                console.log('No se encontraron más páginas para procesar.');
            }
        }

        await page.close();
        await browser.close();
        //   db.end();

        scrapingProcess = null; // Restablece el estado del proceso
        return 'Scraping completado';
    })();

    const result = await scrapingProcess;
    res.send(result);
});

app.post('/stop-scraping', (req, res) => {
    if (scrapingProcess) {
        cancelScraping = true;
        res.send('Scraping detenido');
    } else {
        res.status(400).send('No hay proceso de scraping en curso');
    }
});

app.post('/shutdown-server', (req, res) => {
    res.send('Servidor apagándose...');
    process.exit(0); // Apaga el servidor
});

app.listen(3000, () => {
    console.log('Servidor escuchando en el puerto 3000');
});
