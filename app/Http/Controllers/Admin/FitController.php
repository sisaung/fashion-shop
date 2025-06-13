<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fit;
use App\Http\Requests\StoreFitRequest;
use App\Http\Requests\UpdateFitRequest;
use App\Models\ProductType;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validSortColumns = ['fit_name', 'name', 'id'];
        $sortBy = in_array($request->input('sort_by'), $validSortColumns) ? $request->input('sort_by') : 'id';

        $sortDirection = in_array($request->input('sort_direction'), ['asc', 'desc']) ? $request->input('sort_direction') : 'desc';


        $limit = $request->input('limit', 5);

        $limit = is_numeric($limit) && $limit > 0 ? $limit : 5;

        $searchTerm = $request->input('q');

        $query = Fit::with('productTypes');

        if ($searchTerm) {

            $query->where(function (Builder $q) use ($searchTerm) {

                return $q->where('fit_name', 'like', "%$searchTerm%")

                    ->orWhereHas('productTypes', function (Builder $q) use ($searchTerm) {
                        return $q->where('name', 'like', "%$searchTerm%");
                    });
            });
        }

        $query->leftJoin('fit_product_type', 'fits.id', '=', 'fit_product_type.fit_id')
            ->leftJoin('product_types', 'fit_product_type.product_type_id', '=', 'product_types.id')
            ->select("fits.*")
            ->groupBy(['fits.id', 'fit_name', 'user_id', 'created_at', 'updated_at']);

        $query->orderBy($sortBy, $sortDirection);

        $fit = $query->paginate($limit);
        $fit->appends([
            'q' => $searchTerm,
            'sort_by' => $sortBy,
            'sort_direction' => $sortDirection,
            'limit' => $limit
        ]);



        return view('admin.fit.index', ['fits' => $fit]);
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

        // $fit->productTypes()->attach($request->product_type_id);


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
    public function edit($id, Request $request)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:fits'
        ]);

        if ($validator->fails()) {
            return redirect()->route('fit.index')
                ->withErrors($validator)
                ->withInput();
        }
        $productTypes = ProductType::all();

        $fit = Fit::with('productTypes')->find($id);

        return view('admin.fit.edit', ['fit' => $fit, 'productTypes' => $productTypes, 'sort_by' => $request->sort_by, 'sort_direction' => $request->sort_direction, 'limit' => $request->limit, 'page' => $request->page, 'q' => $request->q]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFitRequest $request, $id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:fits'
        ]);

        if ($validator->fails()) {
            return redirect()->route('fit.index')
                ->withErrors($validator)
                ->withInput();
        }


        $fit = Fit::with('productTypes')->find($id);




        $fit->fit_name = $request->fit_name;
        // $fit->productTypes()->sync($request->product_type_id);
        $fit->save();
        return redirect()->route('fit.index', ['sort_by' => $request->sort_by, 'sort_direction' => $request->sort_direction, 'limit' => $request->limit, 'page' => $request->page, 'q' => $request->q]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:fits'
        ]);

        if ($validator->fails()) {
            return redirect()->route('fit.index')
                ->withErrors($validator)
                ->withInput();
        }

        $fit = Fit::find($id);
        $fit->delete();

        return redirect()->route('fit.index');
    }

    public function getFits($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:product_types'
        ]);

        if ($validator->fails()) {
            return redirect()->route('product-type.index')
                ->withErrors($validator)
                ->withInput();
        }

        $fits = Fit::whereHas('productTypes', function ($query) use ($id) {
            $query->where('product_types.id', $id);
        })->get();

        return response()->json($fits);
    }
}
