<?php
require_once __DIR__ . '/framework/autoload.php';
require_once __DIR__ . '/weixin/oauth.php';

if(isWechat()){
    session_start();
    $user = Oauth::login('/userinfo.php');
    echo json_encode($user);
}else{
    echo '非微信端';
}
