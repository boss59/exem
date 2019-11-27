@extends('layout.layout')

@section('title')
    导航 展示
@endsection


@section('content')
    <marquee><h2><font color='blue'>你终会站上巅峰，回首来的路，都值得！！！</font></h2></marquee>
    <center>
        <form action="{{ url("/admin/new_index") }}" method="get">
            <!-- 分类 -->
            分类：<select name="cid" >
                <option value="0">所有分类</option>
            @foreach($cate as $v)
                <option value="{{ $v->cid }}">{{ $v->cname }}</option>
            @endforeach
            </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            {{--是否展示--}}
            是否展示：<select name="new_show">
                <option value="">全部</option>
                <option value="1">是</option>
                <option value="0">否</option>
            </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            {{--是否热门--}}
            是否热门：<select name="is_hot">
                <option value="">全部</option>
                <option value="1">热门</option>
                <option value="0">非热门</option>
            </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <!-- 关键字 -->

            关键字 <input type="text" name="title" size="15">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" value="搜索" id="ser">
        </form><br />

        <div >
            <button class="btn btn-success"><a href="/admin/new_add">返回添加</a></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="button" class="btn btn-danger" id="delxx" value="批量删除">
        </div>
    </center>
    <table class="layui-table">
        <colgroup>
            <col width="150">
            <col width="200">
            <col>
        </colgroup>
        <thead>
        <tr >
            <th>
                <input type="checkbox" id="xxoo">全选<br />
                <input type="checkbox" id="noall">反选
            </th>
            <th>标题</th>
            <th>是否热门</th>
            <th>是否展示</th>
            <th>隐藏图片</th>
            <th>新闻内容</th>
            <th>分类cid</th>
            <th>分类名</th>
            <th>时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($index as $k=>$v)
            <tr new_id="{{ $v->new_id }}">
                <td align="center" class="one">
                    <input type="checkbox" name="one" value="{{ $v->new_id }}">{{ $v->new_id }}
                </td>
                <td class="title">
                    <span>{{ $v->title }}</span>
                    <input type="text" style="display:none;" />
                </td>
                @if($v->is_hot == 1)
                    <td align="center">
                        <img src="imgs/yes/yes.gif" class="is_hot" is_hot="0">
                    </td>
                @else
                    <td align="center">
                        <img src="imgs/yes/no.gif"  class="is_hot" is_hot="1">
                    </td>
                @endif

                @if($v->new_show == 1)
                    <td align="center">
                        <img src="imgs/yes/yes.gif" class="new_show" new_show="0">
                    </td>
                @else
                    <td align="center">
                        <img src="imgs/yes/no.gif"  class="new_show" new_show="1">
                    </td>
                @endif
                <td>
                    <a href="{{ $v->new_img }}">{{ $v->title }}</a>
                </td>
                <td>
                    {{--{!! mb_substr($v->new_desc,0,10)."……" !!}--}}
                    {{--[<a href="{{url('/admin/news_details/'.$v->new_id)}}">详情</a>]--}}
                    <button class="btn btn-default dropdown-toggle"><a href="/admin/details?new_id={{ $v['new_id'] }}">【详情】</a></button>
                </td>
                <td>{{ $v->cid }}</td>
                <td>{{ $v->cname }}</td>
                <td>{{ date("Y-m-d H:i:s",$v->add_time) }}</td>
                <td>
                    <button class="btn btn-danger"><a href="/admin/new_del?new_id={{ $v['new_id'] }}">删除</a></button>
                    <button class="btn btn-success"><a href="/admin/new_update?new_id={{ $v['new_id'] }}">修改</a></button>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tr align="center">
            <td colspan="10">{{ $index->appends($query)->links() }}</td>
        </tr>

    </table>

    <script>
    $(function(){
        // 全选
        $(document).on('click','#xxoo',function(){
            $('.one :checkbox').prop('checked',$(this).prop('checked'));
        });
        // 反选
        $(document).on('click','#noall',function(){
            $('.one :checkbox').prop('checked',function(i,val){
                return !val;
            });
        });

        // 即点即改 热门
        $(document).on('click','.is_hot',function(){
            var is_hot = $(this).attr('is_hot');
            var new_id = $(this).parent().parent().attr('new_id');
            var _this = $(this);
            $.ajax({
                url:"/admin/is_hot",//请求地址
                type:'get',//请求的类型
                dataType:'json',//返回的类型
                data:{is_hot:is_hot,new_id:new_id},//要传输的数据
                success:function(res){ //成功之后回调的方法
                    if (res == 1) {
                        window.location.reload();
                    }
                }
            })
        })
        // 即点即改 展示
        $(document).on('click','.new_show',function(){
            var new_show = $(this).attr('new_show');
            var new_id = $(this).parent().parent().attr('new_id');
            var _this = $(this);
            $.ajax({
                url:"/admin/is_hot",//请求地址
                type:'get',//请求的类型
                dataType:'json',//返回的类型
                data:{new_show:new_show,new_id:new_id},//要传输的数据
                success:function(res){ //成功之后回调的方法
                    if (res == 1) {
                        window.location.reload();
                    }
                }
            })
        });
        // ------------------修改名称--------------------------
        $(document).on('click','.title span',function(){
            var span = $(this);// 定义 span 标签
            var input = span.next();// 找 input 标签
            span.hide();// span 隐藏
            input.show(); // input 显示
            var name = span.html();// 获取 span 的值
            input.val(name);//放到 input里
            input.focus();//聚焦 input 标签
        })
        $(document).on('blur','.title input',function(){
            var input = $(this);//定义 input 标签
            var span = input.prev();// 找上一级 的 span
            input.hide();// span 隐藏
            span.show(); // input 显示
            var names = input.val();// 获取 input 的值
            span.text(names);// 放到 span 里
            var new_id = input.parent().parent().attr("new_id");//获取 id
            // alert(new_id);return;
            $.ajax({
                url:'/admin/is_hot',//请求地址
                type:'get',//请求的类型
                dataType:'json',//返回的类型
                data:{title:names,new_id:new_id},//要传输的数据
                success:function(res){ //成功之后回调的方法
                }
            })
        });
        // -------------------批量删除-------------------------
        $(document).on('click','#delxx',function(){
            // 获取 选中的 input 的值
            var odj = $('.one :checked');
            var arr = new Array();// 定义数组
            // 循环 odj
            $.each(odj,function(){
                var id = $(this).val();
                arr.push(id);// 把id 放到数组中
            })
            // 发送请求
            $.ajax({
                url:"/admin/new_del",//请求地址
                type:'get',//请求的类型
                dataType:'json',//返回的类型
                data:{gid:arr},//要传输的数据
                success:function(res){ //成功之后回调的方法
                    window.location.reload();
                }
            })
        })

    });
    </script>
@endsection
