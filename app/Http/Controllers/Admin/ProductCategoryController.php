<?php

namespace  App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $validSortColumns = ['category_name', 'id'];
        $sortBy = in_array($request->input('sort_by'), $validSortColumns) ? $request->input('sort_by') : 'id';

        $sortDirection = in_array($request->input('sort_direction'), ['asc', 'desc']) ? $request->input('sort_direction') : 'desc';


        $limit = $request->input('limit', 5);

        $limit = is_numeric($limit) && $limit > 0 ? $limit : 5;

        $searchTerm = $request->input('q');

        $query = ProductCategory::query();

        if ($searchTerm) {

            $query->where('category_name', 'like', "%$searchTerm%");
        }

        $query->orderBy($sortBy, $sortDirection);

        $productCategory = $query->paginate($limit);
        $productCategory->appends([
            'q' => $searchTerm,
            'sort_by' => $sortBy,
            'sort_direction' => $sortDirection,
            'limit' => $limit
        ]);




        return view('admin.product-category.index', ['productCategories' => $productCategory]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.product-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductCategoryRequest $request)
    {
        ProductCategory::create([
            'category_name' => $request->category_name,
            'user_id' => Auth::id()
        ]);
        return redirect()->route('product-category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Request $request)
    {
        $validator =  Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:product_categories'
        ]);

        if ($validator->fails()) {
            return redirect()->route('product-category.index')
                ->withErrors($validator)
                ->withInput();
        }

        $productCategory = ProductCategory::find($id);
        return view('admin.product-category.edit', ['productCategory' => $productCategory, 'sort_by' => $request->sort_by, 'sort_direction' => $request->sort_direction, 'limit' => $request->limit, 'page' => $request->page, 'q' => $request->q]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductCategoryRequest $request, ProductCategory $productCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $validator =  Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:product_categories'
        ]);

        if ($validator->fails()) {
            return redirect()->route('product-category.index')
                ->withErrors($validator)
                ->withInput();
        }

        $productCategory = ProductCategory::find($id);
        $productCategory->delete();

        return redirect()->route('product-category.index');
    }
}
