<?php

use Faker\Generator as Faker;
use App\Models\User;
use App\Models\Order;
use App\Models\CouponCode;

$factory->define(Order::class, function (Faker $faker) {
    // 随机取一个用户
    $user = User::query()->inRandomOrder()->first();
    // 随机取用户的一个地址
    $address = $user->addresses()->inRandomOrder()->first();
    // 退款率设为 10%
    $refund = random_int(0, 9) < 1;
    // 随机生成发货状态
    $ship = $faker->randomElement(array_keys(Order::$shipStatusMap));
    // 优惠券
    $coupon = null;
    // 30% 概率订单使用了优惠券
    if (random_int(0, 9) < 3) {
        // 为了避免逻辑错误，只选择没有最低金额限制的优惠券
        $coupon = CouponCode::query()->where('min_amount', 0)->inRandomOrder()->first();
        $coupon->changeUsed();
    }

    return [
        'user_id' => $user->id,
        'address' => [
            'address' => $address->full_address,
            'zip' => $address->zip,
            'contact_name' => $address->contact_name,
            'contact_phone' => $address->contact_phone,
        ],
        'total_amount' => 0,
        'remark' => $faker->sentence,
        'paid_at' => $faker->dateTimeBetween('-30 days'), // 30天内任意时间
        'payment_method' => $faker->randomElement(['alipay', 'wechat']),
        'payment_no' => $faker->uuid,
        'coupon_code_id' => $coupon ? $coupon->id : null,
        'refund_status' => $refund ? Order::REFUND_STATUS_SUCCESS : Order::REFUND_STATUS_PENDING,
        'refund_no' => $refund ? Order::getAvailableRefundNo() : null,
        'closed' => false,
        'reviewed' => random_int(0, 9) > 2,
        'ship_status' => $ship,
        'ship_data' => $ship === Order::SHIP_STATUS_PENDING ? null : [
            'express_company' => $faker->company,
            'express_no' => $faker->uuid,
        ],
        'extra' => $refund ? ['refund_reason' => $faker->sentence] : [],
    ];
});