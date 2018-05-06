@extends('layout.default')
@section('title','订单管理')
@section('content')
    <form class="form-inline" action="{{route('order.index')}}" method="get">
        <div class="form-group">
            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
            <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
                <input type="text" class="form-control" id="exampleInputAmount" name="keywords">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">搜索</button>
    </form>
    <table class="table table-bordered table-responsive" id="mytable">
        <tr>
            <th>ID</th>
            <th>订单编号</th>
            <th>订单状态</th>
            <th>消费金额</th>
            <th>操作</th>
        </tr>
        @foreach($orders as $order)
            <tr data-id="{{$order->id}}">
                <th>{{$order->id}}</th>
                <th>{{$order->order_code}}</th>
                @if($order->order_status==0)
                    <th>待付款</th>
                    @endif
                @if($order->order_status==1)
                    <th>成功</th>
                    @endif
                @if($order->order_status==2)
                    <th>取消订单</th>
                    @endif
                <th>{{$order->order_price}}</th>
                <th>
                    <a href="{{route('order.show',$order->id)}}" class="btn btn-info">详情</a>
                </th>
            </tr>
        @endforeach
    </table>
    {{$orders->appends($name)->links()}}
@stop