@extends('layouts.app')
@section('title', '提示')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">提示</div>
    <div class="panel-body text-center">
        <h2>请先验证邮箱</h2>
        <a class="btn btn-primary" href="{{ route('email_verification.send') }}">发送邮箱验证链接</a>
    </div>
</div>
@stop