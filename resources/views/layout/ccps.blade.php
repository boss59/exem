<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <base href="/static/ccps/">
    <title>企业站&nbsp;&nbsp;&nbsp;@yield('title')</title>
    <meta name="description" content="网站描述，一般显示在搜索引擎搜索结果中的描述文字，用于介绍网站，吸引浏览者点击。" />
    <meta name="keywords" content="网站关键词" />
    <meta name="generator" content="MetInfo 5.1.7" />
    <link href="favicon.ico" rel="shortcut icon" />
    <link rel="stylesheet" type="text/css" href="images/metinfo.css" />
    <script src="images/jQuery1.7.2.js" type="text/javascript"></script>
    <script src="images/ch.js" type="text/javascript"></script>
    <script src="images/fun.inc.js" type="text/javascript"></script>
</head>
<body>
<script type="text/javascript">(function($){$.fn.snow = function(options){var $flake = $('<div id="snowbox" />').css({'position': 'absolute','z-index':'9999', 'top': '-50px'}).html('&#10052;'),documentHeight = $(document).height(),documentWidth= $(document).width(),defaults = {minSize: 10,maxSize: 20,newOn: 1000,flakeColor: "#AFDAEF" /* 此处可以定义雪花颜色，若要白色可以改为#FFFFFF */},options= $.extend({}, defaults, options);var interval= setInterval( function(){var startPositionLeft = Math.random() * documentWidth - 100,startOpacity = 0.5 + Math.random(),sizeFlake = options.minSize + Math.random() * options.maxSize,endPositionTop = documentHeight - 200,endPositionLeft = startPositionLeft - 500 + Math.random() * 500,durationFall = documentHeight * 10 + Math.random() * 5000;$flake.clone().appendTo('body').css({left: startPositionLeft,opacity: startOpacity,'font-size': sizeFlake,color: options.flakeColor}).animate({top: endPositionTop,left: endPositionLeft,opacity: 0.2},durationFall,'linear',function(){$(this).remove()});}, options.newOn); };})(jQuery);$(function(){ $.fn.snow({ minSize: 5, /* 定义雪花最小尺寸 */ maxSize: 50,/* 定义雪花最大尺寸 */ newOn: 300 /* 定义密集程度，数字越小越密集 */ });});</script>
{{--头部导航--}}
<header>
    <div class="inner">
        <div class="top-logo">
            <a href="index.html" title="网站名称" id="web_logo"><img src="{{ asset("/imgs/yes/zxc.jpg") }}" width="200" height="60" alt="网站名称" title="网站名称" style="margin:30px 0px 0px 0px;" /></a>

            <ul class="top-nav list-none">
                <li class="t">
                    <a href='' onclick='SetHome(this,window.location,"非IE浏览器不支持此功能，请手动设置！");' style='cursor:pointer;' title='设为首页'  >设为首页</a><span>|</span>
                    <a href='' onclick='addFavorite("非IE浏览器不支持此功能，请手动设置！");' style='cursor:pointer;' title='收藏本站'  >收藏本站</a><span>|</span><a class="fontswitch" id="StranLink" href="javascript:StranBody()">繁体中文</a><span>|</span>
                    <a href='' title='WAP'>WAP</a><span>|</span>
                    <a href='' title='English'  >English</a><span>|</span>
                    <a href='' title='我的订单' class='shopweba'>我的订单</a></li><li class="b">
                    <a href="http://www.yuluju.com/lizhimingyan/11830.html"><strong><span style="color:#ffff00;"><span style="font-size: 14px;"></span>海浪为劈风斩浪的航船饯行，为随波逐流的轻舟送葬。</span></strong></a></li>
            </ul>
        </div>

        <nav>
            <ul class="list-none" id="menu">
                <li id="nav_10001" style='width:121px;' class='navdown'>
                    <a href='{{ url('index/index') }}'><span>网站首页</span></a>
                </li>
                <li class="line"></li>
            @foreach($arr["nav"] as $v)
                <li id='nav_36' style='width:121px;' >
                    <a href='/index/news?nav_id={{ $v["nav_id"] }}'><span>{{ $v["nav_name"] }}</span></a>
                </li>
                <li class="line"></li>
            @endforeach
                <li id='nav_1' style='width:120px;' >
                    <a href='{{ url('/index/video') }}'><span>大地影院</span></a>
                </li>
                <li class="line"></li>
                <li id='nav_1' style='width:120px;' ><a href='{{ url('/index/jokes') }}'><span>搞笑段子</span></a></li>
            </ul>
        </nav>
    </div>
</header>

{{-----------------------------------------------------------------------------------------------}}

{{--公共部分--}}
@section('sidebar')
    <div class="inner met_flash">
        <div class="flash">
            <a href='' target='_blank' title='企业网站管理系统'>
                <img src='images/1342430358.jpg' width='980' alt='企业网站管理系统' height='90'></a>
        </div>
    </div>
    <div class="sidebar inner">
        <div class="sb_nav">
            <h3 class='title myCorner' data-corner='top 5px'>所有分类</h3>
            <div class="active" id="sidebar" data-csnow="2" data-class3="0" data-jsok="2">
                @foreach($arr["cate"] as $v)
                <dl class="list-none navnow">
                    <dt id='part2_4'>
                        <a href='/index/news?cid={{ $v['cid'] }}'  title='公司动态' class="zm"><span>{{ $v['cname'] }}</span></a>
                    </dt>
                </dl>
                @endforeach
                <div class="clear"></div></div>

            <h3 class='title line myCorner' data-corner='top 5px'>联系方式</h3>
            <div class="active editor"><div>
                    如有问题<strong>请在拨打下方</strong>电话</div>
                <div>
                    全职 高手 有限公司</div>
                <div>
                    电 &nbsp;话：1762321232</div>
                <div>
                    邮 &nbsp;编：06000</div>
                <div>
                    Email：2792593650@qq.com</div>
                <div>
                    网 &nbsp;址：<a href="http://www.exem.com/admin/login">www.vonetxs.com</a></div>
                <div class="clear"></div></div>
        </div>
@show
{{-----------------------------------------------------------------------------------------------}}



<!-- 主体 -->
@yield('content')


    <div class="index-product style-2">
        <h3 class='title myCorner' data-corner='top 5px'>
            <span></span>
            <div class="flip"><p id="trigger"></p> <a class="prev" id="car_prev" href="javascript:void(0);"></a> <a class="next" id="car_next" href="javascript:void(0);"></a></div>
            <a href="https://image.baidu.com/search/index?tn=baiduimage&ct=201326592&lm=-1&cl=2&ie=gb18030&word=%C3%C0%C5%AE&fr=ala&ala=1&alatpl=adress&pos=0&hs=2&xthttps=111111"  class="more">更多>></a>
        </h3>
        <div class="active clear">
            <div class="profld" id="indexcar" data-listnum="5">
                <ol class='list-none metlist'>
                    @foreach($arr["product"] as $v)
                        <li class='list'><a href='javascript:;' class='img'><img src='{{ $v["images"] }}'  width='160' height='130' /></a> <h3 style='width:160px;'><a href='#' >{{ $v["pname"] }}</a></h3></li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>

    <div class="clear"></div>
    <div class="index-links">
        <h3 class="title">
            <a href="https://image.baidu.com/search/index?tn=baiduimage&ct=201326592&lm=-1&cl=2&ie=gb18030&word=%C3%C0%C5%AE&fr=ala&ala=1&alatpl=adress&pos=0&hs=2&xthttps=111111" title="链接关键词" class="more">更多>></a>
        </h3>
        <div class="active clear">
            <div class="img"><ul class='list-none'>
                </ul>
            </div>
            <div class="txt"><ul class='list-none'>
            @foreach($arr['link'] as $v)
                    <li>&nbsp&nbsp;<a href='{{ $v["furl"] }}' target='_blank' title='企业网站管理系统'>{{ $v["fname"] }}</a> &nbsp;丨</li>
            @endforeach
                </ul>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

{{--底部导航--}}
<footer data-module="10001" data-classnow="10001">
    <div class="inner">
        <div class="foot-nav">
        @foreach($arr["link"] as $v)
            <a href='{{ $v["furl"] }}'  title='公司动态'>{{ $v["fname"] }}</a> &nbsp;<span>|</span>
        @endforeach
        </div>
        <div class="foot-text">
            <h5>命运从来都是挂握在自己的手中</h5>
            <p>失败与挫折并不可怕，可怕的是丧失了自信，丧失了激发我们积极向上的内在动力。让我们重拾信心，始终坚信：人生航船由我们自己掌舵，只要鼓起自信的风帆，就能战胜风浪，抵达美好彼岸。</p>
        </div>
    </div>
</footer>

<script src="images/fun.inc.js" type="text/javascript"></script>
<div style="text-align:center;">
    <p>来源：More Templates <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a></p>
</div>

</body>
</html>
<script>
$(function(){

    $(document).on('click','#menu',function(){
        var urlstr = location.href;



    })
});
</script>