<?php
require_once __DIR__ . '/framework/autoload.php';
require_once __DIR__ . '/weixin/oauth.php';

if(isWechat()){
    $base = $_GET['base'] === '1';
    var_dump($base);
    $user = Oauth::login($_SERVER['REQUEST_URI'], $base);
    echo json_encode($user, JSON_UNESCAPED_UNICODE);
}else{
    echo '非微信端';
}
