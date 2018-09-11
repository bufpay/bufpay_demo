#!/usr/bin/env php

<?php

    #注意: 使用之前先到 bufpay 后台上传微信、支付宝App生成的收款二维码

    $price = $_GET('price'); # 获取充值金额
    $order_id = '101';       # 自己创建的本地订单号
    $order_uid = 'hello@hello.com';  # 订单对应的用户id
    $name = 'vip year fee';  # 订单商品名称
    $pay_type = 'wechat';    # 付款方式
    $notify_url = 'http://xxxx.com/notify_url.php';   # 回调通知地址
    $return_url = 'http://xxxx.com/return_url.php';   # 支付成功页面跳转地址

    $secret = 'your app secret';     # app secret, 在个人中心配置页面查看
    $api_url = 'https://bufpay.com/api/pay/XXX';   # 付款请求接口，在个人中心配置页面查看

    function sign($data_arr) {
        return md5(join('',$data_arr));
    };

    $sign = sign(array($name, $pay_type, $price, $order_id, $order_uid, $notify_url, $return_url, $secret));


echo '<html>
      <head><title>redirect...</title></head>
      <body>
          <form id="post_data" action="'.$api_url.'" method="post">
              <input type="hidden" name="name" value="'.$name.'"/>
              <input type="hidden" name="pay_type" value="'.$pay_type.'"/>
              <input type="hidden" name="price" value="'.$price.'"/>
              <input type="hidden" name="order_id" value="'.$order_id.'"/>
              <input type="hidden" name="order_uid" value="'.$order_uid.'"/>
              <input type="hidden" name="notify_url" value="'.$notify_url.'"/>
              <input type="hidden" name="return_url" value="'.$return_url.'"/>
              <input type="hidden" name="sign" value="'.$sign.'"/>
          </form>
          <script>document.getElementById("post_data").submit();</script>
      </body>
      </html>';
?>