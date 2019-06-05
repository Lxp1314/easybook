<?php
require_once __DIR__ . '/framework/autoload.php';
require_once __DIR__ . '/weixin/oauth.php';

if(isWechat()){
    $userinfo = $_GET['userinfo'] === '1';
    var_dump($userinfo);
    $user = Oauth::login($_SERVER['REQUEST_URI'], $userinfo);
    echo json_encode($user, JSON_UNESCAPED_UNICODE);
}else{
    echo '非微信端';
}
