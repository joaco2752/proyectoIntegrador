<?php

namespace App\Services;

class PerceptronClassifier
{
    private $positiveWords = [
        'útil', 'bueno', 'genial', 'esperanza', 'divertido', 'entretenido', 'positivo', 
        'motivación', 'gusta', 'interesante', 'creativa', 'recomendar', 'bien', 'disfruten',
        'progreso', 'impacto', 'conciencia', 'cambio', 'mejor', 'ideal', 'satisfacción',
        'alegría', 'orgullo', 'emoción', 'confianza', 'deseo', 'feliz', 'bonito', 'útil',
        'valioso', 'importante', 'necesario', 'constructivo', 'agradable', 'favorable',
        'gustaría', 'creativa', 'conciencia', 'bien', 'ideal', 'satisfacción', 'alegría',
        'orgullo', 'emoción', 'confianza', 'deseo', 'feliz', 'bonito', 'valioso'
    ];
    
    private $negativeWords = [
        'aburrido', 'malo', 'asco', 'negativo', 'duda', 'miedo', 'triste', 'frustración',
        'cansancio', 'preocupación', 'incertidumbre', 'inseguridad', 'impotencia', 'difícil',
        'complicado', 'confuso', 'obligación', 'deber', 'problema', 'poco', 'falta', 'nadie',
        'nunca', 'nada', 'nulo', 'forzado', 'obligatorio', 'obligado', 'ruido', 'olores',
        'arruinar', 'aburridas', 'tareas', 'relleno', 'superficial', 'lento', 'poco',
        'interesa', 'llama', 'forzado', 'obligatorio', 'confuso', 'problema', 'frustración'
    ];
    
    private $negationWords = [
        'no', 'ni', 'nunca', 'jamás', 'tampoco', 'sin'
    ];

    public function analyzeText($text)
    {
        $sentences = preg_split('/[.!?]/', $text, -1, PREG_SPLIT_NO_EMPTY);
        $positive = 0;
        $negative = 0;
        
        foreach ($sentences as $sentence) {
            $score = $this->analyzeSentence($sentence);
            if ($score > 0) {
                $positive++;
            } elseif ($score < 0) {
                $negative++;
            }
        }
        
        $total = $positive + $negative;
        
        return [
            'positive' => $positive,
            'negative' => $negative,
            'total' => $total,
            'percentage' => $total > 0 ? round(($positive / $total) * 100, 2) : 0
        ];
    }

    private function analyzeSentence($sentence)
    {
        $words = preg_split('/\s+/', strtolower($sentence));
        $score = 0;
        $negation = false;
        
        foreach ($words as $word) {
            $word = preg_replace('/[^a-záéíóúñ]/', '', $word);
            
            if (in_array($word, $this->negationWords)) {
                $negation = true;
                continue;
            }
            
            if (in_array($word, $this->positiveWords)) {
                $score += $negation ? -1 : 1;
                $negation = false;
            } elseif (in_array($word, $this->negativeWords)) {
                $score += $negation ? 1 : -1;
                $negation = false;
            }
        }
        
        return $score;
    }
}