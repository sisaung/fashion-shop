<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductType;
use App\Http\Requests\StoreProductTypeRequest;
use App\Http\Requests\UpdateProductTypeRequest;
use App\Models\Fit;
use App\Models\ProductCategory;
use App\Models\Size;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $validSortColumns = ['name', 'category_name', 'fit_name', 'size_name', 'id'];
        $sortBy = in_array($request->input('sort_by'), $validSortColumns) ? $request->input('sort_by') : 'id';

        $sortDirection = in_array($request->input('sort_direction'), ['asc', 'desc']) ? $request->input('sort_direction') : 'desc';


        $limit = $request->input('limit', 5);

        $limit = is_numeric($limit) && $limit > 0 ? $limit : 5;

        $searchTerm = $request->input('q');

        $query = ProductType::with(['productCategory', 'fits', 'sizes']);

        if ($searchTerm) {

            $query->where(function (Builder $q) use ($searchTerm) {

                return $q->where('name', 'like', "%$searchTerm%")

                    ->orWhereHas('productCategory', function (Builder $q) use ($searchTerm) {
                        return $q->where('category_name', 'like', "%$searchTerm%");
                    })
                    ->orWhereHas('fits', function (Builder $q) use ($searchTerm) {
                        return $q->where('fit_name', 'like', "%$searchTerm%");
                    })
                    ->orWhereHas('sizes', function (Builder $q) use ($searchTerm) {
                        return $q->where('size_name', 'like', "%$searchTerm%");
                    });
            });
        }

        // $query->join('product_categories', 'product_types.product_category_id', '=', 'product_categories.id')
        //     ->leftjoin('fit_product_type', 'product_types.id', '=', 'fit_product_type.product_type_id')
        //     ->leftJoin('fits', 'fit_product_type.fit_id', '=', 'fits.id')
        //     ->join('product_type_size', 'product_types.id', '=', 'product_type_size.product_type_id')
        //     ->join('sizes', 'product_type_size.size_id', '=', 'sizes.id')
        //     ->select("product_types.*")
        //     ->groupBy(['product_types.id', 'name', 'user_id', 'product_category_id', 'created_at', 'updated_at']);

        $query->orderBy($sortBy, $sortDirection);

        $productType = $query->paginate($limit);
        $productType->appends([
            'q' => $searchTerm,
            'sort_by' => $sortBy,
            'sort_direction' => $sortDirection,
            'limit' => $limit
        ]);

        // return $productType;
        return view('admin.product-type.index', ['productTypes' => $productType]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $productCategory = ProductCategory::all();
        $fit = Fit::orderBy('fit_name', 'asc')->get();
        $size = Size::orderBy('size_name','asc')->get();
        return view('admin.product-type.create', ['productCategories' => $productCategory, 'fits' => $fit, 'sizes' => $size]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductTypeRequest $request)
    {


        // $fits =  explode(',', $request->fits ?? 0);
        // $sizes = explode(',', $request->sizes);
        // $fitIds = [];
        // $sizeIds = [];
        $fits = $request->fits;
        $sizes = $request->sizes;


        // foreach ($fits as $fit) {

        //     $fitIds[] = $fit;
        // }


        // foreach ($sizes as $size) {

        //     $sizeIds[] = $size;
        // }

        $productType =  ProductType::create([

            'name' => $request->name,
            'product_category_id' => $request->product_category_id,
            'user_id' => Auth::id()
        ]);

    //    if($fitIds[0] !== '0') {

    //     $productType->fits()->attach($fitIds);
    //    }
    //     $productType->sizes()->attach($sizeIds);



        $productType->fits()->attach($fits);
        $productType->sizes()->attach($sizes);

        return redirect()->route('product-type.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductType $productType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Request $request)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:product_types'
        ]);

        if ($validator->fails()) {
            return redirect()->route('product-type.index')
                ->withErrors($validator)
                ->withInput();
        }

        $productCategory = ProductCategory::all();
        $fits = Fit::all();
        $sizes = Size::all();
        $productType = ProductType::with(['productCategory', 'fits', 'sizes'])->find($id);

        return view('admin.product-type.edit', ['productType' => $productType, 'productCategories' => $productCategory, 'fits' => $fits, 'sizes' => $sizes, 'sort_by' => $request->sort_by, 'sort_direction' => $request->sort_direction, 'limit' => $request->limit, 'page' => $request->page, 'q' => $request->q]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductTypeRequest $request, $id)
    {

        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:product_types'
        ]);

        if ($validator->fails()) {
            return redirect()->route('product-type.index')
                ->withErrors($validator)
                ->withInput();
        }

        // $fitIds =  explode(',', $request->fits ?? 0);
        // $sizeIds = explode(',', $request->sizes);
        $fits = $request->fits;
        $sizes = $request->sizes;

        $productType = ProductType::find($id);
        $productType->name = $request->name;
        $productType->product_category_id = $request->product_category_id;

        // if($fitIds[0] !=='0'){
        // $productType->fits()->sync($fitIds);

        // }
        // if($fits[0] !=='0'){
        //     $productType->fits()->sync($fits);

        //     }

        $productType->fits()->sync($fits ?? null);

        $productType->sizes()->sync($sizes);
        $productType->save();

        return redirect()->route('product-type.index', ['sort_by' => $request->sort_by, 'sort_direction' => $request->sort_direction, 'limit' => $request->limit, 'page' => $request->page, 'q' => $request->q]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:product_types'
        ]);

        if ($validator->fails()) {
            return redirect()->route('product-type.index')
                ->withErrors($validator)
                ->withInput();
        }

        $productType = ProductType::find($id);
        $productType->delete();

        return redirect()->route('product-type.index');
    }

    public function getProductTypes($id) {

        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:product_categories'
        ]);

        if ($validator->fails()) {
            return redirect()->route('product-categories.index')
                ->withErrors($validator)
                ->withInput();
        }

        $productType = ProductType::where('product_category_id', '=', $id)->get();
        return response()->json($productType);
    }
}
