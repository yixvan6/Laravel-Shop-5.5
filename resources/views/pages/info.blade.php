@extends('layouts.app')
@section('title', '提示信息')

@section('content')
@if (isset($success))
    <div class="panel panel-default">
        <div class="panel-heading">操作成功</div>
        <div class="panel-body text-center text-success">
            <h2>{{ $success }}</h2>
            <a class="btn btn-primary" href="{{ route('root') }}">返回首页</a>
        </div>
    </div>
@endif

@if (isset($error))
    <div class="panel panel-default">
        <div class="panel-heading">错误</div>
        <div class="panel-body text-center text-danger">
            <h2>{{ $error }}</h2>
            <a class="btn btn-primary" href="{{ route('root') }}">返回首页</a>
        </div>
    </div>
@endif

@if (isset($info))
    <div class="panel panel-default">
        <div class="panel-heading">提示信息</div>
        <div class="panel-body text-center">
            <h2>{{ $info }}</h2>
            <a class="btn btn-primary" href="{{ route('root') }}">返回首页</a>
        </div>
    </div>
@endif
@stop