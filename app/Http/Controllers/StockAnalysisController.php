<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\ProductType;
use App\Models\Size;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockAnalysisController extends Controller
{
    public function index() {

        return view('admin.stock-analysis.index');
    }

    public function stockByProductType() {

        $productTypes = ProductType::with('products.stocks')->get();

        $result = $productTypes->map(function($type) {
            $totalStock = 0;

            foreach ($type->products as $product) {
                $totalStock += $product->stocks->sum('stock_quantity'); // replace 'stock_count' with your actual stock column name
            }

            return [
                'id' => $type->id,
                'type_name' => $type->name, // replace 'name' if your column name is different
                'total_stock' => $totalStock
            ];
        });

     return response()->json($result);

    }

    public function stockByBrand(Request $request) {

         // Get product_type_id from request if selected
    $productTypeId = $request->input('stock_by_product_type');
    $brandId = $request->input('stock_by_brand');


    // Eager load products (filtered by product type if selected) with their stocks
    $brands = Brand::with(['products' => function ($query) use ($productTypeId,$brandId) {
        if ($productTypeId) {
            $query->where('product_type_id', $productTypeId);
        }
       
        $query->with('stocks');
    }])->get();

    // Calculate total stock for each brand
    $result = $brands->map(function($brand) {
        $totalStock = 0;

        foreach ($brand->products as $product) {
            $totalStock += $product->stocks->sum('stock_quantity'); // replace with your actual stock column
        }

        return [
            'id' => $brand->id,
            'brand_name' => $brand->brand_name, // adjust if column name is different
            'total_stock' => $totalStock
        ];
    });

    return response()->json($result);

    }

    public function stockBySize(Request $request)
{
    $productTypeId = $request->input('stock_by_product_type');
    $brandId = $request->input('stock_by_brand');

    $sizes = Size::whereHas('stocks.product', function($q) use ($productTypeId, $brandId) {
        if ($productTypeId) {
            $q->where('product_type_id', $productTypeId);
        }
        if ($brandId) {
            $q->where('brand_id', $brandId);
        }
    })
    ->with(['stocks' => function($query) use ($productTypeId, $brandId) {
        $query->whereHas('product', function($q) use ($productTypeId, $brandId) {
            if ($productTypeId) {
                $q->where('product_type_id', $productTypeId);
            }
            if ($brandId) {
                $q->where('brand_id', $brandId);
            }
        });
    }])->get();



    $result = $sizes->map(function($size) {
        $totalStock = $size->stocks->sum('stock_quantity');

        return [
            'size_name' => $size->size_name,
            'total_stock' => $totalStock
        ];
    });


    return response()->json($result);
}
}
