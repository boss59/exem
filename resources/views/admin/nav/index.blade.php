@extends('layout.layout')

@section('title')
    导航 展示
@endsection


@section('content')
    <marquee><h2><font color='blue'>你终会站上巅峰，回首来的路，都值得！！！</font></h2></marquee>
    <center>
    <div >
        <button><a href="/admin/nav_add">返回添加</a></button>
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
            <th>导航名</th>
            <th>url路径</th>
            <th>权重</th>
            <th>是否展示</th>
            <th>时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($index as $k=>$v)
            <tr aid="{{ $v->nav_id }}">
                <td>{{ $v->nav_id }}</td>
                <td>{{ $v->nav_name }}</td>
                <td>
                    <a href="{{ $v->nav_url }}">你懂得的url</a>
                </td>
                <td>{{ $v->nav_weight }}</td>
                @if($v->is_show == 1)
                    <td>是</td>
                @else
                    <td>否</td>
                @endif
                <td>{{ date("Y-m-d H:i:s",$v->add_time) }}</td>
                <td>
                    <button class="btn btn-danger"><a href="/admin/nav_del?nav_id={{ $v['nav_id'] }}">删除</a></button> ||
                    <button class="btn btn-success"><a href="/admin/nav_update?nav_id={{ $v['nav_id'] }}">修改</a></button>
                </td>
            </tr>
        @endforeach
        </tbody>
            <tr align="center">
                <td colspan="7">{{ $index->links() }}</td>
            </tr>
    </table>
@endsection
