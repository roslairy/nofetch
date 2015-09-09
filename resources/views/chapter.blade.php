@extends('base')

@section('content')
<div class="container main-container">
    <h3 class="page-header">所有章节</h3>
    <div class="row">
        <div class="col-md-10">
            <div class="table-responsive">
                <table class="table table-hover table-plugin">
                    <thead>
                    <td>序号</td>
                    <td>名称</td>
                    <td>小说</td>
                    <td>字数</td>
                    <td>状态</td>
                    </thead>
                    <tbody>
                    @foreach($chapters as $chapter)
                    <tr>
                        <td>{{ $chapter->index }}</td>
                        <td>{{ $chapter->name }}</td>
                        <td>{{ $chapter->novel->name }}</td>
                        @if($chapter->state == 'detected')
                        <td>未下载</td>
                        @else
                        <td>{{ mb_strlen($chapter->content) }}</td>
                        @endif
                        <td>{{ trans('state.'.$chapter->state) }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if($chapters->hasPages())
            <div class="group-wrapper">
                <div class="pagination pull-right">
                    <ul>
                        <li class="previous"><a href="{{ $chapters->previousPageUrl() }}"><img src="img/previous.png"></a></li>
                        @if ($chapters->currentPage() - 1 > 1)
                        <li><a>...</a></li>
                        @endif
                        @for($i = ($chapters->currentPage() - 1 > 1 ? $chapters->currentPage() - 1 : 1); $i <= (($chapters->currentPage() + 2 < $chapters->lastPage()) ? $chapters->currentPage() + 2 : $chapters->lastPage()); $i++)
                        <li class="{{ $i == $chapters->currentPage() ? 'active' : '' }}"><a href="{{ $chapters->url($i) }}">{{ $i }}</a></li>
                        @endfor
                        @if ($chapters->currentPage() + 2 < $chapters->lastPage())
                        <li><a>...</a></li>
                        @endif
                        <li class="next"><a href="{{ $chapters->nextPageUrl() }}"><img src="img/next.png"></a></li>
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