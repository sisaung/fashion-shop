<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fit;
use App\Http\Requests\StoreFitRequest;
use App\Http\Requests\UpdateFitRequest;
use App\Models\ProductType;
use Illuminate\Support\Facades\Auth;

class FitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fit = Fit::with('productTypes')->get();
        return $fit;
       return view('admin.fit.index',['fits' => $fit]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $productType = ProductType::all();
        return view('admin.fit.create', ['productTypes' => $productType]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFitRequest $request)
    {
        $fit =  Fit::create([
            'fit_name' => $request->fit_name,
            'user_id' => Auth::id()
        ]);

        $fit->productTypes()->attach($request->product_type_id);


        return redirect()->route('fit.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fit $fit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fit $fit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFitRequest $request, Fit $fit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fit $fit)
    {
        //
    }
}
