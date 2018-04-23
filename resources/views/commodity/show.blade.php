@extends('layout.default')
@section('title','分类查看')
    @section('content')
    <h2>{{$commodity->name}}</h2>
    <p>上线时间{{$commodity->created_at}}</p>
    <p>{{$commodity->description}}</p>
    @stop