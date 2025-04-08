<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use App\Services\PerceptronClassifier;

class SentimentController extends Controller
{
    public function index()
    {
        $classifier = new PerceptronClassifier();
        $filePath = storage_path('app/data/responses.json');
        
        // Verificación robusta del archivo
        if (!File::exists($filePath)) {
            abort(404, "El archivo de respuestas no existe");
        }
        
        $jsonContent = File::get($filePath);
        $responses = json_decode($jsonContent, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            abort(500, "Error al decodificar el JSON: " . json_last_error_msg());
        }

        $results = [];
        $totalPositive = 0;
        $totalResponses = 0;

        foreach ($responses as $question => $answers) {
            if (!is_array($answers)) {
                continue;
            }
            
            $questionStats = ['positive' => 0, 'negative' => 0, 'total' => 0];

            foreach ($answers as $answer) {
                if (!is_string($answer) || empty(trim($answer))) {
                    continue;
                }
                
                $analysis = $classifier->analyzeText($answer);
                $questionStats['positive'] += $analysis['positive'];
                $questionStats['negative'] += $analysis['negative'];
                $questionStats['total'] += $analysis['total'];
            }

            $results[$question] = [
                'positive' => $questionStats['positive'],
                'negative' => $questionStats['negative'],
                'percentage' => $questionStats['total'] > 0 
                    ? round(($questionStats['positive'] / $questionStats['total']) * 100, 2)
                    : 0,
                'total_responses' => count($answers),
                'processed_responses' => $questionStats['total']
            ];

            // Acumular para el total global
            $totalPositive += $questionStats['positive'];
            $totalResponses += $questionStats['total'];
        }

        // Calcular porcentaje global
        $globalPercentage = $totalResponses > 0 ? round(($totalPositive / $totalResponses) * 100, 2) : 0;

        // Generar evaluación textual
        $evaluationText = $this->generateEvaluationText($globalPercentage);

        return view('sentiment.index', compact('results', 'evaluationText'));
    }

    private function generateEvaluationText($percentage)
    {
        if ($percentage >= 80) {
            return "¡El proyecto está siendo excepcionalmente bien recibido! Con un {$percentage}% de respuestas positivas, "
                 . "podemos confirmar que la iniciativa tiene una excelente aceptación. Los participantes muestran "
                 . "entusiasmo por el videojuego educativo y valoran positivamente su enfoque innovador. Estos "
                 . "resultados sugieren que el proyecto está en el camino correcto y tiene alto potencial de impacto.";
        } elseif ($percentage >= 60) {
            return "El proyecto tiene una buena aceptación con un {$percentage}% de respuestas positivas. "
                 . "La mayoría de los participantes ven con buenos ojos la iniciativa, aunque existen algunas "
                 . "reservas puntuales. Recomendamos mantener el enfoque principal mientras se trabajan "
                 . "aquellos aspectos que generan dudas para mejorar aún más la percepción.";
        } elseif ($percentage >= 40) {
            return "El proyecto muestra una aceptación moderada ({$percentage}% respuestas positivas). "
                 . "Existe interés en la propuesta pero también reservas significativas. Sugerimos revisar "
                 . "los aspectos que generan más críticas y considerar ajustes en la comunicación o diseño "
                 . "para aumentar el nivel de aceptación general.";
        } else {
            return "El proyecto enfrenta desafíos en su aceptación (solo {$percentage}% respuestas positivas). "
                 . "Estos resultados indican que se necesitan revisiones importantes en el concepto o su "
                 . "presentación. Recomendamos realizar un análisis más profundo de las críticas y considerar "
                 . "un rediseño de aquellos elementos que generan más rechazo.";
        }
    }
}