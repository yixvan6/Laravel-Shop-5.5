<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;
use App\Models\UserAddress;
use App\Models\Order;
use App\Services\OrderService;

class OrdersController extends Controller
{
    public function store(OrderRequest $request, OrderService $orderService)
    {
        $user = $request->user();
        $address = UserAddress::findOrFail($request->address_id);

        return $orderService->store($user, $address, $request->remark, $request->items);
    }

    public function index(Request $request)
    {
        $orders = Order::query()
            ->with(['items.product', 'items.productSku'])
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate();

        return view('orders.index', compact('orders'));
    }

    public function show(Request $request, Order $order)
    {
        $this->authorize('own', $order);

        return view('orders.show', ['order' => $order->load(['items.product', 'items.productSku'])]);
    }
}