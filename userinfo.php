<?php
require_once __DIR__ . '/framework/autoload.php';
require_once __DIR__ . '/weixin/oauth.php';

if(isWechat()){
    $base = !empty($_GET['base']);
    $user = Oauth::login('/userinfo.php', $base);
    echo json_encode($user);
}else{
    echo '非微信端';
}
