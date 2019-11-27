@extends('layout.layout')

@section('title')
    轮播图 展示
@endsection


@section('content')
    <marquee><h2><font color='blue'>你终会站上巅峰，回首来的路，都值得！！！</font></h2></marquee>
    <center>
        <div >
            <button><a href="{{ url("/admin/link_add") }}">返回添加</a></button>
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
            <th>友链</th>
            <th>时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($index as $k=>$v)
            <tr>
                <td>{{ $v->fid }}</td>
                <td><a href="{{ $v->furl }}">{{ $v->fname }}</a></td>
                <td>{{ date("Y-m-d H:i:s",$v->add_time) }}</td>
                <td>
                    <button class="btn btn-danger"><a href="/admin/link_del?fid={{ $v['fid'] }}">删除</a></button> ||
                    <button class="btn btn-success"><a href="/admin/link_update?fid={{ $v['fid'] }}">修改</a></button>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tr align="center">
            <td colspan="6">{{ $index->links() }}</td>
        </tr>
    </table>
@endsection
