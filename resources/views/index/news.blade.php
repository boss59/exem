@extends('layout.ccps')

@section('title')
    新闻资讯
@endsection

{{--主体--}}
@section('content')
    @foreach($title as $k=>$v)
            <div class="sb_box">
            <h3 class="title">
                <div class="position">当前位置：
                    <a href="{{ url("/index/index") }}" title="网站首页">网站首页</a> &gt;
                    <a href="/index/news?cid={{ $v['cid'] }}">{{ $v['cname'] }}</a>
                </div>
                <span>{{ $v['cname'] }}</span>
            </h3>
            <div class="clear"></div>

            <div class="active" id="newslist">
                @if($v['nav_id'] == 3 || $v['cid'] == 6)
                        @foreach($v['pro'] as $k=>$val)
                        <img class='listhot' src='{{ $val['images'] }}' alt='图片关键词' height="100" width="100"/>
                        <span>[{{ date("Y-m-d H:i:s",$val['add_time']) }}]</span>
                        <a href='javascript:;' title='如何选择网站关键词?' target='_self'>{{ $val['pname'] }}</a>
                        @endforeach
                @else
                    <ul class='list-none metlist'>
                        @foreach($v['son'] as $k=>$val)
                            <li class='list top'><span>[{{ date("Y-m-d H:i:s",$val['add_time']) }}]</span><a href='/index/shownews?new_id={{ $val['new_id'] }}' title='如何选择网站关键词?' target='_self'>{{ $val['title'] }}</a><img class='listhot' src='images/hot.gif' alt='图片关键词' /></li>
                        @endforeach
                    </ul>
                @endif
                <div id="flip"><style>.digg4  { padding:3px; margin:3px; text-align:center; font-family:Tahoma, Arial, Helvetica, Sans-serif;  font-size: 12px;}.digg4  a,.digg4 span.miy{ border:1px solid #ddd; padding:2px 5px 2px 5px; margin:2px; color:#aaa; text-decoration:none;}.digg4  a:hover { border:1px solid #a0a0a0; }.digg4  a:hover { border:1px solid #a0a0a0; }.digg4  span.current {border:1px solid #e0e0e0; padding:2px 5px 2px 5px; margin:2px; color:#aaa; background-color:#f0f0f0; text-decoration:none;}.digg4  span.disabled { border:1px solid #f3f3f3; padding:2px 5px 2px 5px; margin:2px; color:#ccc;}.digg4 .disabledfy { font-family: Tahoma, Verdana;} </style><div class='digg4 metpager_8'><span class='disabled disabledfy'><b>«</b></span><span class='disabled disabledfy'>‹</span><span class='current'>1</span><span class='disabled disabledfy'>›</span><span class='disabled disabledfy'><b>»</b></span></div></div>
            </div>
        </div>
        @endforeach
        <div class="clear"></div>
@endsection