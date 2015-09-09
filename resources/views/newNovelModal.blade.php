<div class="modal fade" id="new-novel-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="get" action="{{ route('edit', [ 'task' => 'new' ]) }}">
                <input type="hidden" name="task" value="new">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">增加小说</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="novelUrl" class="control-label">小说目录网址： <small class="text-primary">如: www.77nt.com/37637/</small></label>
                        <div class="input-group">
                            <div class="input-group-addon">http://</div>
                            <input id="novelUrl" name="novelUrl" class="form-control" type="text" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary">追！</button>
                </div>
            </form>
        </div>
    </div>
</div>