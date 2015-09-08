@extends('base')

@section('content')
<div class="nof-head">
    <div class="container">
        <img id="big-logo" class="center-block" src="img/big-logo.png">
        <h5 id="logo-h2" class="text-center">Novel Fetcher, 追小说的最佳选择。</h5>
        <button id="chase-btn" type="button" class="button button-3d button-primary button-rounded center-block" data-toggle="modal" data-target="#new-novel-modal">开始追！</button>
    </div>
</div>

<div class="container main-container">
    <div class="row">
        <div class="col-md-9">
            <h3 class="page-header">使用说明</h3>
            <p>
                1. 点击【开始追！】按钮
            </p>
            <p>
                2. 输入目录网址，点击添加按钮
            </p>
            <p>
                3. 输入小说的基本信息，进行基础设置
            </p>
            <p>
                4. 享受即时推送的快感吧！
            </p>
            <h3 class="page-header">基本情况</h3>
            <p>
                目前共有 <strong>{{ $novelCnt }}</strong> 本小说正在探测队列
            </p>
            <p>
            <p>
                目前共有 <strong>{{ $chapterCnt }}</strong> 个章节正在下载队列
            </p>
            <p>
                目前共有 <strong>{{ $mailCnt }}</strong> 个章节正在邮件队列
            </p>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span>可用操作</span>
                </div>
                <div class="panel-body">
                    <a class="btn btn-danger btn-block" onclick="alert('删除失败！');"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> 删除所有的小说</a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('newNovelModal')

@stop