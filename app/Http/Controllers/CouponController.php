<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::paginate(10);
        return view('admin.viewcoupons', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.addcoupon');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $coupon = new Coupon();
        $coupon->code = $request->code;
        $coupon->discount = $request->discount;
        $coupon->save();

        return redirect()->route('coupons.index')->with('message', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.updatecoupon', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->code = $request->code;
        $coupon->discount = $request->discount;
        $coupon->save();
        return redirect()->route('coupons.index')->with('message', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        return redirect()->back()->with('message', 'Coupon deleted successfully');

    }
}
