<?php

include __DIR__ . '/../vendor/autoload.php';

use EasyWeChat\Foundation\Application;

$options = include 'config.php';

$app = new Application($options);
$server = $app->server;
$server->setMessageHandler(function ($message) {
    return  "回复【$message】:亲，你来了，欢迎关注【易书在线】！";
});

$response = $server->serve();

// 将响应输出
$response->send(); 
