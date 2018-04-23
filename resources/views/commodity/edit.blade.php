@extends('layout.default')
@section('title','食品分类')
@section('content')
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>分类添加</h5>
            </div>
            <div class="panel-body">
                <form method="post" action="{{ route('commodity.update',$commodity->id) }}">
                    {{ csrf_field() }}
                    {{method_field('PUT')}}
                    <div class="form-group">
                        <label for="name">描述:</label>
                        <input type="text" name="description" class="form-control" value="{{$commodity->description}}">
                    </div>

                    <div class="form-group">
                        <label for="name">名称：</label>
                        <input type="text" name="name" class="form-control" value="{{ $commodity->name }}">
                    </div>
                    <div class="form-group">
                        <label for="password">是否选中：</label>
                        <input type="checkbox" name="is_selected" class="form-control" value="1"{{$commodity->is_selected=='1'?'checked':''}}>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">验证码</label>
                        <input id="captcha" class="form-control" name="captcha" >
                        <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
                    </div>
                    <button type="submit" class="btn btn-primary">登录</button>
                </form>

                <hr>

            </div>
        </div>
    </div>
@stop