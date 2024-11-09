<div>
    <div style="max-width: 500px; height: auto">

        <canvas id="tortaGrafica"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    <script>
        var data = {
            labels: {!! json_encode($companias) !!}, // Convierte el array de compañías a formato JSON
            datasets: [{

                data: {!! json_encode($tortaCounts) !!}, // Convierte los valores de tortaCounts a formato JSON
                backgroundColor: [
                    '#048BD0', '#FF6384', '#36A2EB', '#FFCE56', '#75C1E6', '#FF9F40'
                ],
                borderColor: [
                    'rgba(255, 255, 255)', 'rgba(255, 255, 255)', 'rgba(255, 255, 255)', 'rgba(255, 255, 255)',
                    'rgba(255, 255, 255)', 'rgba(255, 255, 255)'
                ],
                borderWidth: 5, // Ancho del borde del anillo exterior
                hoverOffset: 10, // Separación al hacer hover
            }]
        };

        var ctx = document.getElementById('tortaGrafica').getContext('2d');
        var myPieChart = new Chart(ctx, {
            type: 'doughnut', // Tipo de gráfico
            data: data,
            options: {
                cutoutPercentage: 70, // Porcentaje de hueco en el medio
                plugins: {
                    datalabels: {
                        color: 'white', // Color del texto de las etiquetas
                        anchor: 'end',
                        align: 'end',
                        offset: 10,
                    }
                }
            }
        });
    </script>
</div>
