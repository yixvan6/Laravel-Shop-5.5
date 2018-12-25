@extends('layouts.app')
@section('title', '验证提示')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">提示</div>
    <div class="panel-body text-center">
        <h2>感谢您的注册，{{ $msg }}</h2>
        <a class="btn btn-primary" href="{{ route('email_verification.send') }}">发送邮箱验证链接</a>
    </div>
</div>
@stop