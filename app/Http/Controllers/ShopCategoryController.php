<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Fit;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductType;
use App\Models\Size;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function PHPSTORM_META\type;

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

        if($request->ajax()){
            return response()->json($product);

        };

        return view('public.shop.index', ['products' => $product]);
    }

    public function show($slug) {

        $validator = Validator::make(['slug' => $slug], [
            'slug' => 'required|exists:products,slug'
        ]);

        if ($validator->fails()) {
             return redirect()->route('shop.index')
            ->withErrors($validator)
            ->withInput();
        }

        $product = Product::with([
            'brand',
            'productCategory',
            'productType',
            'fit',
            'productImages',
            'sizes',
            'stocks.size',
            'reviews',
            'reviews.user'
        ])->where('slug', $slug)->first();

        return view('public.shop.show', ['product' => $product]);
    }

    public function getShop(Request $request) {


        $validSortColumns = ['product_name', 'display_price', 'sale_price' ,'brand_name', 'discount_percentage', 'name', 'category_name',  'id'];
        $sortBy = in_array($request->input('sort_by'), $validSortColumns) ? $request->input('sort_by') : 'id';

        $sortDirection = in_array($request->input('sort_direction'), ['asc', 'desc']) ? $request->input('sort_direction') : 'desc';

        $brandNames = $request->input('brands'); // array of brand names
        $filters = $request->input('filters',[]);

        $limit = $request->input('limit', 5);

        $limit = is_numeric($limit) && $limit > 0 ? $limit : 5;

        $searchTerm = $request->input('q');
        $brandNames = $request->input('brands');


        $query = Product::with(['brand', 'productCategory', 'productType', 'fit', 'productImages','sizes']);


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



            if (!empty($brandNames) && is_array($brandNames)) {
                $query->whereHas('brand', function (Builder $q) use ($brandNames) {
                    $q->whereIn('brand_name', $brandNames);
                });
            }

            if ($brandNames) {
                $query->whereHas('brand', function ($query) use ($brandNames) {
                    $query->whereIn('brand_name', $brandNames);
                });
            }

            // 🔹 Filter by product category
            if (!empty($filters['productCategory_id'])) {
                $query->whereHas('productCategory', function ($query) use ($filters) {
                    $query->where('id', $filters['productCategory_id']);
                });
            }

            // 🔹 Filter by product type
            if (!empty($filters['productType_id'])) {
                $query->whereHas('productType', function ($query) use ($filters) {
                    $query->where('id', $filters['productType_id']);
                });
            }

             // 🔹 Filter by product fit

             if (!empty($filters['productFit_id'])) {
                $query->whereHas('fit', function ($query) use ($filters) {
                    $query->where('id', $filters['productFit_id']);
                });
            }

             // 🔹 Filter by product size

             if (!empty($filters['productSize_id'])) {
                $query->whereHas('productType.sizes', function ($query) use ($filters) {
                    $query->where('sizes.id', $filters['productSize_id']);
                });
            }


        $query->orderBy($sortBy, $sortDirection);

        $product = $query->paginate($limit);
        $product->appends([
            'q' => $searchTerm,
            'sort_by' => $sortBy,
            'sort_direction' => $sortDirection,
            'limit' => $limit,
            'brands' => $brandNames
        ]);

        return response()->json($product);

    }

    public function getBrand(Request $request) {
        $brand = Brand::with('products')->get();
        return response()->json($brand);
    }

    public function filterShopProduct(Request $request)
    {
        $brandNames = $request->input('brands'); // array of brand names
        $filters = $request->input('filters');   // associative array

        $query = Product::with(['productImages', 'brand', 'productCategory', 'productType']);


        // 🔹 Filter by brand names
        if ($brandNames) {
            $query->whereHas('brand', function ($query) use ($brandNames) {
                $query->whereIn('brand_name', $brandNames);
            });
        }

        // 🔹 Filter by product category
        if (!empty($filters['productCategory_id'])) {
            $query->whereHas('productCategory', function ($query) use ($filters) {
                $query->where('id', $filters['productCategory_id']);
            });
        }

        // 🔹 Filter by product type
        if (!empty($filters['productType_id'])) {
            $query->whereHas('productType', function ($query) use ($filters) {
                $query->where('id', $filters['productType_id']);
            });
        }

        // You can add more filters like price range, discount etc. here

        $products = $query->paginate(10);

        return response()->json($products);
    }


    public function getProductCategory() {
        $productCategory = ProductCategory::with(['productTypes','productTypes.fits','productTypes.sizes'])->get();
        return response()->json($productCategory);
    }

    public function getProductType() {
        $productType = ProductType::with(['fits','sizes'])->get();
        return response()->json($productType);
    }

    public function getProductFit($id) {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|exists:product_types,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $fit = Fit::whereHas('productTypes', function ($query) use ($id) {
            $query->where('product_types.id', $id);
        })->orderBy('id', 'asc')->get();

       return response()->json($fit);
    }

    public function getProductSize($id) {

        $validator = Validator::make(['id' => $id], [
            'id' => 'required|exists:product_types,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $size = Size::whereHas('productTypes', function ($query) use ($id) {
            $query->where('product_types.id', $id);
        })->orderBy('id', 'asc')->get();

        return response()->json($size);
    }

}
