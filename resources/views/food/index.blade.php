@extends('layout.default')
@section('title')
{{$commodity->name}}食物列表
@stop
    @section('content')
        <form class="form-inline" action="{{route('foods.index',$commodity->id)}}" method="get">
            <div class="form-group">
                <a href="{{route('foods.create',$commodity->id)}}" class="btn btn-danger">添加</a>
                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                <div class="input-group">
                    <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
                    <input type="text" class="form-control" id="exampleInputAmount" name="keywords">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">搜索</button>
        </form>
        <table class="table table-responsive table-bordered" id="mytable">
            <tr>
                <th>形象图片</th>
                <th>菜名</th>
                <th>评分</th>
                <th>价格</th>
                <th>操作</th>
            </tr>
            @foreach($foods as $food)
            <tr data-id="{{$food->id}}">
                <td><img src="{{$food->goods_img}}" alt="" class="img-circle"></td>
                <td>{{$food->name}}</td>
                <td>{{$food->rating}}</td>
                <td>{{$food->goods_price}}</td>
                <td>
                    <a href="{{route('foods.destroy',$food->id)}}" class="btn btn-danger">删除</a>
                    <a href="{{route('foods.edit',$food->id)}}" class="btn btn-info">修改</a>
                    <a href="{{route('foods.show',$food->id)}}" class="btn btn-primary">查看</a>
                </td>
            </tr>
                @endforeach
        </table>
        {{$foods->appends($name)->links()}}
    @stop
@section('js')
    {{--<script>--}}
        {{--$('#mytable .btn-danger').click(function () {--}}
            {{--var tr=$(this).closest('tr')--}}
            {{--var id=tr.data('id')--}}
            {{--$.ajax({--}}
                {{--url:'delete/'+id,--}}
                {{--type:'DELETE',--}}
                {{--data:'_token={{csrf_token()}}',--}}
                {{--success:function (msg) {--}}
                    {{--tr.remove();--}}
                {{--}--}}
            {{--})--}}
        {{--})--}}
    {{--</script>--}}
@stop