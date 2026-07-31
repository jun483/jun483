<?php

namespace OSS\Modules\Calculator;

class LunchBagCalculator
{
    public function calculate(array $data): array
    {
        $width  = (float)($data['width'] ?? 27);
        $height = (float)($data['height'] ?? 20);
        $gusset = (float)($data['gusset'] ?? 10);

        $qty = max(1, (int)($data['quantity'] ?? 1));

        $fabricWidth = (int)($data['fabric_width'] ?? 110);

        $seam = 2;
        $topFold = 6;

        $cutWidth =
            ($width + $gusset) * 2 +
            ($seam * 2);

        $cutHeight =
            $height +
            ($gusset / 2) +
            $topFold +
            ($seam * 2);

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

            'title' => 'お弁当袋',

            'fabric' => $fabric,

            'lining' => 0,

            'fabric_width' => $fabricWidth,

            'cut_width' => round($cutWidth,1),

            'cut_height' => round($cutHeight,1),

            'handle' => 0,

            'cord' => 140 * $qty,

            'interfacing' => 0,

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