<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
   
    public function index()
    {
        $coupons = Coupon::all();
        return view('coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('coupons.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'coupon_code' => 'required|unique:coupons|max:255',
            'coupon_type' => 'required',
            'coupon_amount' => 'required|numeric',
            'amount_type' => 'required',
            'expiry_date' => 'required|date',
            'status' => 'required|integer'
        ]);

        Coupon::create($validated);

        return redirect()->route('coupons.index')->with('success', 'Coupon created successfully');
    }

    public function show(Coupon $coupon)
    {
        return view('coupons.show', compact('coupon'));
    }

    
    public function edit(Coupon $coupon)
    {
        return view('coupons.edit', compact('coupon'));
    }

    
    public function update(Request $request, Coupon $coupon)
    {
        $validated = $request->validate([
            'coupon_code' => 'required|max:255|unique:coupons,coupon_code,' . $coupon->id,
            'coupon_type' => 'required',
            'coupon_amount' => 'required|numeric',
            'amount_type' => 'required',
            'expiry_date' => 'required|date',
            'status' => 'required|integer'
        ]);

        $coupon->update($validated);

        return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('coupons.index')->with('success', 'Coupon deleted successfully');
    }
}
