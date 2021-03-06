@extends('layout.layout')

@section('title')
    产品 添加
@endsection


@section('content')
    <marquee><h2><font color='blue'>产品 添加</font></h2></marquee>
    <form class="layui-form layui-form-pane" action="{{ url("/admin/product_add") }}" method="post" style="margin: 50px ;" id="form" enctype="multipart/form-data">
        @csrf
        <div class="layui-form-item" style="padding-left:400px">
            <label class="layui-form-label">产品名</label>
            <div class="layui-input-inline">
                <input type="text" name="pname" required  lay-verify="required" placeholder="请输入图片名" autocomplete="off" class="layui-input">@php echo $errors->first('brand_name')@endphp
            </div>
        </div>

        <div class="layui-form-item" style="padding-left:400px">
            <label class="layui-form-label">分类名</label>
            <div class="layui-input-block" >
                <select name="nav_id" lay-verify="required" lay-search>
                    @foreach($cate as $k=>$v)
                        <option value="{{ $v->cid }}" @if($v->cid ==6) selected @endif>{{ $v->cname }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group" style="padding-left:400px">
            <label class="layui-form-label">图片</label>
            <input type="file" class="form-control" placeholder="" name="images" style="display: none" id="upload">
            <button class="btn btn-warning" id="img" type="button" >上传图片</button>
            <div for="inputPassword3" class="col-sm-2 control-label">
                <img src="{{ asset('/bootstrap/img/222.jpg') }}" alt="图片" class="img-thumbnail" width="200" height="200">
            </div>
        </div>


        <div class="layui-form-item" style="padding-left:400px">
            <label class="layui-form-label">显示</label>
            <div class="layui-input-block">
                <input type="radio" name="img_show" value="1" title="是" checked>
                <input type="radio" name="img_show" value="0" title="否" >
            </div>
        </div>

        <div class="layui-form-item" style="padding-left:400px">
            <div class="layui-input-block">
                <input type="button" value="立即提交" class="btn btn-success" name="btn">
                <input type="reset" value="重置表单" class="btn btn-info">
            </div>
        </div>
    </form>
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
                    url:"/admin/product_add",
                    data:form,
                    type:"POST",
                    dataType:'json',
                    processData: false, //需设置为false。因为data值是FormData对象，不需要对数据做处理
                    contentType: false, //需设置为false。因为是FormData对象，且已经声明了属性
                    success:function(res){
                        if (res == 1) {
                            alert("成功");
                            location.href="/admin/product_index";
                        }else{
                            alert("失败");
                        }
                    }
                })
            })
        })
    </script>
@endsection
