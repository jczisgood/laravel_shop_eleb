@extends('layout.default')
@section('title','分类列表')
@section('content')
<form class="form-inline" action="{{route('commodity.index')}}" method="get">
    <div class="form-group">
        <a href="{{route('commodity.create')}}" class="btn btn-danger">添加</a>
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
        <th>名称</th>
        <th>是否默认选中</th>
        <th>创建时间</th>
        <th>操作</th>
    </tr>
    @foreach($commodities as $commodity)
    <tr data-id="{{$commodity->id}}">
        <th>{{$commodity->id}}</th>
        <th>{{$commodity->name}}</th>
        <th>{{$commodity->is_selected==1?'是':'否'}}</th>
        <th>{{$commodity->created_at}}</th>
        <th>
            <button class="btn btn-danger">删除</button>
            <a href="{{route('commodity.edit',$commodity->id)}}" class="btn btn-success">修改</a>
            <a href="{{route('commodity.show',$commodity->id)}}" class="btn btn-info">查看</a>
            <a href="{{route('foods.index',$commodity->id)}}" class="btn btn-info">去菜品</a>
        </th>
    </tr>
        @endforeach
</table>
{{$commodities->appends($name)->links()}}
@stop
@section('js')
    <script>
        $('#mytable .btn-danger').click(function () {
            var tr=$(this).closest('tr')
            var id=tr.data('id')
            $.ajax({
                url:'commodity/'+id,
                type:'DELETE',
                data:'_token={{csrf_token()}}',
                success:function () {
                    tr.remove();
                }
            })
            return false;
        })
    </script>
@stop