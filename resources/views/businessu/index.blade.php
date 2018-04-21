@extends('layout.default')
@section('title','我的店铺')
@section('content')
    <div class="jumbotron">
        <h1>你好:{{\Illuminate\Support\Facades\Auth::user()->name}}</h1>
        <p>欢迎你加入饿了吧大家庭,我们会竭诚为您服务</p>
        <p><a class="btn btn-primary btn-lg" href="{{route('businessuser.edit',\Illuminate\Support\Facades\Auth::user()->id)}}" role="button">去我的店铺</a></p>
    </div>
@stop