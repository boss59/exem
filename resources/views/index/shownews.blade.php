@extends('layout.ccps')

@section('title')
    新闻内容
@endsection

{{--主体--}}
@section('content')
<div class="sb_box">
    @foreach($show as $k=>$v)
    <h3 class="title">
        <div class="position">当前位置：
            <a href="/index/index" title="网站首页">网站首页
            </a> &gt; <a href="/index/news?cid={{ $v["cid"] }}" >{{ $v['cname'] }}</a> >
            @foreach($v["son"]['data'] as $k=>$val)
            <a href="/index/shownews?new_id={{ $val["new_id"] }}">{{ mb_substr($val['title'],0,5)."....." }}</a>
        </div>
        <span>{{ $val['title'] }}</span>
    </h3>
    <div class="clear"></div>
    <div class="active" id="shownews">
        <h1 class="title"></h1>
        <div class="editor"><div><div>
                    <span style="font-size:14px;"><strong>{{ $val['title'] }}</strong></span></div>
                <div>
                    <img alt="" src="{{ $val['new_img'] }}" style="margin: 8px; width: 120px; float: left; height: 90px; " />
                </div>
                    &nbsp; &nbsp; &nbsp;<audio src="{{ $val['voice'] }}" controls="controls"></audio></div>
                <div>
                    &nbsp;</div>
                <ol>
                    <li>
                        <span style="font-size:13px;"><strong>{{ $val['title'] }}</strong><span style="font-size:12px;">，</span>{!! $val["new_desc"] !!}</span><br />
                        &nbsp;</li>
                </ol>
                <div id="metinfo_additional"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="met_hits">
            <div class='metjiathis'>
                <div class="jiathis_style">
                    <span class="jiathis_txt">分享到：</span>
                    <a class="jiathis_button_icons_1">微信</a>
                    <a class="jiathis_button_icons_2">QQ</a>
                    <a class="jiathis_button_icons_3">新浪</a>
                    <a class="jiathis_button_icons_4">微博</a>
                    <a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
                </div><script type="text/javascript" src="http://v3.jiathis.com/code/jia.js?uid=1346378669840136" charset="utf-8"></script>
            </div>点击次数：{{ $val['num'] }}<span>
                <script language='javascript' src='../include/hits.php?type=news&id=10'></script></span>&nbsp;&nbsp;更新时间：{{ date('Y-m-d H:i:s',$val['add_time']) }}&nbsp;&nbsp;【<a href="javascript:window.print()">打印此页</a>】&nbsp;&nbsp;【<a href="javascript:self.close()">关闭</a>】
        </div>
        <div class="met_page">
            <a href="">上一页</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="">下一页</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
    @endforeach
    </div>
@endforeach
<div class="clear"></div>
@endsection