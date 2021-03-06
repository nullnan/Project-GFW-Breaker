let action = getQueryString('action');
$("#nav-shop").addClass('layui-this');
area = $("#main-content-area");
area.append(`
<div class="layui-container">
    <div class="layui-row">
        
    </div>
</div>
`);
let data = {};
data.app_id = 1;
data.type = 'get-plan';
data.timestamp = getUnixTS();
data.sign = $.md5(
    'app_id' + data.app_id +
    'timestamp' + data.timestamp +
    'type' + data.type +
    '6ab43fb5a4d624f9fa000bc83ccef011'
);
data.sign = data.sign.toUpperCase();
$.ajax({
    url: 'API/shop.php',
    type: "POST",
    dataType: 'json',
    timeout: 2000,
    data: data,
    tryCount: 0,
    retryLimit: 5,
    success: function (result) {
        let json = eval(result);
        if (json['code'] === 100) {
            let area = $("#main-content-area .layui-row");
            for (let i = 0; i < json['data']['row']; i++) {
                area.append(`
                <div class="layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg-3">
                    <div class="shop-plan-block ` + randomColorClass() + `">
                        <h2>` + json['data'][i]['name'] + `</h2>
                        <p><span>流量：</span>` + json['data'][i]['flow_limit'] + `GB/月</p>
                        <p><span>价格：</span>￥` + json['data'][i]['price'] + `/月</p>
                        <p><span>介绍：</span>` + json['data'][i]['info'] + `</p>
                        <button type="button" class="layui-btn layui-btn-fluid" id="shop-buy-btn-` + json['data'][i]['id'] + `">购买</button>
                    </div>
                </div>
                `);
                $("#shop-buy-btn-" + json['data'][i]['id']).click(function () {
                    if (is_login) {
                        layui.use('layer', function () {
                            let layer = layui.layer;
                            layer.open({
                                type: 2,
                                title: '购买计划',
                                content: './iframe/shop-buy.html?id=' + json['data'][i]['id'],
                                area: ['350px', '400px'],
                                scrollbar: false
                            });
                        });
                    } else {
                        layui.use('layer', function () {
                            let layer = layui.layer;
                            layer.open({
                                title: '警告',
                                content: '您尚未登录，将跳转至登录页',
                                yes: function (index) {
                                    window.location.href = 'login.html';
                                    layer.close(index);
                                }
                            });
                        });
                    }
                })
            }
        } else layui.use('layer', function () {
            let layer = layui.layer;
            layer.alert('奇怪的错误增加了！')
        });
    },
    error: function () {
        if (this.tryCount < this.retryLimit) {
            this.tryCount++;
            $.ajax(this);
        } else {
            layui.use('layer', function () {
                let layer = layui.layer;
                layer.msg('连接服务器超时,请检查您的网络连接后重试')
            });
        }
    }
});