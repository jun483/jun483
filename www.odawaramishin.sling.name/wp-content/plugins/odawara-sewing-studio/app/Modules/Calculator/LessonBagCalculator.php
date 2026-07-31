<?php

namespace OSS\Modules\Calculator;

class LessonBagCalculator
{
    public function calculate(array $data): array
    {
        $width  = (float)($data['width'] ?? 0);
        $height = (float)($data['height'] ?? 0);
        $qty    = max(1, (int)($data['quantity'] ?? 1));
        $fabricWidth = (int)($data['fabric_width'] ?? 110);

        // 縫い代
        $seam = 2;

        // 裁断サイズ
        $cutWidth  = ($width * 2) + ($seam * 2);
        $cutHeight = $height + 8 + ($seam * 2);

        // 本体2枚
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

            'title' => 'レッスンバッグ',

            'fabric' => $fabric,

            'lining' => $fabric,

            'fabric_width' => $fabricWidth,

            'cut_width' => round($cutWidth,1),

            'cut_height' => round($cutHeight,1),

            'handle' => 35 * 2 * $qty,

            'interfacing' => round(
                ($cutWidth * $cutHeight * $pieces) / 10000,
                2
            ),

            'pieces' => $pieces,

            'layout' => $layout

        ];
    }
}