<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class CouponCodeUnavailableException extends Exception
{
    public function __construct($message, int $code = 403)
    {
        parent::__construct($message, $code);
    }

    // 异常触发时，调用 render 方法
    public function render(Request $request)
    {
        // 若是 api 请求，返回 json 格式
        if ($request->expectsJson()) {
            return response()->json(['msg' => $this->message], $this->code);
        }

        return redirect()->back()->withErrors(['coupon_code' => $this->message]);
    }
}