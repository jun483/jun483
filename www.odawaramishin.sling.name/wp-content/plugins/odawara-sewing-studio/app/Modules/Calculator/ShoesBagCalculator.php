<?php

namespace OSS\Modules\Calculator;

class ShoeBagCalculator
{
    public function calculate(array $data): array
    {
        $width  = (float)($data['width'] ?? 22);
        $height = (float)($data['height'] ?? 28);
        $qty    = max(1, (int)($data['quantity'] ?? 1));
        $fabricWidth = (int)($data['fabric_width'] ?? 110);

        $seam = 2;

        $cutWidth  = ($width * 2) + ($seam * 2);
        $cutHeight = $height + 8 + ($seam * 2);

        $pieces = $qty * 2;

        $fabricCalculator = new FabricCalculator();

        $fabric = $fabricCalculator->calculate(
            $cutWidth,
            $cutHeight,
            $pieces,
            $fabricWidth,
            0.10
        );

        $layout = $fabricCalculator->layout(
            $cutWidth,
            $cutHeight,
            $pieces,
            $fabricWidth
        );

        return [

            'success' => true,

            'title' => 'シューズバッグ',

            'fabric' => $fabric,

            'lining' => $fabric,

            'fabric_width' => $fabricWidth,

            'cut_width' => round($cutWidth, 1),

            'cut_height' => round($cutHeight, 1),

            'handle' => 30 * $qty,

            'interfacing' => round(
                ($cutWidth * $cutHeight * $pieces) / 10000,
                2
            ),

            'pieces' => $pieces,

            'layout' => $layout

        ];
    }
}