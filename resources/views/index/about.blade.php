@extends('layout.ccps')

@section('title')
    关于我们
@endsection

{{--主体--}}
@section('content')

<div class="sb_box">
    @foreach($about as $k=>$v)
    <h3 class="title">
        <div class="position">当前位置：<a href="{{ url('/index/index') }}" title="网站首页">网站首页</a> &gt; <a href="/index/about?cid={{ $v["cid"] }}">{{ $v['cname'] }}</a> ></div>
        <span>{{ $v['cname'] }}</span>
    </h3>
    <div class="clear"></div>

    <div class="editor active" id="showtext">
            <div class="active editor clear contour-1">
                @foreach($v["son"] as $k=>$val)
                    <div>
                        <img alt="" src="{{ $val['new_img'] }}" style="margin: 8px; width: 120px; float: left; height: 90px; " />
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
        @endforeach

        <div class="clear"></div>
    </div>
<div class="clear"></div>

@endsection