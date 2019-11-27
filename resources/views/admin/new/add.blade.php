@extends('layout.layout')

@section('title')
    新闻 添加
@endsection


@section('content')
    <marquee><h2><font color='blue'>新闻 添加</font></h2></marquee>
    <form class="layui-form layui-form-pane" action="{{ url("/admin/new_add") }}" method="post" style="margin: 50px ;" id="form" enctype="multipart/form-data">
        @csrf
        <div class="layui-form-item" style="padding-left:300px">
            <label class="layui-form-label">标题</label>
            <div class="layui-input-inline">
                <input type="text" name="title" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">@php echo $errors->first('brand_name')@endphp
            </div>
        </div>

        <div class="layui-form-item" style="padding-left:300px">
            <label class="layui-form-label">热门</label>
            <div class="layui-input-block" >
                <input type="radio" name="is_hot" value="1" title="是" checked>
                <input type="radio" name="is_hot" value="0" title="否" >
            </div>
        </div>

        <div class="layui-form-item" style="padding-left:300px">
            <label class="layui-form-label">展示</label>
            <div class="layui-input-block" >
                <input type="radio" name="new_show" value="1" title="是" checked>
                <input type="radio" name="new_show" value="0" title="否">
            </div>
        </div>


        <div class="layui-form-item" style="padding-left:300px">
            <label class="layui-form-label">分类名</label>
            <div class="layui-input-block" >
                <select name="cid" lay-verify="required" lay-search>
                @foreach($coo as $k=>$v)
                    <optgroup label="{{ $v->nav_name }}">
                        <option value="{{ $v->cid }}">{{ $v->cname }}</option>
                    </optgroup>
                @endforeach
                </select>
            </div>
        </div>

        <div class="form-group" style="padding-left:300px">
            <label class="layui-form-label ">新闻图片</label>
            <input type="file" class="form-control" placeholder="" name="new_img" style="display: none" id="upload">
            <button class="btn btn-warning" id="img" type="button" >上传图片</button>
            <div for="inputPassword3" class="col-sm-2 control-label">
                <img src="{{ asset('/bootstrap/img/222.jpg') }}" alt="图片" class="img-thumbnail" width="200" height="200">
            </div>
        </div>

        <div class="layui-form-item layui-form-text" style="padding-left:300px">
            <label class="layui-form-label">文本域</label>
            <div class="layui-input-block">
                <textarea id="container" name="new_desc"  class="layui-textarea"></textarea>
            </div>
        </div>

        <div class="layui-form-item" style="padding-left:300px">
            <div class="layui-input-block">
                <input type="button" value="立即提交" class="btn btn-success" name="btn">
                <input type="reset" value="重置表单" class="btn btn-info">
            </div>
        </div>
    </form>

    {{--<!-- 富文本 -->--}}
    {{--<!-- 配置文件 -->--}}
    {{--<script type="text/javascript" src="{{ asset('static/ueditor/ueditor.config.js') }}"></script>--}}
    {{--<!-- 编辑器源码文件 -->--}}
    {{--<script type="text/javascript" src="{{ asset('static/ueditor/ueditor.all.js') }}"></script>--}}
    {{--<!-- 实例化编辑器 -->--}}
    {{--<script type="text/javascript">--}}
        {{--var ue = UE.getEditor('container');--}}
        {{--var content = "{!! old('content') !!}";--}}
        {{--ue.ready(function(){--}}
            {{--ue.setContent(content);--}}
        {{--})--}}
    {{--</script>--}}

    <script>
        //Demo
        layui.use('form', function(){
            var form = layui.form;
            //监听提交
            form.on('submit(formDemo)', function(data){
                layer.msg(JSON.stringify(data.field));
                return false;
            });
        });

        // 上传
        $(document).ready(function(){
            $("input[name='btn']").click(function(){
                var form = new FormData($("#form")[0]);
                // var form = $('#form').serialize();// 序列化serialize
                // alert(form);
                $.ajax({
                    url:"/admin/new_add",
                    data:form,
                    type:"POST",
                    dataType:'json',
                    processData: false, //需设置为false。因为data值是FormData对象，不需要对数据做处理
                    contentType: false, //需设置为false。因为是FormData对象，且已经声明了属性
                    success:function(res){
                        if (res == 1) {
                            alert("成功");
                            location.href="/admin/new_index";
                        }else{
                            alert("失败");
                        }
                    }
                })
            })
        })
    </script>
@endsection
