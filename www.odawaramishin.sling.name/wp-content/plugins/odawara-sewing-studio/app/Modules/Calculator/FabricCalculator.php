<?php

namespace OSS\Modules\Calculator;

class FabricCalculator
{
    /**
     * 必要な生地(m)を計算
     */
    public function calculate(
        float $cutWidth,
        float $cutHeight,
        int $pieces,
        int $fabricWidth = 110,
        float $lossRate = 0.1
    ): float {

        if (
            $cutWidth <= 0 ||
            $cutHeight <= 0 ||
            $pieces <= 0
        ) {
            return 0;
        }

        $cols = max(
            1,
            (int) floor($fabricWidth / $cutWidth)
        );

        $rows = (int) ceil($pieces / $cols);

        $length = $rows * $cutHeight;

        $length *= (1 + $lossRate);

        return round($length / 100, 2);
    }

    /**
     * 裁断配置情報
     */
    public function layout(
        float $cutWidth,
        float $cutHeight,
        int $pieces,
        int $fabricWidth = 110
    ): array {

        $cols = max(
            1,
            (int) floor($fabricWidth / $cutWidth)
        );

        $rows = (int) ceil($pieces / $cols);

        $layout = [];

        $count = 0;

        for ($r = 0; $r < $rows; $r++) {

            $line = [];

            for ($c = 0; $c < $cols; $c++) {

                if ($count >= $pieces) {
                    break;
                }

                $line[] = [
                    'x' => $c * $cutWidth,
                    'y' => $r * $cutHeight,
                    'width' => $cutWidth,
                    'height' => $cutHeight,
                ];

                $count++;
            }

            $layout[] = $line;
        }

        return [
            'fabric_width' => $fabricWidth,
            'rows' => $rows,
            'columns' => $cols,
            'pieces' => $pieces,
            'layout' => $layout,
        ];
    }
}