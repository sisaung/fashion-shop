<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $validSortColumns = ['brand_name','id'];
        $sortBy = in_array($request->input('sort_by'),$validSortColumns) ? $request->input('sort_by') : 'id';

        $sortDirection = in_array($request->input('sort_direction'),['asc','desc']) ? $request->input('sort_direction') : 'desc';


        $limit = $request->input('limit',5);

        $limit = is_numeric($limit) && $limit > 0 ? $limit : 5;

        $searchTerm = $request->input('q');

        $query = Brand::query();

        if($searchTerm) {

            $query->where('brand_name','like',"%$searchTerm%");

        }

        $query->orderBy($sortBy,$sortDirection);

        $brands = $query->paginate($limit);
        $brands->appends([
            'q' => $searchTerm,
            'sort_by' => $sortBy,
            'sort_direction' => $sortDirection,
            'limit' => $limit
        ]);



        return view('admin.brands.brand',['brands'=> $brands]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.brandCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        $path = null;

        if($request->hasFile('brand_image')) {
           $path =  $request->file('brand_image')->store('brand_images','public');
        }

         Brand::create([

            'brand_name' => $request->brand_name,
            'brand_image' => $path,
            'user_id' => Auth::id()

        ]);
        return redirect()->route('brand.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
