#!/usr/bin/env php
#coding: utf8

<?php
    function sign($data_arr) {
        return md5(join('',$data_arr));
    };

    function post($url, $data){
        $postdata = http_build_query($data);
        $opts = array('http' => array( 'method' => 'POST','header' => 'Content-type: application/x-www-form-urlencoded', 'content' => $postdata ) );
        $context = stream_context_create($opts);
        $result = file_get_contents($url, false, $context);
        return $result;
    };

    function pay() {
        #如果是 web 应用，这里先获取用户充值参数，然后创建本地订单，然后把构造好的参数 post 到 bufpay
        #如果希望用 bufpay 的支付页面，这里可以返回一个构造好的表单给用户（如下），在这个表单里面 post 到 bufpay

        #<!DOCTYPE html>
        #<html>
        #    <head><title>redirect...</title></head>
        #    <body>
        #        <form id="post_data" action="{{bufpay_api}}" method="post">
        #            {% for k, v in data.items() %}
        #            <input type="hidden" name="{{k}}" value="{{v}}"/>
        #            {% endfor%}
        #        </form>
        #        <script>document.getElementById("post_data").submit();</script>
        #    </body>
        #</html>

        $pay_data = array(
            'name' => '内容订阅一年期',
            'pay_type' => 'wechat',
            'price' => '50.00',
            'order_id' => '999',
            'order_uid' => 'hi@sideidea.com',
            'notify_url' => 'http://sideidea.com/bufpay_notify',
            'return_url' => 'http://sideidea.com'
        );
        $pay_data['sign'] = sign([
            $pay_data['name'],
            $pay_data['pay_type'],
            $pay_data['price'],
            $pay_data['order_id'],
            $pay_data['order_uid'],
            $pay_data['notify_url'],
            $pay_data['return_url'],
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'  #app secret, 这里需要修改为自己的
        ]);
        return json_decode(post('https://bufpay.com/api/pay/2?format=json', $pay_data));
    };

    function query($aoid) {
        return file_get_contents('https://bufpay.com/api/query/' . $aoid);
    };

    $resp = pay();
    var_dump($resp);
    var_dump(query($resp -> aoid));
?>
