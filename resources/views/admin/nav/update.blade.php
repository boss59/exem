@extends('layout.layout')

@section('title')
导航 修改
@endsection


@section('content')
<marquee><h2><font color='blue'>导航 修改</font></h2></marquee>
<form class="layui-form layui-form-pane" action="{{ url("/admin/nav_update") }}" method="post" style="margin: 50px ;" id="form">
@csrf
    <input type="hidden" name="nav_id" value="{{ $data->nav_id }}">
<div class="layui-form-item" style="padding-left:400px">
    <label class="layui-form-label">导航名</label>
    <div class="layui-input-inline">
        <input type="text" name="nav_name" value="{{ $data->nav_name }}" required  lay-verify="required" placeholder="请输入导航名" autocomplete="off" class="layui-input">@php echo $errors->first('uname')@endphp
    </div>
</div>

<div class="layui-form-item" style="padding-left:400px">
    <label class="layui-form-label">url</label>
    <div class="layui-input-inline">
        <input type="text" name="nav_url" value="{{ $data->nav_url }}" required  lay-verify="required" placeholder="请输入url" autocomplete="off" class="layui-input">@php echo $errors->first('pwd')@endphp
    </div>
</div>

<div class="layui-form-item" style="padding-left:400px">
    <label class="layui-form-label">排序</label>
    <div class="layui-input-inline">
        <input type="number" name="nav_weight" value="{{ $data->nav_weight }}" required  lay-verify="required" placeholder="请输入排序" autocomplete="off" class="layui-input">@php echo $errors->first('email')@endphp
    </div>
</div>

<div class="layui-form-item" style="padding-left:400px">
    <label class="layui-form-label">展示</label>
    <div class="layui-input-block" >
        <input type="radio" name="is_show" value="1" title="是" @if($data->is_show == 1) checked @endif>
        <input type="radio" name="is_show" value="0" title="否"  @if($data->is_show == 0) checked @endif>
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

    $(document).ready(function(){
        $("input[name='btn']").click(function(){
            // var form = new FormData($("#form")[0]);
            var form = $('#form').serialize();// 序列化serialize
            // alert(form);
            $.ajax({
                url:"/admin/nav_update",
                data:form,
                type:"POST",
                dataType:'json',
                // processData: false, //需设置为false。因为data值是FormData对象，不需要对数据做处理
                // contentType: false, //需设置为false。因为是FormData对象，且已经声明了属性
                success:function(res){
                    if (res==1) {
                        alert("修改成功");
                        location.href = "/admin/nav_index";
                    }else{
                        alert("修改失败");
                    }
                }
            })
        })
    })
</script>
@endsection
