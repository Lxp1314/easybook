<?php

include __DIR__ . '/vendor/autoload.php';

use EasyWeChat\Foundation\Application;

$options = [
    'debug'  => true,
    //测试号
//    'app_id' => 'wxa88af71505f895da',
//    'secret' => 'cf05973f5465279b2249ed983ffe19cc',
//    'token'  => 'mytest',

    'app_id' => 'wx7c58cc4ee296d6d7',
    'secret' => 'aa56d5f56c8cd378832cd5fbaec53b54',
    'token'  => 'wuyun',

    // 'aes_key' => null, // 可选

    'log' => [
        'level' => 'debug',
        'file'  => '/source/easybook/logs/easywechat.log', // XXX: 绝对路径！！！！
    ],

    //...
];

$app = new Application($options);
$server = $app->server;
$server->setMessageHandler(function ($message) {
    return "亲，你来了，欢迎关注【易书在线】！";
});

$response = $server->serve();

// 将响应输出
$response->send(); 
