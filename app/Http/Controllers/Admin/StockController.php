<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStockRequest;
use App\Http\Requests\UpdateStockRequest;
use App\Models\Product;
use App\Models\Size;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)

    {
        $validator =  Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:products'
        ]);

        if ($validator->fails()) {
            return redirect()->route('product.index')
                ->withErrors($validator)
                ->withInput();
        }
            $product = Product::find($id);
            $stock = Stock::where('product_id', $id)->orderBy('id', 'desc')->get();

            return view('admin.product.product-stock.create',['product' => $product,'stocks' => $stock]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStockRequest $request,$id)
    {
        $validator =  Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:products'
        ]);

        if ($validator->fails()) {
            return redirect()->route('product.index')
                ->withErrors($validator)
                ->withInput();
        }

        $product = Product::find($id);

        $existingStock = Stock::where('product_id', $id)
        ->where('size_id', $request->size_id)
        ->first();

        $size = Size::find($request->size_id);

        $sku = $product->product_code . '-' . $size->size_name;

    if ($existingStock) {
        $existingStock->increment('stock_quantity', $request->stock_quantity);
        // $product->stock_count = $product->stock_count + $request->stock_quantity;
        $product->stock_count = Stock::where('product_id', $product->id)->sum('stock_quantity');

        $product->save();
    } else {
        //  If not, create new stock row
      $stock =  Stock::create([
            'product_id' => $id,
            'sku' => $sku,
            'stock_quantity' => $request->stock_quantity,
            'size_id' => $request->size_id
        ]);

        // $product->stock_count = $product->stock_count + $stock->stock_quantity;
        $product->stock_count = Stock::where('product_id', $product->id)->sum('stock_quantity');
        $product->save();
    }


        return redirect()->route('manage-stock.create',['id' => $id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStockRequest $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id,$stockId)
    {
        $validator = Validator::make(['id' => $stockId], [
            'id' => 'required|numeric|exists:stocks'
        ]);

        if ($validator->fails()) {
            return redirect()->route('manage-stock.create')
                ->withErrors($validator)
                ->withInput();
        }

        $product = Product::find($id);
        $stock = Stock::find($stockId);
        $product->decrement('stock_count', $stock->stock_quantity);
        $stock->delete();

        return redirect()->route('manage-stock.create',['id' => $id]);
    }

    // public function stockAnalysis()
    // {
    //     return view('admin.stock.stock-analysis.index');
    // }
}
