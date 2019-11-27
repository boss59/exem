@extends('layout.layout')

@section('title')
    新闻voice 展示
@endsection


@section('content')
    <marquee><h2><font color='blue'>你终会站上巅峰，回首来的路，都值得！！！</font></h2></marquee>
    <center>
        <div >
            <button><a href="{{ url("/admin/voice_add") }}">返回添加</a></button>
        </div>
    </center>
    <table class="layui-table">
        <colgroup>
            <col width="150">
            <col width="200">
            <col>
        </colgroup>
        <thead>
        <tr>
            <th>序号</th>
            <th>url路径</th>
            <th>是否展示</th>
            <th>时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($new as $k=>$v)
            <tr>
                <td>{{ $v->vid }}</td>
                <td>
                    <a href="{{ $v->voice }}">{{ $v->vname }}</a>
                </td>
                <td><a href="{{ $v->new_img }}">{{ $v->title }}</a></td>
                <td>{{ date("Y-m-d H:i:s",$v->add_time) }}</td>
                <td>
                    <button class="btn btn-danger"><a href="/admin/img_del?img_id={{ $v['img_id'] }}">删除</a></button> ||
                    <button class="btn btn-success"><a href="/admin/img_update?img_id={{ $v['img_id'] }}">修改</a></button>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tr align="center">
            <td colspan="6">{{ $new->links() }}</td>
        </tr>
    </table>
@endsection

