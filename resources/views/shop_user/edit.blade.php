@extends('layout.default')
@section('title','商家注册')
@section('content')
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>商家修改</h5>
            </div>
            <div class="panel-body">
                <form method="post" action="{{ route('shopusers.update',$shopuser->id) }}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="name">用户名：</label>
                        <input type="text" name="name" class="form-control" value="{{ $shopuser->name }}">
                    </div>

                    <div class="form-group">
                        <label for="password">联系电话：</label>
                        <input type="number" name="phone" class="form-control" value="{{ $shopuser->phone }}">
                    </div>
                    <div class="form-group">
                        <label for="password">产品分类：</label>
                        <select name="category_id" id="">
                            {{--@foreach($categories as $key=>$category)--}}
                            <option value="1">早餐</option>
                            <option value="2">午餐</option>
                            <option value="3">晚餐</option>
                            {{--@endforeach--}}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">验证码</label>
                        <input id="captcha" class="form-control" name="captcha" >
                        <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
                    </div>
                    <button type="submit" class="btn btn-primary">修改</button>
                </form>

                <hr>

            </div>
        </div>
    </div>
@stop