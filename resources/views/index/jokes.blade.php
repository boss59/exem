@extends('layout.ccps')

@section('title')
   搞笑段子
@endsection

{{--主体--}}
@section('content')
    <div class="sb_box">
        <h3 class="title">
            <div class="position">当前位置：
                <a href="/index/index" title="网站首页">网站首页</a> &gt;
                <a href="/index/jokes" >搞笑段子</a></div>
            <span>搞笑段子</span>
        </h3>
        <div class="clear"></div>

        <div class="active" id="shownews">
            <h1 class="title">搞笑段子</h1>
            <div class="editor"><div>
                    <div>&nbsp;</div>
                    <ol>
                    @foreach($jokes['result'] as $k=>$v)
                        <li>
                            <span style="font-size:13px;">
                                <strong>{{ $v['content'] }}</strong>
                                <span style="font-size:12px;">{{ $v['updatetime'] }}</span>
                            </span><br />
                        </li>
                    @endforeach
                    </ol>
                    <div id="metinfo_additional"></div></div><div class="clear"></div></div>
            <div class="met_hits"><div class='metjiathis'><div class="jiathis_style"><span class="jiathis_txt">分享到：</span>
                        <a class="jiathis_button_icons_1"></a><a class="jiathis_button_icons_2"></a><a class="jiathis_button_icons_3"></a><a class="jiathis_button_icons_4"></a><a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a></div><script type="text/javascript" src="http://v3.jiathis.com/code/jia.js?uid=1346378669840136" charset="utf-8"></script></div>点击次数：<span><script language='javascript' src='../include/hits.php?type=news&id=10'></script></span>&nbsp;&nbsp;更新时间：2012-07-17 16:53:59&nbsp;&nbsp;【<a href="javascript:window.print()">打印此页</a>】&nbsp;&nbsp;【<a href="javascript:self.close()">关闭</a>】</div>
            <div class="met_page"><a href='/index/index' >新手使用MetInfo建站步骤</a></div>
        </div>
    </div>
    <div class="clear"></div>
@endsection