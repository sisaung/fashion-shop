<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use App\Http\Requests\StoreSizeRequest;
use App\Http\Requests\UpdateSizeRequest;
use App\Models\ProductType;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validSortColumns = ['size_name', 'name', 'id'];
        $sortBy = in_array($request->input('sort_by'), $validSortColumns) ? $request->input('sort_by') : 'id';

        $sortDirection = in_array($request->input('sort_direction'), ['asc', 'desc']) ? $request->input('sort_direction') : 'desc';


        $limit = $request->input('limit', 5);

        $limit = is_numeric($limit) && $limit > 0 ? $limit : 5;

        $searchTerm = $request->input('q');

        $query = Size::with('productTypes');

        if ($searchTerm) {

            $query->where(function (Builder $q) use ($searchTerm) {

                return $q->where('size_name', 'like', "%$searchTerm%")

                    ->orWhereHas('productTypes', function (Builder $q) use ($searchTerm) {
                        return $q->where('name', 'like', "%$searchTerm%");
                    });
            });
        }

        $query->leftJoin('product_type_size', 'sizes.id', '=', 'product_type_size.size_id')
            ->leftJoin('product_types', 'product_type_size.product_type_id', '=', 'product_types.id')
            ->select("sizes.*")
            ->groupBy(['sizes.id', 'size_name', 'user_id', 'created_at', 'updated_at']);

        $query->orderBy($sortBy, $sortDirection);

        $size = $query->paginate($limit);
        $size->appends([
            'q' => $searchTerm,
            'sort_by' => $sortBy,
            'sort_direction' => $sortDirection,
            'limit' => $limit
        ]);
        return view('admin.size.index', ['sizes' => $size]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productType = ProductType::all();
        return view('admin.size.create', ['productTypes' => $productType]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSizeRequest $request)
    {
        $size = Size::create([
            'size_name' => $request->size_name,
            'user_id' => Auth::id()
        ]);

        // $size->productTypes()->attach($request->product_type_id);
        return redirect()->route('size.index')->with('success','Size created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Size $size)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:sizes'
        ]);

        if ($validator->fails()) {
            return redirect()->route('size.index')
                ->withErrors($validator)
                ->withInput();
        }
        $productTypes = ProductType::all();

        $size = Size::with('productTypes')->find($id);

        return view('admin.size.edit', ['size' => $size, 'productTypes' => $productTypes, 'sort_by' => $request->sort_by, 'sort_direction' => $request->sort_direction, 'limit' => $request->limit, 'page' => $request->page, 'q' => $request->q]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSizeRequest $request, $id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:sizes'
        ]);

        if ($validator->fails()) {
            return redirect()->route('size.index')
                ->withErrors($validator)
                ->withInput();
        }


        $size = Size::with('productTypes')->find($id);

        $size->size_name = $request->size_name;
        // $size->productTypes()->sync($request->product_type_id);
        $size->save();
        return redirect()->route('size.index', ['sort_by' => $request->sort_by, 'sort_direction' => $request->sort_direction, 'limit' => $request->limit, 'page' => $request->page, 'q' => $request->q])->with('success','Size updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:sizes'
        ]);

        if ($validator->fails()) {
            return redirect()->route('size.index')
                ->withErrors($validator)
                ->withInput();
        }

        $size = Size::find($id);
        $size->delete();

        return redirect()->route('size.index')->with('success','Size deleted successfully');
    }
}
