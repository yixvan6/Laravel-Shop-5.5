<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;
use App\Models\UserAddress;
use App\Models\Order;
use App\Services\OrderService;
use App\Exceptions\InvalidRequestException;

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

    public function received(Request $request, Order $order)
    {
        $this->authorize('own', $order);

        if ($order->ship_status !== Order::SHIP_STATUS_DELIVERED) {
            throw new InvalidRequestException('物流状态错误');
        }

        // 更新物流状态
        $order->update(['ship_status' => Order::SHIP_STATUS_RECEIVED]);

        return $order;
    }
}