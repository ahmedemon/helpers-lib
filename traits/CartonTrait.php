<?php

namespace App\Helpers\Traits;

use Illuminate\Support\Facades\Auth;

trait CartonTrait
{
    public function carton($stock, $carton)
    {
        // Calculate carton count and remaining pieces
        $quantity = $stock;
        $cartonAt = $carton;
        $cartonCount = floor($quantity / $cartonAt); // Number of full cartons
        $remainingPieces = $quantity % $cartonAt; // Remaining pieces after full cartons

        // Build a string to display cartons and pieces
        $result = '';

        if ($cartonCount > 0) {
            $result .= $cartonCount . ' carton';
            if ($cartonCount > 1) {
                $result .= 's'; // Pluralize "carton" if there are more than one
            }
        }

        if ($remainingPieces > 0) {
            if ($cartonCount > 0) {
                $result .= ' & ';
            }
            $result .= $remainingPieces . ' pcs';
        }

        return $result;
    }
}
