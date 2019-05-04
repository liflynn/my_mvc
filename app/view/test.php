<header>
    <meta charset="utf-8">
    <link type="text/css" rel="styleSheet"  href="<?php echo get_domain(); ?>/assets/layui/css/layui.css" />
</header>
<script src="<?php echo get_domain(); ?>/assets/layui/layui.js"></script>
<body>
<form class="layui-form bl-form-theme-blue bl-form-style-1" >
    <div class="layui-inline">
        <label class="layui-form-label bl-form-label">姓名</label>
        <div class="layui-inline">
            <input type="text" name="keywords" class="layui-input" placeholder="请输入姓名" style="width: 238px">
        </div>
    </div>
    <div class="layui-inline">
        <button class="layui-btn" lay-submit="" lay-filter="search" style="margin-left: 15px;">
            <i class="layui-icon layui-icon-search"></i>搜索
        </button>
    </div>
</form>
    <table id="demo" lay-filter="test"></table>
</body>
<script>
    layui.use('table', function(){
        var table = layui.table;

        //第一个实例
        var oTable = table.render({
            elem: '#demo'
            ,url: '/study/table_data' //数据接口
            ,page: true //开启分页
            ,cols: [[ //表头
                {field: 'contactId', title: 'ID',  sort: true, fixed: 'left'},
                {field: 'givenName', title: '姓名', sort: true, fixed: 'left'},
                {field: 'mobilePhoneNumber', title: '手机号',  sort: true, fixed: 'left'}
            ]]
        });

        layui.use('form', function(){
            var form = layui.form;

            //监听提交
            form.on('submit(search)', function (data) {
                oTable.reload({
                    page: {
                        theme: '#32ccbd'
                        , layout: ['limit', 'count', 'prev', 'page', 'next', 'skip']
                        , curr: 1
                    }
                    , where: data.field
                });
                return false;
            });
        });

    });


</script>