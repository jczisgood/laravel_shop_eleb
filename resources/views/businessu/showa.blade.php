@extends('layout.default')
@section('title','活动详情')
    @section('content')
    <h1>{{$activity->title}}</h1>
       <p>活动时间 {{date('Y-m-d',$activity->start_time)}}-----{{date('Y-m-d',$activity->end_time)}}</p>
    <div>{!! $activity->contents !!}</div>
    @stop