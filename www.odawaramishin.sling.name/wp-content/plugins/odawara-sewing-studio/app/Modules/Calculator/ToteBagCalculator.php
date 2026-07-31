<?php

namespace OSS\Modules\Calculator;

class ToteBagCalculator
{
    public function calculate(array $data): array
    {
        $width  = (float)($data['width'] ?? 35);
        $height = (float)($data['height'] ?? 35);
        $qty    = max(1, (int)($data['quantity'] ?? 1));
        $fabricWidth = (int)($data['fabric_width'] ?? 110);

        $gusset = (float)($data['gusset'] ?? 10);

        $seam = 2;

        $cutWidth = ($width + $gusset) * 2 + ($seam * 2);
        $cutHeight = $height + ($gusset / 2) + ($seam * 2);

        $pieces = $qty * 2;

        $fabricCalculator = new FabricCalculator();

        $fabric = $fabricCalculator->calculate(
            $cutWidth,
            $cutHeight,
            $pieces,
            $fabricWidth,
            0.10
        );

        return [

            'success' => true,

            'title' => 'トートバッグ',

            'fabric' => $fabric,

            'lining' => $fabric,

            'fabric_width' => $fabricWidth,

            'cut_width' => round($cutWidth,1),

            'cut_height' => round($cutHeight,1),

            'handle' => 60 * 2 * $qty,

            'interfacing' => round(
                ($cutWidth * $cutHeight * $pieces) / 10000,
                2
            ),

            'pieces' => $pieces,

            'layout' => $fabricCalculator->layout(
                $cutWidth,
                $cutHeight,
                $pieces,
                $fabricWidth
            )

        ];
    }
}