@extends('admin.base')

@section('content')
    <link rel="stylesheet" href="/editor-master/css/style.css" />
    <link rel="stylesheet" href="/editor-master/css/editormd.css" />
    <link rel="shortcut icon" href="https://pandao.github.io/editor.md/favicon.ico" type="image/x-icon" />
    <script src="{{asset('lrz/dist/lrz.bundle.js')}}" type="text/javascript"></script>


    <form class="layui-form" action="{{route('admin.article.update_mark',['id'=>$article->id])}}" method="post" id="avatar">
        <div class="layui-form-item">
            <label for="" class="layui-form-label">标题</label>
            <div class="layui-input-block">
                <input type="text" name="title"  lay-verify="required" placeholder="请输入标题" class="layui-input" value="{{$article->title??old('title')}}" >
            </div>
        </div>
        <div id="layout">
            <div id="test-editormd" name="content"></div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
                <a  class="layui-btn" href="{{route('admin.article')}}" >返 回</a>
            </div>
        </div>
        {{csrf_field()}}
        {{ method_field('put') }}
    </form>
    <script src="/editor-master/js/jquery.min.js"></script>
    <script src="/editor-master/js/editormd.min.js"></script>

@endsection

@section('script')
    <script type="text/javascript">
        var testEditor;

        $(function() {
            $.get('/test1.md', function(md){
                testEditor = editormd("test-editormd", {
                    width: "90%",
                    height: 740,
                    path : '/editor-master/lib/',
                    theme : "dark",
                    previewTheme : "dark",
                    editorTheme : "pastel-on-dark",
                    markdown : md,
                    codeFold : true,
                    //syncScrolling : false,
                    saveHTMLToTextarea : true,    // 保存 HTML 到 Textarea
                    searchReplace : true,
                    //watch : false,                // 关闭实时预览
                    htmlDecode : "style,script,iframe|on*",            // 开启 HTML 标签解析，为了安全性，默认不开启
                    //toolbar  : false,             //关闭工具栏
                    //previewCodeHighlight : false, // 关闭预览 HTML 的代码块高亮，默认开启
                    emoji : true,
                    taskList : true,
                    tocm            : true,         // Using [TOCM]
                    tex : true,                   // 开启科学公式TeX语言支持，默认关闭
                    flowChart : true,             // 开启流程图支持，默认关闭
                    sequenceDiagram : true,       // 开启时序/序列图支持，默认关闭,
                    //dialogLockScreen : false,   // 设置弹出层对话框不锁屏，全局通用，默认为true
                    //dialogShowMask : false,     // 设置弹出层对话框显示透明遮罩层，全局通用，默认为true
                    //dialogDraggable : false,    // 设置弹出层对话框不可拖动，全局通用，默认为true
                    //dialogMaskOpacity : 0.4,    // 设置透明遮罩层的透明度，全局通用，默认值为0.1
                    //dialogMaskBgColor : "#000", // 设置透明遮罩层的背景颜色，全局通用，默认为#fff
                    imageUpload : true,
                    imageFormats : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
                    imageUploadURL : "{{ route('uploadImg') }}",
                    onload : function() {
                        console.log('onload', this);
                        //this.fullscreen();
                        //this.unwatch();
                        //this.watch().fullscreen();

                        //this.setMarkdown("#PHP");
                        //this.width("100%");
                        //this.height(480);
                        //this.resize("100%", 640);
                    }
                });
            });
            ///$("[name='test-editormd-markdown-doc']").html('2131');
        });
        function paste(event) {
            var clipboardData = event.clipboardData;
            var items, item, types;
            if (clipboardData) {
                items = clipboardData.items;
                if (!items) {
                    return;
                }
                // 保存在剪贴板中的数据类型
                types = clipboardData.types || [];
                for (var i = 0; i < types.length; i++) {
                    if (types[i] === 'Files') {
                        item = items[i];
                        break;
                    }
                }

                // 判断是否为图片数据
                if (item && item.kind === 'file' && item.type.match(/^image\//i)) {
                    // 读取该图片
                    var file = item.getAsFile(),
                        reader = new FileReader();
                    reader.readAsDataURL(file);
                    //上传
                    /*var formData = new FormData();
                     formData.append('photo', file);
                     $.ajax({
                     url: "{{route('uploadImg_cs')}}",
                     type: 'post',
                     data: formData,
                     // 因为data值是FormData对象，不需要对数据做处理
                     processData: false,
                     contentType: false,
                     beforeSend:function(){
                     // 菊花转转图
                     $('#pic').attr('src', '/load.gif');
                     },
                     success: function(data){
                     if(data.code=='200'){
                     // 如果成功
                     var imageName = data.data;
                     var qiniuUrl = '![](' + imageName + ')';
                     testEditor.insertValue(qiniuUrl);
                     }else{
                     // 如果失败
                     alert(data['ResultData']);
                     }
                     },
                     error: function(XMLHttpRequest, textStatus, errorThrown) {
                     var number = XMLHttpRequest.status;
                     var info = "错误号"+number+"文件上传失败!";
                     // 将菊花换成原图
                     $('#pic').attr('src', '/file.png');
                     alert(info);
                     },
                     async: true
                     });*/


                    reader.onload = function () {
                        //前端压缩
                        lrz(reader.result, {width: 1080}).then(function (res) {
                            $.ajax({
                                url: "{{route('uploadImg_parse')}}",
                                type: 'post',
                                data: {
                                    "image": res.base64,
                                    "name": new Date().getTime() + ".png"
                                },
                                contentType: 'application/x-www-form-urlencoded;charest=UTF-8',
                                success: function (data) {
                                    var imageName;
                                    try {
                                        imageName = data.data;
                                    } catch (e) {
                                        alert(e.toString);
                                    }
                                    var qiniuUrl = '![](' + imageName + ')';
                                    testEditor.insertValue(qiniuUrl);
                                }
                            })
                        });


                    }

                }
            }
        }
        document.addEventListener('paste', function (event) {
            paste(event);
        })
        </script>
    @include('admin.article._js')
@endsection
