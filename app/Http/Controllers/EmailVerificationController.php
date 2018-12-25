<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\User;
use App\Notifications\EmailVerificationNotification;
use App\Exceptions\InvalidRequestException;

class EmailVerificationController extends Controller
{
    public function send(Request $request)
    {
        $user = $request->user();

        if ($user->email_verified) {
            throw new InvalidRequestException('已经验证过邮箱');
        }

        $user->notify(new EmailVerificationNotification());

        return view('pages.info', ['success' => '邮件发送成功']);
    }

    public function verify(Request $request)
    {
        $email = $request->email;
        $token = $request->token;

        if (!$email || !$token) {
            throw new InvalidRequestException('验证链接不正确');
        }

        if (!$code = \Cache::get('email_verification_'.$email)) {
            throw new InvalidRequestException('验证链接不正确或已过期');
        }

        if (!hash_equals($token, $code)) {
            throw new InvalidRequestException('验证链接不正确或已失效');
        }

        // 为了代码的健壮性还是需要这个判断
        if (!$user = User::where('email', $email)->first()) {
            throw new InvalidRequestException('用户不存在');
        }

        // 验证通过
        \Cache::forget('email_verification_'.$email);
        $user->email_verified = true;
        $user->save();

        return view('pages.info', ['success' => '邮箱验证成功！']);
    }
}
