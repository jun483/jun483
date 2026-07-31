<?php

namespace OSS\Modules\Calculator;

class CalculatorEngine
{
    public function calculate(array $data): array
    {
        $type = $data['type'] ?? '';

        switch ($type) {

            case 'lesson_bag':
                return (new LessonBagCalculator())->calculate($data);

            case 'shoe_bag':
                return (new ShoeBagCalculator())->calculate($data);

            case 'drawstring':
                return (new DrawstringCalculator())->calculate($data);

            case 'tote':
                case 'tote':
                return (new ToteBagCalculator())->calculate($data);

            case 'lunch_bag':
    　　　　　return (new 　　　　　　　LunchBagCalculator())->calculate($data);

            case 'cup_bag':
                return [
                    'success' => false,
                    'message' => 'コップ袋は現在開発中です。'
                ];

            case 'knapsack':
                return [
                    'success' => false,
                    'message' => 'ナップサックは現在開発中です。'
                ];

            default:
                return [
                    'success' => false,
                    'message' => '作品を選択してください。'
                ];
        }
    }
}