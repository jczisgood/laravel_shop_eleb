@extends('layout.default')
@section('title','订单管理')
@section('content')
    <form class="form-inline" action="{{route('/ordercount')}}" method="get">
        <div class="form-group">
            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
            <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
                <input type="date" class="form-control" id="exampleInputAmount" name="start_time">
                <input type="date" class="form-control" id="exampleInputAmount" name="end_time">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">搜索</button>
    </form>
    <table class="table table-bordered table-responsive" id="mytable">
        <tr>
            <th>订单数量</th>
        </tr>
            <tr>
                <td>{{$orders[0]->c}}</td>
            </tr>
    </table>
@stop