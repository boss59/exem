@extends('layout.ccps')

@section('title')
   大地影院
@endsection

{{--主体--}}
@section('content')
    <div class="sb_box">
        <h3 class="title">
            <div class="position">当前位置：
                <a href="/index/index" title="网站首页">网站首页</a> &gt;
                <a href="/index/video" >大地影视</a> >
            </div>
            <span>{{ isset($video_arr['title']) ? $video_arr['title'] : "请输入" }}</span>
        </h3>
        <div class="clear"></div>
        @if(empty($video_arr))
            <h2>请输入名称</h2>
            <div  style="padding-top:10px;">
                <form action="/index/video" method="get">
                    <input type="text" name="video">
                    <input type="submit" value="立即搜索">
                </form>
            </div>
        @else
            



        {{--内容--}}
        <div class="active" id="shownews">
            <div>
                <img src="{{ isset($video_arr['cover']) ? $video_arr['cover'] : "" }}" style="margin: 8px; width: 150px; float: left; height: 150px; " />
            </div>
            <div  style="padding-top:10px;">
                <span style="font-size:14px;"><strong>类型：</strong>{{ isset($video_arr['tag']) ? $video_arr['tag'] : "" }}</span>
            </div>
            <div  style="padding-top:10px;">
                <span style="font-size:14px;"><strong>领界主演：</strong>{{ isset($video_arr['act']) ? $video_arr['act'] : "" }}</span>
            </div>
            <div  style="padding-top:10px;">
                <span style="font-size:14px;"><strong>年份：{{ isset($video_arr['year']) ? $video_arr['year'] : "" }}</strong>导演：{{ isset($video_arr['dir']) ? $video_arr['dir'] : "" }}</span>
            </div>
            <div style="padding-top:10px;">
                <strong>简介：</strong>{{ isset($video_arr['desc']) ? $video_arr['desc'] : "" }}
            </div>
            <div>&nbsp;</div>

            @if(!empty($video_arr['playlinks']['youku']))
                <div>
                    <strong>点👇观看：</strong><h2><a href="{{ isset($video_arr['playlinks']['qq']) ? $video_arr['playlinks']['qq'] : "" }}"><img src="/static/ccps/images/youku.png"></a></h2>
                </div>
            @elseif(!empty($video_arr['playlinks']['qq']))
                <div>
                    <strong>点👇观看：</strong><h2><a href="{{ isset($video_arr['playlinks']['seshi']) ? $video_arr['playlinks']['qq'] : "" }}"><img src="/static/ccps/images/youku.png"></a></h2>
                </div>
            @elseif(!empty($video_arr['playlinks']['leshi']))
                <div>
                    <strong>点👇观看：</strong><h2><a href="{{ isset($video_arr['playlinks']['pptv']) ? $video_arr['playlinks']['qq'] : "" }}"><img src="/static/ccps/images/youku.png"></a></h2>
                </div>
            @elseif(!empty($video_arr['playlinks']['pptv']))
                <div>
                    <strong>点👇观看：</strong><h2><a href="{{ isset($video_arr['playlinks']['sohu']) ? $video_arr['playlinks']['qq'] : "" }}"><img src="/static/ccps/images/youku.png"></a></h2>
                </div>
            @elseif(!empty($video_arr['playlinks']['sohu']))
                <div>
                    <strong>点👇观看：</strong><h2><a href="{{ isset($video_arr['playlinks']['youku']) ? $video_arr['playlinks']['youku'] : "" }}"><img src="/static/ccps/images/youku.png"></a></h2>
                </div>
            @endif

            <div class="editor">
                <div>
                    <div>&nbsp;&nbsp;&nbsp;饰演人物</div>
                    <div>&nbsp;</div>
                    @foreach($video_arr['act_s'] as $k=>$val)
                        <img class='listhot' src='{{ isset($val['image']) ? $val['image'] : "" }}' alt='图片关键词' height="100" width="100"/>
                        <span><a href='javascript:;' title='如何选择网站关键词?' target='_self'>{{ $val['name'] }}</a></span>
                    @endforeach
                </div>
            </div>
            </div>
        @endif
            <div class="met_hits"><div class='metjiathis'><div class="jiathis_style"><span class="jiathis_txt">分享到：</span><a class="jiathis_button_icons_1"></a><a class="jiathis_button_icons_2"></a><a class="jiathis_button_icons_3"></a><a class="jiathis_button_icons_4"></a><a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a></div><script type="text/javascript" src="http://v3.jiathis.com/code/jia.js?uid=1346378669840136" charset="utf-8"></script></div>点击次数：<span><script language='javascript' src='../include/hits.php?type=news&id=10'></script></span>&nbsp;&nbsp;更新时间：{{ date('Y-m-d H:i:s',time()) }}&nbsp;【<a href="javascript:window.print()">打印此页</a>】&nbsp;&nbsp;【<a href="javascript:self.close()">关闭</a>】</div>
            <div class="met_page"><h2><a href='/index/del_cache' >返回此页面</a></h2></div>
        </div>
    <div class="clear"></div>

@endsection