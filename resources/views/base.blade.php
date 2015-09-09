<!DOCTYPE html>
<html>
<head lang="zh">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="author" content="roslairy">
    <title>{{ trans('messages.'.(!isset($realPageName) ? $pageName : $realPageName)) }} | Novel Fetcher</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/flat-ui.min.css">
    <link rel="stylesheet" href="css/buttons.min.css">
    <link rel="stylesheet" href="css/nof.css">
    <link rel="icon" href="img/favicon.ico">
</head>
<body>
<nav class="navbar navbar-inverse nof-nav">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('main') }}"><img src="img/small-logo.png"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="main-nav-collapse">
            <ul class="nav navbar-nav">
                <li class="{{ $pageName == 'main' ? 'active' : '' }}"><a href="{{ route('main') }}">主页</a></li>
                <li class="{{ $pageName == 'novel' ? 'active' : '' }}"><a href="{{ route('novel') }}">小说</a></li>
                <li class="{{ $pageName == 'chapter' ? 'active' : '' }}"><a href="{{ route('chapter') }}">章节</a></li>
                <li class="{{ $pageName == 'mail' ? 'active' : '' }}"><a href="{{ route('mail') }}">邮件</a></li>
                <li class="{{ $pageName == 'setting' ? 'active' : '' }}"><a href="{{ route('setting') }}">设置</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ route('logout') }}">退出登录</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

@yield('content')

<div class="footer">
    <div class="container">
        <p id="copyright" class="text-center">Copyright &copy; 2015 Roslairy Crimson, All rights reserved.</p>
    </div>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>