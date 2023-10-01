<?php

namespace App\Helpers\Traits;

use App\Models\InvoiceItem;
use App\Models\Product;
use App\Models\PurchaseItem;

trait StockTrait
{
    private function stock($product_id = null)
    {
        if ($product_id == null) {
            // getting purchased id and count total purchased item
            $purchasedTotalQuantity = PurchaseItem::sum('quantity');
        } else if ($product_id != null) {
            // getting purchased id and count total purchased item
            $purchasedTotalQuantity = PurchaseItem::where('product_id', $product_id)->sum('quantity');
        } else {
            // getting purchased id and count total purchased item
            $purchasedTotalQuantity = PurchaseItem::sum('quantity');
        }

        if ($product_id != null) {
            $invoiceTotalQuantity = InvoiceItem::where('product_id', $product_id)->sum('quantity');
        } else {
            $invoiceTotalQuantity = InvoiceItem::sum('quantity');
        }

        // getting product id and find the product
        $product = Product::findOrFail($product_id);

        // calculate the total stock
        $totalStock = $product->opening_stock + $purchasedTotalQuantity - $invoiceTotalQuantity;
        return $totalStock;
    }
}
