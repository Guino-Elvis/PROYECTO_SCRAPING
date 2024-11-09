<div>
    <div style="max-width: 700px; height: auto">
        <canvas id="barrasGrafica"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var ctx = document.getElementById('barrasGrafica').getContext('2d');

        var data = {
            labels: {!! json_encode($companias) !!}, // Etiquetas para las compañías
            datasets: [{
                label: 'Ofertas Laborales por Compañía',
                data: {!! json_encode($ofertasPorCompania) !!}, // Datos de ofertas por compañía
                backgroundColor: '#048BD0', // Color de las barras
                borderColor: '#005BB5', // Color del borde de las barras
                borderWidth: 1 // Ancho del borde de las barras
            }]
        };

        var myBarChart = new Chart(ctx, {
            type: 'bar', // Tipo de gráfico
            data: data,
            options: {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Compañías'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Número de Ofertas'
                        }
                    }
                }
            }
        });
    </script>
</div>
