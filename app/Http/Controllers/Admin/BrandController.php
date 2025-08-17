<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $validSortColumns = ['brand_name', 'id'];
        $sortBy = in_array($request->input('sort_by'), $validSortColumns) ? $request->input('sort_by') : 'id';

        $sortDirection = in_array($request->input('sort_direction'), ['asc', 'desc']) ? $request->input('sort_direction') : 'desc';


        $limit = $request->input('limit', 5);

        $limit = is_numeric($limit) && $limit > 0 ? $limit : 5;

        $searchTerm = $request->input('q');

        $query = Brand::query();

        if ($searchTerm) {

            $query->where('brand_name', 'like', "%$searchTerm%");
        }

        $query->orderBy($sortBy, $sortDirection);

        $brands = $query->paginate($limit);
        $brands->appends([
            'q' => $searchTerm,
            'sort_by' => $sortBy,
            'sort_direction' => $sortDirection,
            'limit' => $limit
        ]);

        // if ($request->ajax()) {
        //     return view('admin.brands.brand', ['brands' => $brands])->render();
        // }


        return view('admin.brands.index', ['brands' => $brands]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        $path = null;

        if ($request->hasFile('brand_image')) {
            $path =  $request->file('brand_image')->store('brand_images', 'public');
        }


        Brand::create([

            'brand_name' => $request->brand_name,
            'brand_image' => $path,
            'user_id' => Auth::id()

        ]);
        return redirect()->route('brand.index')->with('success','Brand created successfully');
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
    public function edit($id, Request $request)
    {


        $validator =  Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:brands'
        ]);

        if ($validator->fails()) {
            return redirect()->route('brand.index')
                ->withErrors($validator)
                ->withInput();
        }

        $brand = Brand::find($id);
        return view('admin.brands.edit', ['brand' => $brand, 'sort_by' => $request->sort_by, 'sort_direction' => $request->sort_direction, 'limit' => $request->limit, 'page' => $request->page, 'q' => $request->q]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, $id)
    {



        $validator =  Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:brands'
        ]);

        if ($validator->fails()) {
            return redirect()->route('brand.index')
                ->withErrors($validator)
                ->withInput();
        }


        $brand = Brand::find($id);
        $brand->brand_name = $request->brand_name;




        $path = null;

        if ($request->hasFile('brand_image')) {
            $path = $request->file('brand_image')->store('brand_images', 'public');
            if ($brand->brand_image) {
                Storage::delete($request->brand_image);
            }


            $brand->brand_image = $path;
        } else {
            $start = strpos($request->old_brand_image, 'brand_images/');

            $old_brand_image = substr($request->old_brand_image, $start);

            $brand->brand_image = $old_brand_image;
        }


        $brand->save();
        return redirect()->route('brand.index', ['sort_by' => $request->sort_by, 'sort_direction' => $request->sort_direction, 'limit' => $request->limit, 'page' => $request->page, 'q' => $request->search])->with('success','Brand updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {



        $validator =  Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:brands'
        ]);

        if ($validator->fails()) {
            return redirect()->route('brand.index')
                ->withErrors($validator)
                ->withInput();
        }

        $brand = Brand::find($id);
        $brand->delete();

        return redirect()->route('brand.index')->with('success','Brand deleted successfully');
    }
}
