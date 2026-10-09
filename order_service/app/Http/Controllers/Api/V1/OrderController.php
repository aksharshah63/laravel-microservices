<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::query()->where('user_id', $request->user_id)
            ->paginate();

        return response()->json($orders);
    }

    public function create(Request $request)
    {
        $order = new Order;
        $order->user_id = $request->user_id;
        $order->total_price = 100;
        $order->save();
        event(new OrderCreated($order));

        return response()->json($order);
    }
}
