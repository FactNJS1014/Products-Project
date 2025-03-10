<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class ProductsController extends Controller
{
    //
    public function insertProducts(Request $request)
    {
        $prefix = 'FRU';
       $forms = $request->input('forms');
       $currentDate = date('Y-m-d H:i:s');
       $currentYearMonth = date('Ym');

        // Find the last generated ID for the current month
        $lastRecord = DB::table('products_tbl')
        ->where('product_id', 'like', "$prefix-$currentYearMonth%")
        ->orderBy('product_id', 'desc')
        ->first();

        $nextNumber = 1;
        if ($lastRecord) {
            $lastNumber = (int) substr($lastRecord->product_id, -5);
            $nextNumber = $lastNumber + 1;
        }

        // Generate new ID
        $customId = $prefix . '-' . $currentYearMonth . '-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);


        $insert_products = [
            'product_id' => $customId,
            'product_name' => $forms['product_name'],
            'product_price' => $forms['product_price'],
            'product_std' => 1,
            'product_lstdt' =>$currentDate
        ];
        DB::table('products_tbl')
        ->insert($insert_products);

         return response()->json($insert_products);

    }
}
