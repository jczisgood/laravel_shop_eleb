@extends('layout.default')
@section('title','我的店铺')
@section('content')
    <div class="jumbotron">
        <h1>你好:{{\Illuminate\Support\Facades\Auth::user()->name}}</h1>
        <p>欢迎你加入饿了吧大家庭,我们会竭诚为您服务</p>
        <p><a class="btn btn-primary btn-lg" href="{{route('businessuser.edit',\Illuminate\Support\Facades\Auth::user()->id)}}" role="button">去我的店铺</a></p>
    </div>
    <h3>活动列表</h3>
<table class="table table-responsive table-bordered">
    <tr>
        <th>标题</th>
        <th>开始时间</th>
        <th>结束时间</th>
        <th>操作</th>
    </tr>
    @foreach($rows as $row)
    <tr>
        <td>{{$row->title}}</td>
        <td>{{date('Y-m-d',$row->start_time)}}</td>
        <td>{{date('Y-m-d',$row->end_time)}}</td>
        <td><a href="{{route('activity.showa',$row->id)}}">查看</a></td>
    </tr>
        @endforeach
</table>
@stop