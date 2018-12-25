<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function root()
    {
        return view('pages.root');
    }

    public function emailVerifyNotice(Request $request)
    {
        $msg = $request->msg ?: '请先验证邮箱';

        return view('pages.email_verify_notice', compact('msg'));
    }
}
