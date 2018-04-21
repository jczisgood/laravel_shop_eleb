@extends('layout.default')
@section('title','商店详情')
    @section('content')
        @if(\Illuminate\Support\Facades\Auth::user()->status==0)
            {{'你的商店还没有注册成功'}}
        @else
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 bg-info">
                <p>商铺名称::{{\Illuminate\Support\Facades\Auth::user()->name}}</p>
                <form action="{{ route('businessuser.update',\Illuminate\Support\Facades\Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                    <br>
                    店铺LOGO:<input class="form-control" type="file" name="shop_img" placeholder="店铺LOGO"><br>

{{--                    店铺评分:<input class="form-control" type="text" name="shop_rating" value="{{$row[0]->shop_rating}}" placeholder="店铺评分"><br>--}}

                    <label>是否品牌:<input class="form-control" type="checkbox" name="brand" value="1" {{$row[0]->brand==1?'checked':''}}></label>
                    <label>是否准时:<input class="form-control" type="checkbox" name="on_time" value="1" {{$row[0]->on_time==1?'checked':''}}></label>
                    <label>是否蜂鸟:<input class="form-control" type="checkbox" name="fengniao" value="1" {{$row[0]->fengniao==1?'checked':''}}></label>
                    <label>是否保标:<input class="form-control" type="checkbox" name="bao" value="1" {{$row[0]->bao==1?'checked':''}}></label>
                    <label>是否票标:<input class="form-control" type="checkbox" name="piao" value="1" {{$row[0]->piao==1?'checked':''}}></label>
                    <label>是否准标:<input class="form-control" type="checkbox" name="zhun" value="1" {{$row[0]->zhun==1?'checked':''}}></label><br>

                    起送金额:<input class="form-control" type="number" name="start_send" value="{{$row[0]->start_send}}" placeholder="起送金额"><br>
                    配送费用:<input class="form-control" type="number" name="send_cost" value="{{$row[0]->send_cost}}" placeholder="配送费用"><br>
                    预计时间(分钟):<input class="form-control" type="number" name="estimate_time" value="{{$row[0]->estimate_time}}" placeholder="预计时间"><br>
                    小店公告:<textarea class="form-control" name="notice">{{$row[0]->notice}}</textarea><br>
                    优惠信息:<textarea class="form-control" name="discount">{{$row[0]->discount}}</textarea><br>
                    <input class="form-control" type="submit"><br>
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                </form>
            </div>
            {{--<div class="col-sm-3" style="position: relative"><img style="position: absolute;right: 17px;top: 0;" src="{{$row[0]->shop_img}}" alt=""></div>--}}
        </div>
        @endif
    @stop