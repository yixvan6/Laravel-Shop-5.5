<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Order;

class CloseOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order, $delay)
    {
        $this->order = $order;
        $this->delay($delay);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // 判断是否订单已支付
        if ($this->order->paid_at) {
            return;
        }

        // 若没有支付则关闭订单
        \DB::transaction(function () {
            $this->order->update(['closed' => true]);
            // 回退库存
            foreach ($this->order->items as $item) {
                $item->productSku->addStock($item->amount);
            }
            // 回退优惠券使用量
            if ($this->order->coupon_code) {
                $this->order->coupon_code->changeUsed(false);
            }
        });
    }
}