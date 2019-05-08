<?php

include __DIR__ . '/../vendor/autoload.php';

use EasyWeChat\Foundation\Application;

$options = include 'config.php';

$app = new Application($options);
$server = $app->server;
$server->setMessageHandler(function ($message) {
    $msg = json_decode($message);
    return  "回复【{$msg->Content}】:亲，你来了，欢迎关注【测试公众号】！";
});

$response = $server->serve();

// 将响应输出
$response->send(); 
