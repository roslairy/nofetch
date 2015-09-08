@extends('base')

@section('content')
<div class="container main-container">
    <h3 class="page-header">所有小说</h3>
    <div class="row">
        <div class="col-md-10">
            <div class="table-responsive">
                <table class="table table-hover table-responsive">
                    <thead>
                    <td>#</td>
                    <td>名称</td>
                    <td>作者</td>
                    <td>网站</td>
                    <td>状态</td>
                    <td>最后探测</td>
                    <td>已推送至</td>
                    <td>操作</td>
                    </thead>
                    <tbody>
                    @foreach($novels as $novel)
                    <tr>
                        <td>{{ $novel->id }}</td>
                        <td>{{ $novel->name }}</td>
                        <td>{{ $novel->author }}</td>
                        <td>{{ trans('messages.'.$novel->website) }}</td>
                        <td>{{ trans('state.'.$novel->state) }}</td>
                        <td>{{ $novel->lastDetect }}</td>
                        <td>{{ $novel->latestChapter }}</td>
                        <td>
                            <a class="btn btn-info btn-xs" href="{{ route('edit', [ 'id' => $novel->id, 'task' => 'edit' ]) }}">编辑</a>
                            @if($novel->state == 'detect')
                            <a class="btn btn-inverse btn-xs" href="{{ route('novelPause', [ 'id' => $novel->id ]) }}">暂停</a>
                            @elseif($novel->state == 'pause')
                            <a class="btn btn-inverse btn-xs" href="{{ route('novelResume', [ 'id' => $novel->id ]) }}">恢复</a>
                            @endif
                            <a class="btn btn-danger btn-xs" href="{{ route('novelDelete', [ 'id' => $novel->id ]) }}">删除</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if($novels->hasPages())
            <div class="group-wrapper">
                <div class="pagination pull-right">
		            <ul>
		            	<li class="previous"><a href="{{ $novels->previousPageUrl() }}"><img src="img/previous.png"></a></li>
		            	@if ($novels->currentPage() - 1 > 1)
		            	<li><a>...</a></li>
		            	@endif
		            	@for($i = ($novels->currentPage() - 1 > 1 ? $novels->currentPage() - 1 : 1); $i <= (($novels->currentPage() + 2 < $novels->lastPage()) ? $novels->currentPage() + 2 : $novels->lastPage()); $i++)
		            	<li class="{{ $i == $novels->currentPage() ? 'active' : '' }}"><a href="{{ $novels->url($i) }}">{{ $i }}</a></li>
		            	@endfor
		            	@if ($novels->currentPage() + 2 < $novels->lastPage())
		            	<li><a>...</a></li>
		            	@endif
		            	<li class="next"><a href="{{ $novels->nextPageUrl() }}"><img src="img/next.png"></a></li>
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
                    <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#new-novel-modal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 新建</button>
                </div>
            </div>
        </div>
    </div>
</div>

@include('newNovelModal')

@stop