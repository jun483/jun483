<?php

namespace OSS\Modules\Calculator;

if (!defined('ABSPATH')) {
    exit;
}

class CalculatorFactory
{
    public static function create(string $type): CalculatorInterface
    {
        return match ($type) {

    'lesson'     => new LessonBagCalculator(),

    'shoes'      => new ShoesBagCalculator(),

    'drawstring' => new DrawstringCalculator(),

    'tote'       => new ToteBagCalculator(),

    default      => throw new \Exception('Calculator not found'),

};
    }
}