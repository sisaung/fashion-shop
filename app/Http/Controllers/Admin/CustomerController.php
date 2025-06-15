<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validSortColumns = ['customer_name','customer_email','city','township', 'id'];
        $sortBy = in_array($request->input('sort_by'), $validSortColumns) ? $request->input('sort_by') : 'id';

        $sortDirection = in_array($request->input('sort_direction'), ['asc', 'desc']) ? $request->input('sort_direction') : 'desc';


        $limit = $request->input('limit', 5);

        $limit = is_numeric($limit) && $limit > 0 ? $limit : 5;

        $searchTerm = $request->input('q');

        $query = Customer::query();

        if ($searchTerm) {

            $query->where('customer_name', 'like', "%$searchTerm%")
            ->where('customer_email','like',"%$searchTerm%")
            ->orwhereHas('addresses',function(Builder $q) use ($searchTerm){

                $q->where('city','like',"%$searchTerm%")
                ->where('township','like',"%$searchTerm%")
                ->where('address_detail')
                ->where('phone_number','like',"%$searchTerm%");
            });
        }

        $query->join('customer_addresses','customers.id','=','customer_addresses.customer_id')
        ->select('customers.*')
        ->groupBy('customers.id');

        $query->orderBy($sortBy, $sortDirection);

        $customer = $query->paginate($limit);
        $customer->appends([
            'q' => $searchTerm,
            'sort_by' => $sortBy,
            'sort_direction' => $sortDirection,
            'limit' => $limit
        ]);


        return view('admin.customer.index', ['customers' => $customer]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $validator =  Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:customers'
        ]);

        if ($validator->fails()) {
            return redirect()->route('customer.index')
                ->withErrors($validator)
                ->withInput();
        }

        $customer = Customer::find($id);
        return view('admin.customer.show', ['customer' => $customer]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
