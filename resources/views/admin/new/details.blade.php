@extends('layout.layout')

@section('title')
    新闻 详情
@endsection


@section('content')
    <marquee><h2><font color='blue'>你终会站上巅峰，回首来的路，都值得！！！</font></h2></marquee>
    <center>
        <div >
            <button><a href="/admin/new_index">返回</a></button>
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
            <th>心情</th>
        </tr>
        </thead>
        <tbody>

            <tr>
               <td>{!! $desc !!}</td>
            </tr>

        </tbody>

    </table>
@endsection
