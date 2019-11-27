@extends('layout.layout')

@section('title')
    产品 展示
@endsection


@section('content')
    <marquee><h2><font color='blue'>你终会站上巅峰，回首来的路，都值得！！！</font></h2></marquee>
    <center>
        <div >
            <button><a href="{{ url("/admin/product_add") }}">返回添加</a></button>
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
            <th>产品名</th>
            <th>图片</th>
            <th>是for展示</th>
            <th>导航id</th>
            <th>导航名</th>
            <th>时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($index as $k=>$v)
            <tr>
                <td>{{ $v->pid }}</td>
                <td>{{ $v->pname }}</td>
                <td>
                    <a href="{{ $v->images }}">查看图片</a>
                </td>
                @if($v->img_show)
                    <td>是</td>
                @else
                    <td>否</td>
                @endif
                <td>{{ $v->nav_id }}</td>
                <td>{{ $v->nav_name }}</td>
                <td>{{ date("Y-m-d H:i:s",$v->add_time) }}</td>
                <td>
                    <button class="btn btn-danger"><a href="/admin/product_del?pid={{ $v['pid'] }}">删除</a></button> ||
                    <button class="btn btn-success"><a href="/admin/product_update?pid={{ $v['pid'] }}">修改</a></button>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tr align="center">
            <td colspan="10">{{ $index->links() }}</td>
        </tr>
    </table>
@endsection
