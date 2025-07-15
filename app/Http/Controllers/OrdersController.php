<?php

namespace App\Http\Controllers;

use App\Models\OrderProducts;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customers,id'
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        Orders::create([
            'customer_id' => $request->input('customer_id')
        ]);

        return response()->json(['message' => 'Order created successfully'], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $order_id)
    {
        $order = Orders::find($order_id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Validate the request
        $validator = Validator::make($request->all(), [
            'products' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        OrderProducts::create([
            'order_id' => $order_id,
            'product_id' => $request->input('products'),
            'quantity' => $request->input('quantity')
        ]);

        return response()->json(['message' => 'Order updated successfully'], 200);
    }
}
