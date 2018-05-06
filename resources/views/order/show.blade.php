@extends('layout.default')
@section('title','订单详情')
    @section('content')
        <h1>订单详情</h1>
        <div>订单编号 {{$order->order_code}}</div>
        <div>订单状态:</div>
        @if($order->order_status==0)
            <th>待付款</th>
        @endif
        @if($order->order_status==1)
            <th>成功</th>
        @endif
        @if($order->order_status==2)
            <th>取消订单</th>
        @endif
        <p>配送地点详情</p>
        <strong>{{$order->receipt_provence. $order->receipt_city .$order->receipt_area. $order->receipt_detail_address}}</strong>
        <hr>
        <strong>价格:{{$order->order_price}}</strong>
        <br>
        @if($order->order_status!=2 &&$order->order_status!=1)
        <form action="{{route('order.update',$order->id)}}" method="post">
            {{csrf_field()}}
            {{method_field('PUT')}}
        <button class="btn btn-danger">取消订单</button>
        </form>
        @endif
        @if($order->order_status==0)
            <a href="{{route('order.send',$order->id)}}" class="btn btn-success">发货</a>
        @endif
    @stop
