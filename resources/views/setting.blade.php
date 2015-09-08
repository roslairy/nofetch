@extends('base')

@section('content')
<div class="container main-container">
    <h3 class="page-header">设置</h3>
    <div class="row">
        <div class="col-md-10">
            <form method="post" action="{{ route('settingSave') }}">
            	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="fetchInterval" class="control-label col-sm-2">探测间隔：</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input id="fetchInterval" type="number" name="fetchInterval" class="form-control" min="1" max="1440" value="{{ $fetchInterval }}">
                                <div class="input-group-addon">分钟</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="downloadInterval" class="control-label col-sm-2">下载间隔：</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input id="downloadInterval" type="number" name="downloadInterval" class="form-control" min="1" max="1440" value="{{ $downloadInterval }}">
                                <div class="input-group-addon">分钟</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pushInterval" class="control-label col-sm-2">推送间隔：</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input id="pushInterval" type="number" name="pushInterval" class="form-control" min="1" max="1440" value="{{ $pushInterval }}">
                                <div class="input-group-addon">分钟</div>
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
                    <a class="btn btn-primary btn-block" href="{{ route('settingReset') }}">恢复为初始值</a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop