<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sustainity</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    @vite(['resources/css/nosotros.css'])
    @vite('resources/js/script.js')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <div class="container">
        <h2>Análisis de Sentimientos - Sustainity</h2>

        <div class="row">
            @foreach ($results as $question => $data)
                <div class="col-md-6 my-4">
                    <div class="card">
                        <div class="card-header">
                            <strong>{{ $question }}</strong>
                        </div>
                        <div class="card-body">
                            <p>Positivas: {{ $data['positive'] }}</p>
                            <p>Negativas: {{ $data['negative'] }}</p>
                            <p>Porcentaje positivo: {{ $data['percentage'] }}%</p>

                            <div class="progress mb-3">
                                <div class="progress-bar bg-success" role="progressbar"
                                    style="width: {{ $data['percentage'] }}%">
                                    {{ $data['percentage'] }}%
                                </div>
                            </div>

                            <canvas id="barChart_{{ $loop->index }}" height="80" style="max-height: 200px;"></canvas>
                            <canvas id="pieChart_{{ $loop->index }}" height="80" class="mt-3"
                                style="max-height: 200px;"></canvas>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="global-evaluation mt-5 p-4 rounded" style="background-color:rgb(8, 9, 10); border-left: 5px solid #4CAF50;">
        <h3 class="mb-3">Evaluación General del Proyecto</h3>
        <p class="mb-0">{{ $evaluationText }}</p>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <a href="#">Política de Privacidad</a> |
            <a href="#">Términos y Condiciones</a> |
            <a href="#">Contacto</a>
        </div>
        <p>&copy; 2024 Sustainity. Todos los derechos reservados.</p>
    </footer>

    <script>
        @foreach ($results as $question => $data)
            const barCtx{{ $loop->index }} = document.getElementById('barChart_{{ $loop->index }}').getContext('2d');
            new Chart(barCtx{{ $loop->index }}, {
                type: 'bar',
                data: {
                    labels: ['Positivas', 'Negativas'],
                    datasets: [{
                        label: 'Cantidad de respuestas',
                        data: [{{ $data['positive'] }}, {{ $data['negative'] }}],
                        backgroundColor: ['#28a745', '#dc3545']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                        title: { display: true, text: 'Respuestas por tipo' }
                    }
                }
            });

            const pieCtx{{ $loop->index }} = document.getElementById('pieChart_{{ $loop->index }}').getContext('2d');
            new Chart(pieCtx{{ $loop->index }}, {
                type: 'pie',
                data: {
                    labels: ['Positivas', 'Negativas'],
                    datasets: [{
                        data: [{{ $data['positive'] }}, {{ $data['negative'] }}],
                        backgroundColor: ['#28a745', '#dc3545']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: { display: true, text: 'Distribución de Sentimientos' }
                    }
                }
            });
        @endforeach
    </script>

</body>

</html>