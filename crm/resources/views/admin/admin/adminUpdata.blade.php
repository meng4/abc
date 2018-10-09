<div style="width:600px;margin:0 auto;padding-top:20px;">
    <form class="layui-form" action="">
        <h3 style="color:red;">管理员编辑</h3>
        {{--<div class="layui-form-item" style="margin-top:5px">--}}
            {{--<label class="layui-form-label">管理员：</label>--}}
            {{--<div class="layui-input-block">--}}
                {{--<input type="text" name="name" lay-verify="required" win-verify="required" placeholder="请填写管理员名称" autocomplete="off" class="layui-input" />--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="layui-form-item">--}}
            {{--<label class="layui-form-label">密码：</label>--}}
            {{--<div class="layui-input-block">--}}
                {{--<input type="text" name="pwd" win-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input" />--}}
            {{--</div>--}}
        {{--</div>--}}
        <input type="hidden" name="old_name" value="{{$admin['admin_name']}}">
        <input type="hidden" name="id" value="{{$admin['admin_id']}}">
        <div class="layui-form-item">
            <label class="layui-form-label">管理员：</label>
            <div class="layui-input-inline">
                <input type="text" name="admin_name" value="{{$admin['admin_name']}}" placeholder="请输入管理员名称" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">密码：</label>
            <div class="layui-input-inline">
                <input type="text" name="admin_pwd"  placeholder="请输入密码" autocomplete="off" class="layui-input">
            </div>
        </div>
        {{--<div class="layui-form-item">--}}
            {{--<label class="layui-form-label">是否启用：</label>--}}
            {{--<div class="layui-input-block winui-switch">--}}
                {{--<input name="isNecessary" lay-filter="isNecessary" type="checkbox" lay-skin="switch" lay-text="是|否" />--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="layui-form-item">
            <label class="layui-form-label">是否启用：</label>
            <div class="layui-input-block">
                @if( $admin['admin_status'] == 1 )
                    <input type="checkbox" name="admin_status" checked lay-filter="status" lay-skin="switch" lay-text="是|否">
                @else
                    <input type="checkbox" name="admin_status" lay-filter="status" lay-skin="switch" lay-text="是|否">
                @endif
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="winui-btn" lay-submit lay-filter="formAddMenu">确定</button>
                <button class="winui-btn" onclick="winui.window.close('addMenu'); return false;">取消</button>
            </div>
        </div>
    </form>
    <div class="tips">Tips：1.系统菜单不可以删除 2.窗口标题若不填则默认和菜单名称相同</div>
</div>
<script>
    layui.use(['form','layer'], function (form) {
        var $ = layui.$
            , msg = winui.window.msg;

        form.render();
        form.on('switch(status)', function (data) {
            $(data.elem).val(data.elem.checked);
        });
        form.on('submit(formAddMenu)', function (data) {
            //管理员名称验证
            var name = $('[name=admin_name]').val();
            if( name == '' ){
                msg('请填写管理员名称！');
                return false;
            }
            var pwd = $('[name=admin_pwd]').val();
            if( pwd == '' ){
                msg('请填写密码！');
                return false;
            }
            var status = $('[name=admin_status]').prop('checked');
            var old_name = $('[name=old_name]').val();
            var id = $('[name=id]').val();
//            msg(status);
//            return false;
            //表单验证
            if (winui.verifyForm(data.elem)) {
                layui.$.ajax({
                    type: 'post',
                    url: 'adminup',
                    async: false,
                    data: 'old_name='+old_name+'&id='+id+'&admin_name='+name+'&admin_pwd='+pwd+'&admin_status='+status+'&_token='+'{{@csrf_token()}}',
                    dataType: 'json',
                    success: function (json) {
                        if (json.status == 1000) {
                            msg(json.msg,{icon:6,time:2000});
                        } else {
                            msg(json.msg)
                        }
                        winui.window.close('adminadd');
//                        $(".layui-laypage-btn")[0].click();
                    },
                    error: function (xml) {
                        msg('修改失败！');
                        console.log(xml.responseText);
                    }
                });
//                winui.window.close(adminadd);
            }
//            $(".layui-laypage-btn")[0].click();
            return false;
        });
    });
</script>