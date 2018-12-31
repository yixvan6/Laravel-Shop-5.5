<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidRequestException;
use App\Http\Requests\OrderRequest;
use App\Models\UserAddress;
use App\Models\ProductSku;
use App\Models\Order;
use Carbon\Carbon;
use App\Jobs\CloseOrder;

class OrdersController extends Controller
{
    public function store(OrderRequest $request)
    {
        $user = $request->user();

        // 开启数据库事务
        $order = \DB::transaction(function () use ($user, $request) {
            $address = UserAddress::find($request->address_id);
            $address->update(['last_used_at' => Carbon::now()]);

            // 创建订单
            $order = new Order([
                'address' => [
                    'address' => $address->full_address,
                    'zip' => $address->zip,
                    'contact_name' => $address->contact_name,
                    'contact_phone' => $address->contact_phone,
                ],
                'remark' => $request->remark,
                'total_amount' => 0,
            ]);

            //订单与用户关联
            $order->user()->associate($user);
            $order->save();

            $totalAmount = 0;
            $items = $request->items;
            foreach ($items as $data) {
                $sku = ProductSku::find($data['sku_id']);

                $item = $order->items()->make([
                    'amount' => $data['amount'],
                    'price' => $sku->price,
                ]);
                $item->product()->associate($sku->product_id);
                $item->productSku()->associate($sku);
                $item->save();
                $totalAmount += $sku->price * $data['amount'];
                if ($sku->decreaseStock($data['amount']) <= 0) {
                    throw new InvalidRequestException('商品库存不足');
                }
            }

            $order->update(['total_amount' => $totalAmount]);

            $skuIds = collect($items)->pluck('sku_id');
            $user->cartItems()->whereIn('product_sku_id', $skuIds)->delete();

            $this->dispatch(new CloseOrder($order, config('app.order_ttl')));

            return $order;
        });

        return $order;
    }
}