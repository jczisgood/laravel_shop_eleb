@extends('layout.default')
@section('title','订单管理')
@section('content')
    <form class="form-inline" action="{{route('/foodlist')}}" method="get">
        <div class="form-group">
            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
            <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
                开始时间:<input type="date" class="form-control" id="exampleInputAmount" name="start_time">
                结束时间:<input type="date" class="form-control" id="exampleInputAmount" name="end_time">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">搜索</button>
    </form>
    <table class="table table-bordered table-responsive" id="mytable">
        商品销量排行榜
        @if($timer)
        开始时间---{{$timer['start']}}结束时间---{{$timer['end']}}
        @endif
        <tr>
            <th>排行</th>
            <th>商品名称</th>
            <th>销量</th>
        </tr>
       <?php $a=0?>
        @foreach($orders as $order)
        <tr>
            <td>{{++$a}}</td>
            <td>{{$order->goods_name}}</td>
            <td>{{$order->number}}</td>
        </tr>
            @endforeach
    </table>
@stop