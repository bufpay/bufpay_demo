<?php

# 签名函数
function sign($data_arr) {
    return md5(join('',$data_arr));
};

$sign = sign(array($_POST['aoid'], $_POST['order_id'], $_POST['order_uid'], $_POST['price'], $_POST['pay_price'], 'your app secret'));

# 对比签名
if($sign == $_POST['sign']) {
    # do something update database

    echo 'ok';
} else {
    header("HTTP/1.0 405 Method Not Allowed");
    exit();
};

?>
