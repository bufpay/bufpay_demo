<?php

# 签名函数
function sign($data_arr) {
    return md5(join('',$data_arr));
};

$sign = sign([
    $_POST['aoid'],
    $_POST['order_id'],
    $_POST['order_uid'],
    $_POST['price'],
    $_POST['pay_price'],
    'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'
]);

# 对比签名
if($sign == $_POST['sign']) {
    # do something

    # $query = $conn->prepare("UPDATE users SET expiry_date=:d, status=1 where username=:u");
    # $query->bindParam(':u', $_GET['username']);
    # $query->bindParam(':d', $_GET['date']);
    # $query->execute();

    echo 'ok';
} else {
    header("HTTP/1.0 405 Method Not Allowed");
    exit();
};

?>
