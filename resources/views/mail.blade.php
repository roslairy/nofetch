@extends('base')

@section('content')
<div class="container main-container">
    <h3 class="page-header">所有推送</h3>
    <div class="row">
        <div class="col-md-10">
            <div class="table-responsive">
                <table class="table table-hover table-plugin">
                    <thead>
                    <td>#</td>
                    <td>时间</td>
                    <td>小说</td>
                    <td>章节</td>
                    <td>状态</td>
                    <td>字节数</td>
                    </thead>
                    <tbody>
                    @foreach($mails as $mail)
                    <tr>
                        <td>{{ $mail->id }}</td>
                        <td>{{ $mail->updated_at }}</td>
                        <td>{{ $mail->novel->name }}</td>
                        <td>{{ $mail->chapter->name }}</td>
                        <td>{{ trans('state.'.$mail->state) }}</td>
                        <td>{{ strlen($mail->content) }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if($mails->hasPages())
            <div class="group-wrapper">
                <div class="pagination pull-right">
                    <ul>
                        <li class="previous"><a href="{{ $mails->previousPageUrl() }}"><img src="img/previous.png"></a></li>
                        @if ($mails->currentPage() - 1 > 1)
                        <li><a>...</a></li>
                        @endif
                        @for($i = ($mails->currentPage() - 1 > 1 ? $mails->currentPage() - 1 : 1); $i <= (($mails->currentPage() + 2 < $mails->lastPage()) ? $mails->currentPage() + 2 : $mails->lastPage()); $i++)
                        <li class="{{ $i == $mails->currentPage() ? 'active' : '' }}"><a href="{{ $mails->url($i) }}">{{ $i }}</a></li>
                        @endfor
                        @if ($mails->currentPage() + 2 < $mails->lastPage())
                        <li><a>...</a></li>
                        @endif
                        <li class="next"><a href="{{ $mails->nextPageUrl() }}"><img src="img/next.png"></a></li>
                    </ul>
                </div>
            </div>
            @endif
        </div>
        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span>可用操作</span>
                </div>
                <div class="panel-body">
                    <a class="btn btn-primary btn-block">暂无</a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop