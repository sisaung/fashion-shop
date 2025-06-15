<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validSortColumns = ['coupon_title','coupon_code','coupon_discount' ,'id'];
        $sortBy = in_array($request->input('sort_by'), $validSortColumns) ? $request->input('sort_by') : 'id';

        $sortDirection = in_array($request->input('sort_direction'), ['asc', 'desc']) ? $request->input('sort_direction') : 'desc';


        $limit = $request->input('limit', 5);

        $limit = is_numeric($limit) && $limit > 0 ? $limit : 5;

        $searchTerm = $request->input('q');

        $query = Coupon::query();

        if ($searchTerm) {

            $query->where('coupon_title', 'like', "%$searchTerm%")
            ->orWhere('coupon_code', 'like', "%$searchTerm%")
            ->orWhere('coupon_discount', 'like', "%$searchTerm%");
        }

        $query->orderBy($sortBy, $sortDirection);

        $coupon = $query->paginate($limit);
        $coupon->appends([
            'q' => $searchTerm,
            'sort_by' => $sortBy,
            'sort_direction' => $sortDirection,
            'limit' => $limit
        ]);



        return view('admin.coupon.index', ['coupons' => $coupon] );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCouponRequest $request)
    {
       Coupon::create([
        'coupon_title' => $request->coupon_title,
        'coupon_code' => strtoupper($request->coupon_code),
        'coupon_discount' => $request->coupon_discount,
        'coupon_expire_date' => $request->coupon_expire_date,
        'is_active' => false,
        'user_id' => Auth::id()
       ]);

       return redirect()->route('coupon.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id,Request $request)
    {
        $validator =  Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:coupons'
        ]);

        if ($validator->fails()) {
            return redirect()->route('coupon.index')
                ->withErrors($validator)
                ->withInput();
        }

        $coupon = Coupon::find($id);

        return view('admin.coupon.edit', ['coupon' => $coupon,'sort_by' => $request->sort_by, 'sort_direction' => $request->sort_direction, 'limit' => $request->limit, 'page' => $request->page, 'q' => $request->q]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCouponRequest $request, $id)
    {
        $validator =  Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:coupons'
        ]);

        if ($validator->fails()) {
            return redirect()->route('coupon.index')
                ->withErrors($validator)
                ->withInput();
        }

        $coupon = Coupon::find($id);

        $coupon->coupon_title = $request->coupon_title;
        $coupon->coupon_code = $request->coupon_code;
        $coupon->coupon_discount = $request->coupon_discount;
        $coupon->coupon_expire_date = $request->coupon_expire_date;
        $coupon->save();

        return redirect()->route('coupon.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $validator =  Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:coupons'
        ]);

        if ($validator->fails()) {
            return redirect()->route('coupon.index')
                ->withErrors($validator)
                ->withInput();
        }

        $coupon = Coupon::find($id);
        $coupon->delete();
        return redirect()->route('coupon.index');
    }
}
