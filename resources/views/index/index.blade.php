@extends('layout.ccps')

@section('title')
    首页
@endsection


@section('sidebar')
    <div class="inner met_flash">
        <link href='images/css.css' rel='stylesheet' type='text/css' />
        <script src='images/jquery.bxSlider.min.js'></script>
        <div class='flash flash6' style='width:980px; height:245px;'>
            <ul id='slider6' class='list-none'>
            @foreach($arr['img'] as $k=>$v)
                <li>
                    <a href='{{ $v['img_url'] }}' target='_blank' >
                        <img src='{{ $v["imgs"] }}'width='980' height='245'>
                    </a>
                </li>
            @endforeach
            </ul>
        </div>
        <script type='text/javascript'>$(document).ready(function(){ $('#slider6').bxSlider({ mode:'vertical',autoHover:true,auto:true,pager: true,pause: 5000,controls:false});});</script></div>

    <div class="index inner">

        <div class="aboutus style-1" style="overflow-y:auto;">
        @foreach($array as $k=>$v)
            @if($v['cid']==1)
            <h3 class="title">
                <span class='myCorner' data-corner='top 5px'>{{ $v['cname'] }}</span>
                <a href="/index/about?cid={{ $v["cid"] }}" class="more" title="链接关键词">更多>></a>
            </h3>
            <div class="active editor clear contour-1">
            @foreach($v["son"] as $k=>$val)
                <div>
                    <a href="/index/shownews?new_id={{ $val["new_id"] }}"><img alt="" src="{{ $val['new_img'] }}" style="margin: 8px; width: 120px; float: left; height: 90px; " /></a>
                </div>
                <div style="padding-top:10px;">
                    <span style="font-size:14px;"><strong>{{ $val['title'] }}</strong></span></div>
                    <audio src="{{ $val['voice'] }}" controls="controls">
                    </audio>
                <div>{!! $val['new_desc'] !!}</div>
                <div>&nbsp;</div>
            @endforeach
            </div>
        </div>
        @endif
        @endforeach

        <div class="case style-2" style="overflow-y:auto;">
        @foreach($array as $k=>$v)
            @if($v['cid']==2)
            <h3 class='title myCorner' data-corner='top 5px'>
                <a href="/index/about?cid={{ $v["cid"] }}" title="链接关键词" class="more">更多>></a>{{ $v['cname'] }}
            </h3>
            <div class="active dl-jqrun contour-1">
            @foreach($v['son'] as $k=>$val)
                <dl class="ind">
                    <dt>
                        <a href="/index/shownews?new_id={{ $val["new_id"] }}" target='_self'><img src="{{ $val['new_img'] }}" alt="图片关键词" title="图片关键词" style="width:116px; height:80px;" /></a>
                    </dt>
                    <dd>
                        <h4><a href="/index/shownews?new_id={{ $val["new_id"] }}" target='_self' title="示例案例六">{{ $val['title'] }}</a></h4>
                        <p class="desc" title="相关描述文字，相关描述文字，相关描述文字，相关描述文字，相关描述文字。">{{ mb_substr($val['new_desc'],0,20)."..." }}</p>
                    </dd>
                </dl>
            @endforeach
                <div class="clear"></div>
            </div>
        </div>
        <div class="clear"></div>
        @endif
        @endforeach


        <div class="index-news style-1">
        @foreach($array as $k=>$v)
            @if($v['cid']==3)
            <h3 class="title">
                <span class='myCorner' data-corner='top 5px'>{{ $v['cname'] }}</span>
                <a href="/index/news?cid={{ $v["cid"] }}" class="more" title="链接关键词">更多>></a>
            </h3>
            <div class="active clear listel contour-2">
                <ol class='list-none metlist'>
                @foreach($v['son'] as $k=>$val)
                    <li class='list top'>
                        <span class='time'>{{ date("Y-m-d",$val['add_time']) }}</span>
                        <a href='/index/shownews?new_id={{ $val["new_id"] }}' >{{ $val['title'] }}</a>
                    </li>
                @endforeach
                </ol>
            </div>
        </div>
        @endif
        @endforeach

        <div class="index-news style-1">
            @foreach($array as $k=>$v)
            @if($v['cid']==4)
            <h3 class="title">
                <span class='myCorner' data-corner='top 5px'>{{ $v['cname'] }}</span>
                <a href="/index/news?cid={{ $v["cid"] }}" class="more" title="链接关键词">更多>></a>
            </h3>
            <div class="active clear listel contour-2">
                <ol class='list-none metlist'>
                    @foreach($v['son'] as $k=>$val)
                        <li class='list top'>
                            <span class='time'>{{ date("Y-m-d",$val['add_time']) }}</span>
                            <a href='/index/shownews?new_id={{ $val["new_id"] }}' >{{ $val['title'] }}</a>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
        @endif
        @endforeach


        <div class="index-conts style-2">
        @foreach($array as $k=>$v)
        @if($v['cid']==5)
            <h3 class="title">
                <span class='myCorner' data-corner='top 5px'>{{ $v['cname'] }}</span>
                <a href="/index/news?cid={{ $v["cid"] }}" class="more" title="链接关键词">更多>></a>
            </h3>
            <div class="active clear listel contour-2">
                <ol class='list-none metlist'>
                    @foreach($v['son'] as $k=>$val)
                        <li class='list top'>
                            <span class='time'>{{ date("Y-m-d",$val['add_time']) }}</span>
                            <a href='/index/shownews?new_id={{ $val["new_id"] }}' >{{ $val['title'] }}</a>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
        @endif
        @endforeach
        <div class="clear p-line"></div>
@endsection



