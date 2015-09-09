@extends('base')

@section('content')
<div class="container main-container">
    <h3 class="page-header">小说信息</h3>
    <div class="row">
        <div class="col-md-10">
            <form method="post" action="{{ route('editSave') }}">
            	<input type="hidden" name="novelId" value="{{ $id }}">
            	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="novelName" class="control-label col-sm-2">小说名：</label>
                        <div class="col-sm-10">
                            <input id="novelName" type="text" name="novelName" class="form-control" value="{{ $name }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="novelAuthor" class="control-label col-sm-2">作者：</label>
                        <div class="col-sm-10">
                            <input id="novelAuthor" type="text" name="novelAuthor" class="form-control" value="{{ $author }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="novelWebsite" class="control-label col-sm-2">网站：</label>
                        <div class="col-sm-10">
                        	<select id="novelWebsite" name="novelWebsite" class="form-control">
                        		@foreach($selects as $select)
                        		<option value="{{ $select }}" {{ $select == $website ? 'selected' : '' }}>{{ trans('messages.'.$select) }}</option>
                        		@endforeach
                        	</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="novelUrl" class="control-label col-sm-2">网站：</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-addon">http://</div>
                                <input id="novelUrl" type="text" name="novelUrl" class="form-control" value="{{ $url }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="novelBegin" class="control-label col-sm-2">开始推送章节：</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input id="novelBegin" type="number" name="novelBegin" class="form-control" min="1" value="{{ $begin }}">
                                <div class="input-group-addon">章</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-lg-offset-2">
                            <input type="submit" class="btn btn-primary" value="提交">
                            <input type="reset" class="btn btn-default" value="重置">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span>可用操作</span>
                </div>
                <div class="panel-body">
                    <a class="btn btn-primary btn-block" href="{{ route('main') }}">返回主页</a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop