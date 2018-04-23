@extends('layout.default')
@section('title')
    {{$commodity->name}}食物添加
@stop
@section('content')
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 bg-info">
                <p>分类名称:{{$commodity->name}}</p>
                <form action="{{ route('foods.store',$commodity->id) }}" method="post" enctype="multipart/form-data">
                    <br>
                    {{--食物图片:<input class="form-control" type="file" name="goods_img" placeholder="食品LOGO"><br>--}}
                <!--dom结构部分-->
                    <div id="uploader-demo">
                        <!--用来存放item-->
                        <div id="fileList" class="uploader-list"></div>
                        <div id="filePicker">选择图片</div>
                    </div>
                    <div>
                        {{--<img src="" alt="">--}}
                        <img src="" id="img" alt="" width="100px">
                    </div>
                    <input type="hidden" name="goods_img" value="" id="hidden">
                    食物名称:<input class="form-control" type="text" name="name" value="{{old('name')}}" placeholder="食品名称"><br>
                    价格:<input class="form-control" type="number" name="goods_price" value="{{old('goods_price')}}" placeholder="起送金额"><br>
                    食物描述:<textarea class="form-control" name="description">{{old('description')}}</textarea><br>
                    提示信息:<textarea class="form-control" name="tips">{{old('tips')}}</textarea><br>
                    <input class="form-control" type="submit"><br>
                    {{ csrf_field() }}
                </form>
            </div>
            {{--<div class="col-sm-3" style="position: relative"><img style="position: absolute;right: 17px;top: 0;" src="{{$shop_business->shop_img}}" alt=""></div>--}}
        </div>
@stop
@section('js')
    <!--引入JS-->
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    <script>
        // 初始化Web Uploader
        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,

            // swf文件路径
            swf: '/webuploader/Uploader.swf',

            // 文件接收服务端。
            server: '/set',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',
            formData: {'_token':'{{ csrf_token() }}'},
            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });
        uploader.on( 'uploadSuccess', function( file,response  ) {
//            $( '#'+file.id ).find('p.state').text('已上传');

            $('#img').attr('src',response.file)
            $('#hidden').val(response.file)
        });
    </script>
@stop