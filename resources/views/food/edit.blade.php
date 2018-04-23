@extends('layout.default')
@section('title')
  食物修改
@stop
@section('content')
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 bg-info">
                <form action="{{ route('foods.update',$food->id) }}" method="post" enctype="multipart/form-data">
                    <br>
                    原图: <img src="{{$food->goods_img}}" alt="" width="40px"><br>
                    <div id="uploader-demo">
                        <!--用来存放item-->
                        <div id="fileList" class="uploader-list"></div>
                        <div id="filePicker">选择图片</div>
                    </div>
                    <div>
                        <img src="" id="img" alt="" width="100px">
                    </div>
                    <input type="hidden" name="goods_img" value="" id="hidden">
                    食物名称:<input class="form-control" type="text" name="name" value="{{$food->name}}" placeholder="食品名称"><br>
                    价格:<input class="form-control" type="number" name="goods_price" value="{{$food->goods_price}}" placeholder="价格"><br>
                    食物描述:<textarea class="form-control" name="description">{{$food->description}}</textarea><br>
                    提示信息:<textarea class="form-control" name="tips">{{$food->tips}}</textarea><br>
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

            $('#img').attr('src',response.file);
            $('#hidden').val(response.file)
        });
    </script>
@stop