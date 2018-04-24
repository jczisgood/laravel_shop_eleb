@extends('layout.default')
@section('title','显示')
@section('content')
    @if(\Illuminate\Support\Facades\Auth::user()->status==0)
        {{'你的商店还没有注册成功'}}
    @else
    <div class="panel panel-warning">
        <a class="btn btn-group" href="{{ route('businessuser.show',\Illuminate\Support\Facades\Auth::user()->id) }}">完善商品信息</a>
        <h2 class="bg-primary">商铺名称:{{ $row[0]->shop_name }}</h2>
        <div class="container">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10" style="position: relative;">
                    <ul class="list-group">
                        <li>店铺LOGO:<img style="position: absolute;right: 0;" src="{{$row[0]->shop_img}}" alt=""></li>
                        <li>店铺评分:&emsp;{{$row[0]->shop_rating}}</li>
                        <li>是否品牌:&emsp;{{$row[0]->brand==0?'否':'是'}}</li>
                        <li>是否准时:&emsp;{{$row[0]->on_time==0?'否':'是'}}</li>
                        <li>是否蜂鸟:&emsp;{{$row[0]->fengniao==0?'否':'是'}}</li>
                        <li>是否保标:&emsp;{{$row[0]->bao==0?'否':'是'}}</li>
                        <li>是否票标:&emsp;{{$row[0]->piao==0?'否':'是'}}</li>
                        <li>是否准标:&emsp;{{$row[0]->zhun==0?'否':'是'}}</li>
                        <li>起送金额:&emsp;{{$row[0]->start_send}}</li>
                        <li>配送费用:&emsp;{{$row[0]->send_cost}}</li>
                        <li>预计时间:&emsp;{{$row[0]->estimate_time}}</li>
                        <li>小店公告:&emsp;{{$row[0]->notice}}</li>
                        <li>优惠信息:&emsp;{{$row[0]->discount}}</li>
                    </ul>
                </div>
                <div class="col-sm-1"></div>
            </div>
        </div>
    </div>
    @endif
@stop