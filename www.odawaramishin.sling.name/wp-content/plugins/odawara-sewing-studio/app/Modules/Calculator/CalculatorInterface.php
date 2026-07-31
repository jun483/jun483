<?php

namespace OSS\Modules\Calculator;

if (!defined('ABSPATH')) {
    exit;
}

interface CalculatorInterface
{
    /**
     * 計算実行
     *
     * @param array $data
     * @return array
     */
    public function calculate(array $data): array;
}