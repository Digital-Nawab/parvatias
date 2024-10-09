<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $data = $request->all();
        //AddProduct
        $rules = [
            'product_id'    => 'required|',
            'stock_remain'  => 'required',
            'stock_add'     => 'required',
            'stock_final'   => 'required',
            'old_price'   => 'required',
            'new_price'   => 'required',
        ];
        $customMessages = [
            'product_id.required'   => 'The Product  Selection is required.',
            'stock_remain.required' => 'The Product remail Stock Not found.',
            'stock_add'             => 'Add stock is required.',
            'stock_final.required'  => 'The Product URL is required.',
            'old_price.required'    => 'The Product Old Price Not Found.',
            'new_price.required'    => 'The Product Old Price Not Found.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $product = Product::find($id);
            
            if ($id != "") {
                $stock = [
                    'stock_quantity' => $data['stock_final'] , 
                    'product_price'  => $data['new_price'] , 
                ];
                Stock::create($data);
                $product->update($stock);
             } else {
                return redirect()->back()->with('error', 'Product not found.')->withInput();
             }
             return redirect()->back()->with('success_msg', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
