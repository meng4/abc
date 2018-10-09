<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layui</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="crm/layui/css/layui.css"  media="all">
    <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>

<table class="layui-hide" id="test" lay-filter="test"></table>

<script type="text/html" id="toolbarDemo">
    <div class="layui-btn-container">
        <button class="layui-btn layui-btn-sm" lay-event="getCheckData">获取选中行数据</button>
        <button class="layui-btn layui-btn-sm" lay-event="getCheckLength">获取选中数目</button>
        <button class="layui-btn layui-btn-sm" lay-event="isAll">验证是否全选</button>
    </div>
</script>
<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-xs" lay-event="edit" id="add">添加</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>


<script src="crm/layui/layui.js" charset="utf-8"></script>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->

<script>
    layui.use('table', function(){
        var table = layui.table;

        table.render({
            elem: '#test'
            ,url:'orderList'
            ,toolbar: '#toolbarDemo'
            ,title: '用户数据表'
            ,totalRow: true
            ,cols: [[
                {type: 'checkbox', fixed: 'left'}
                ,{field:'order_id', title:'ID', width:80, fixed: 'left', unresize: true, sort: true, totalRowText: '合计'}
                ,{field:'user_company', title:'公司名', width:120, edit: 'text'}
                ,{field:'order_no', title:'订单编号', width:80, sort: true, totalRow: true}
                ,{field:'user_id', title:'联系人', width:120, edit: 'text'}
                ,{field:'odrder_place', title:'下单时间', width:120}
                ,{field:'odrder_make', title:'成交时间', width:120}
                ,{field:'order_pay', title:'订单金额', width:80, sort: true, totalRow: true}
                ,{field:'order_status', title:'订单状态', width:100, sort: true, totalRow: true}
                ,{field:'right_id', title:'管理员', width:120, edit: 'text'}
                ,{field:'order_ctime', title:'加入时间', width:120}
                ,{field:'order_utime', title:'修改时间', width:120}
                ,{fixed: 'right', title:'操作', toolbar: '#barDemo', width:150}
            ]]
            ,page: true
        });

        //工具栏事件
        table.on('toolbar(test)', function(obj){
            var checkStatus = table.checkStatus(obj.config.id);
            switch(obj.event){
                case 'getCheckData':
                    var data = checkStatus.data;
                    layer.alert(JSON.stringify(data));
                    break;
                case 'getCheckLength':
                    var data = checkStatus.data;
                    layer.msg('选中了：'+ data.length + ' 个');
                    break;
                case 'isAll':
                    layer.msg(checkStatus.isAll ? '全选': '未全选')
                    break;
            };
        });
    });
</script>
<script>

</script>

</body>
</html>