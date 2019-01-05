<?php

namespace App\Http\Controllers;

use App\Models\CouponCode;
use Carbon\Carbon;

class CouponCodesController extends Controller
{
    public function show($code)
    {
        // 判断优惠券是否存在
        if (! $record = CouponCode::where('code', $code)->first()) {
            abort(404);
        }

        // 查看是否启用
        if (! $record->enabled) {
            return response()->json(['msg' => '优惠券未启用，暂不可用'], 403);
        }

        // 检查可用数量
        if ($record->total - $record->used <=0) {
            return response()->json(['msg' => '该优惠券已被兑完'], 403);
        }

        // 检查有效期限
        if ($record->not_before && $record->not_before->gt(Carbon::now())) {
            return response()->json(['msg' => '优惠券现在还不能使用'], 403);
        }
        if ($record->not_after && $record->not_after->lt(Carbon::now())) {
            return response()->json(['msg' => '优惠券已过期'], 403);
        }

        return $record;
    }
}