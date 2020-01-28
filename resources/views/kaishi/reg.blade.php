<!DOCTYPE html>
<html>
<head>

    <title>登录表单</title>
    <base href="/static/login/">
    <!-- Meta-Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<center>
<h1>注 册表单</h1>
{{--登录--}}
<div class="container w3layouts agileits">
    {{--注 册--}}
    <div class="register w3layouts agileits">
        <h2>注 册</h2>
        <form action="{{ url("/reg/reg") }}" method="post">
            @csrf
            <input type="text" Name="uname" placeholder="用户名" required="required"><br /><br />
            <input type="password" Name="upwd" placeholder="密码" required="required"><br /><br />
            <input type="text" Name="tel" placeholder="手机号码" required="required"><br /><br />
            <div class="send-button w3layouts agileits">
                <input type="submit" value="免费注册">
            </div>
        </form>

        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>


<div class="footer w3layouts agileits">
    <p>
        <a href="http://www.cssmoban.com/" target="_blank" title="全职高手">全职高手</a>&nbsp;&nbsp;之&nbsp;&nbsp;
        <a href="http://www.cssmoban.com/" target="_blank" title="巅峰荣耀">巅峰荣耀</a>
    </p>
</div>
</center>
</body>
</html>
