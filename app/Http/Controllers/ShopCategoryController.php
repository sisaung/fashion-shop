<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;

class ShopCategoryController extends Controller
{
    public function index(Request $request)
    {
        $validSortColumns = ['product_name', 'display_price', 'brand_name', 'discount_percentage', 'name', 'category_name',  'id'];
        $sortBy = in_array($request->input('sort_by'), $validSortColumns) ? $request->input('sort_by') : 'id';

        $sortDirection = in_array($request->input('sort_direction'), ['asc', 'desc']) ? $request->input('sort_direction') : 'desc';


        $limit = $request->input('limit', 5);

        $limit = is_numeric($limit) && $limit > 0 ? $limit : 5;

        $searchTerm = $request->input('q');

        $query = Product::with(['brand', 'productCategory', 'productType', 'fit', 'productImages']);

        if ($searchTerm) {

            $query->where(function (Builder $q) use ($searchTerm) {

                return $q->where('product_name', 'like', "%$searchTerm%")

                    ->orWhereHas('brand', function (Builder $q) use ($searchTerm) {
                        return $q->where('brand_name', 'like', "%$searchTerm%");
                    })
                    ->orWhereHas('productCategory', function (Builder $q) use ($searchTerm) {
                        return $q->where('category_name', 'like', "%$searchTerm%");
                    })
                    ->orWhereHas('productType', function (Builder $q) use ($searchTerm) {
                        return $q->where('name', 'like', "%$searchTerm%");
                    })
                    ->orWhereHas('fits', function (Builder $q) use ($searchTerm) {
                        return $q->where('fit_name', 'like', "%$searchTerm%");
                    });
            });
        }

        $query->join('brands', 'products.brand_id', '=', 'brands.id')
            ->join('product_categories', 'products.product_category_id', '=', 'product_categories.id')
            ->join('product_types', 'products.product_type_id', '=', 'product_types.id')
            ->select('products.*');



        $query->orderBy($sortBy, $sortDirection);

        $product = $query->paginate($limit);
        $product->appends([
            'q' => $searchTerm,
            'sort_by' => $sortBy,
            'sort_direction' => $sortDirection,
            'limit' => $limit
        ]);

        $brand = Brand::with('products')->get();

        return view('public.shop.index', ['products' => $product,['brands' => $brand]]);
    }

    public function getShop(Request $request) {


        $validSortColumns = ['product_name', 'display_price', 'sale_price' ,'brand_name', 'discount_percentage', 'name', 'category_name',  'id'];
        $sortBy = in_array($request->input('sort_by'), $validSortColumns) ? $request->input('sort_by') : 'id';

        $sortDirection = in_array($request->input('sort_direction'), ['asc', 'desc']) ? $request->input('sort_direction') : 'desc';


        $limit = $request->input('limit', 5);

        $limit = is_numeric($limit) && $limit > 0 ? $limit : 5;

        $searchTerm = $request->input('q');

        $query = Product::with(['brand', 'productCategory', 'productType', 'fit', 'productImages']);

        if ($searchTerm) {

            $query->where(function (Builder $q) use ($searchTerm) {

                return $q->where('product_name', 'like', "%$searchTerm%")

                    ->orWhereHas('brand', function (Builder $q) use ($searchTerm) {
                        return $q->where('brand_name', 'like', "%$searchTerm%");
                    })
                    ->orWhereHas('productCategory', function (Builder $q) use ($searchTerm) {
                        return $q->where('category_name', 'like', "%$searchTerm%");
                    })
                    ->orWhereHas('productType', function (Builder $q) use ($searchTerm) {
                        return $q->where('name', 'like', "%$searchTerm%");
                    })
                    ->orWhereHas('fits', function (Builder $q) use ($searchTerm) {
                        return $q->where('fit_name', 'like', "%$searchTerm%");
                    });
            });
        }

        $query->join('brands', 'products.brand_id', '=', 'brands.id')
            ->join('product_categories', 'products.product_category_id', '=', 'product_categories.id')
            ->join('product_types', 'products.product_type_id', '=', 'product_types.id')
            ->select('products.*');



        $query->orderBy($sortBy, $sortDirection);

        $product = $query->paginate($limit);
        $product->appends([
            'q' => $searchTerm,
            'sort_by' => $sortBy,
            'sort_direction' => $sortDirection,
            'limit' => $limit
        ]);



        return response()->json($product);

    }
}
