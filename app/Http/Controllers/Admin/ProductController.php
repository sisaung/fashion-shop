<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Fit;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductType;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


// laravel-5-framework

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    {

        $validSortColumns = ['product_name','stock_count', 'display_price','sale_price', 'brand_name', 'name', 'category_name',  'id'];
        $sortBy = in_array($request->input('sort_by'), $validSortColumns) ? $request->input('sort_by') : 'id';

        $sortDirection = in_array($request->input('sort_direction'), ['asc', 'desc']) ? $request->input('sort_direction') : 'desc';


        $limit = $request->input('limit', 5);

        $limit = is_numeric($limit) && $limit > 0 ? $limit : 5;

        $searchTerm = $request->input('q');

        $query = Product::with(['brand', 'productCategory', 'productType', 'fit','productImages','sizes']);

        if ($searchTerm) {

            $query->where(function (Builder $q) use ($searchTerm) {

                return $q->where('product_name', 'like', "%$searchTerm%")
                ->orWhere('gender','like',"%$searchTerm%")

                    ->orWhereHas('brand', function (Builder $q) use ($searchTerm) {
                        return $q->where('brand_name', 'like', "%$searchTerm%");
                    })
                    ->orWhereHas('productCategory', function (Builder $q) use ($searchTerm) {
                        return $q->where('category_name', 'like', "%$searchTerm%");
                    })
                    ->orWhereHas('productType', function (Builder $q) use ($searchTerm) {
                        return $q->where('name', 'like', "%$searchTerm%");
                    })
                    ->orWhereHas('fit', function (Builder $q) use ($searchTerm) {
                        return $q->where('fit_name', 'like', "%$searchTerm%");
                    });
            });
        }

        $query->join('brands', 'products.brand_id', '=', 'brands.id')
            ->join('product_categories', 'products.product_category_id', '=', 'product_categories.id')
            ->join('product_types', 'products.product_type_id', '=', 'product_types.id')
            ->select('products.*');

        // $query->join('product_categories', 'product_types.product_category_id', '=', 'product_categories.id')
        //     ->join('fit_product_type', 'product_types.id', '=', 'fit_product_type.product_type_id')
        //     ->join('fits', 'fit_product_type.fit_id', '=', 'fits.id')
        //     ->join('product_type_size', 'product_types.id', '=', 'product_type_size.product_type_id')
        //     ->join('sizes', 'product_type_size.size_id', '=', 'sizes.id')
        //     ->select("product_types.*")
        //     ->groupBy(['product_types.id', 'name', 'user_id', 'product_category_id', 'created_at', 'updated_at']);

        if($request->input('sort_by') === 'sale_price') {

            $query->orderBy('sale_price',$sortDirection);
        }
        else if ($request->input('sort_by') === 'discount_value') {
            // 🔄 Calculate discount amount for sorting
            $query->selectRaw("
                CASE
                    WHEN discount_type = 'percentage' THEN sale_price * discount_value / 100
                    WHEN discount_type = 'fixed' THEN discount_value
                    ELSE 0
                END as discount_amount
            ")
            ->orderBy('discount_amount', $sortDirection);
        } else {

            $query->orderBy($sortBy, $sortDirection);
        }

        $product = $query->paginate($limit);
        $product->appends([
            'q' => $searchTerm,
            'sort_by' => $sortBy,
            'sort_direction' => $sortDirection,
            'limit' => $limit
        ]);

        return view('admin.product.index', ['products' => $product]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::orderBy('brand_name', 'asc')->get();
        $productCategory = ProductCategory::orderBy('category_name', 'asc')->get();
        $productType = ProductType::orderBy('name', 'asc')->get();
        $fits = Fit::orderBy('fit_name', 'asc')->get();

        return view('admin.product.create', ['brands' => $brands, 'productCategories' => $productCategory, 'productTypes' => $productType, 'fits' => $fits]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $latestId = Product::max('id') + 1;
        $date = now()->format('Ymd');
        $code = 'PROD-' . $date . '-' . str_pad($latestId, 4, '0', STR_PAD_LEFT);
        $productCode = strtoupper($code);

        $newArrival = 1;
        if (!$request->is_new_arrival) {

            $newArrival = 0;
        }

        $fitId = $request->fit_id;
        if(!$request->fit_id) {
            $fitId = null;
        }



        $product = Product::create([
            'product_code' => $productCode,
            'product_name' => $request->product_name,
            'slug' => Str::slug($request->product_name, '-'),
            'original_price' => $request->original_price,
            'sale_price' => $request->sale_price,
            'discount_type' => $request->discount_type,
            'discount_value' => $request->discount_value,
            'display_price' => $request->display_price,
            'gender' => $request->gender,
            'is_new_arrival' => $newArrival,
            'brand_id' => $request->brand_id,
            'product_category_id' => $request->product_category_id,
            'product_type_id' => $request->product_type_id,
            'fit_id' => $fitId,
            'user_id' => Auth::id()
        ]);


        return redirect()->route('manage-image.edit', ['id' => $product->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:products'
        ]);

        if ($validator->fails()) {
            return redirect()->route('product.index')
                ->withErrors($validator)
                ->withInput();
        }

        $product = Product::find($id);

        return view('admin.product.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id,Request $request)
    {

       $validator = Validator::make(['id' => $id], [
           'id' => 'required|numeric|exists:products'
       ]);

       if ($validator->fails()) {
           return redirect()->route('product.index')
               ->withErrors($validator)
               ->withInput();
       }

       $brands = Brand::all();
       $productCategory = ProductCategory::all();
       $productType = ProductType::all();
       $fits = Fit::all();
       $product = Product::find($id);
    //    return $product;


       return view('admin.product.edit', ['product' => $product, 'brands' => $brands, 'productCategories' => $productCategory, 'productTypes' => $productType, 'fits' => $fits,'sort_by' => $request->sort_by, 'sort_direction' => $request->sort_direction, 'limit' => $request->limit, 'page' => $request->page, 'q' => $request->q]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request,$id)
    {
        // $lastId = Product::max('id') + 1;
        //  $productCode = strtoupper('PDR' . str_pad($lastId, 4, '0', STR_PAD_LEFT));
        $validator =  Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:products'
        ]);

        if ($validator->fails()) {
            return redirect()->route('product.index')
                ->withErrors($validator)
                ->withInput();
        }

        $newArrival = 1;
        if(!$request->is_new_arrival){
            $newArrival = 0;
        }

        $fitId = $request->fit_id;
        if(!$request->fit_id) {
            $fitId = null;
        }
        $product = Product::find($id);
        $product->product_code = $product->product_code;
        $product->product_name = $request->product_name;
        $product->original_price = $request->original_price;
        $product->sale_price = $request->sale_price;
        $product->discount_type = $request->discount_type;
        $product->discount_value = $request->discount_value;
        $product->display_price = $request->display_price;
        $product->gender = $request->gender;
        $product->is_new_arrival = $newArrival;
        $product->brand_id = $request->brand_id;
        $product->product_category_id = $request->product_category_id;
        $product->product_type_id = $request->product_type_id;
       $fitId && $product->fit_id = $fitId;
        $product->save();
        return redirect()->route('product.index',['sort_by' => $request->sort_by, 'sort_direction' => $request->sort_direction, 'limit' => $request->limit, 'page' => $request->page, 'q' => $request->q]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
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
        $product->delete();

        return redirect()->route('product.index');
    }


}

// image,product_name,brand,gender,fitting
// in product
