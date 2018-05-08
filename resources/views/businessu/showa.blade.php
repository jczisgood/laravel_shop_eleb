@extends('layout.default')
@section('title','活动详情')
@section('content')
    <h1>{{$event->title}}</h1>
    <p>活动状态:{{$event->is_prize==1?'已开奖':'未开奖'}}</p>
    <p>活动时间:{{$event->signup_start}}-------{{$event->signup_end}}</p>
    <div style="color: red">开奖时间{{$event->signup_end}}</div>
    人数限制<strong style="color: red">{{$event->signup_num}}</strong><br>
    <h3>活动详情</h3>
    <div>{!!$event->content!!}</div>

    @if($event->is_prize)
        <a href="{{route('event.see',$event->id)}}" class="btn btn-info">查看中奖信息</a>
    @else
        @if($rows<$event->signup_num && $vals<1)
            <a href="{{route('event.join',$event->id)}}">参与活动</a>
        @endif
        @if($vals>1)
            你已经参与
        @else
            抱歉报名已满
        @endif
    @endif
@stop