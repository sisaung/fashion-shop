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

        $query->join('fit_product_type', 'fits.id', '=', 'fit_product_type.fit_id')
            ->join('product_types', 'fit_product_type.product_type_id', '=', 'product_types.id')
            ->select("fits.*");

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
