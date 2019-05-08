<?php

include __DIR__ . '/../vendor/autoload.php';

use EasyWeChat\Foundation\Application;

$options = include 'config.php';

$app = new Application($options);
$server = $app->server;
$server->setMessageHandler(function ($message) {
    switch ($message->MsgType) {
        case 'event':
            return '收到事件消息';
            break;
        case 'text':
            return '收到文字消息：' . $message->Content;
            break;
        case 'image':
            return '收到图片消息';
            break;
        case 'voice':
            return '收到语音消息';
            break;
        case 'video':
            return '收到视频消息';
            break;
        case 'location':
            return '收到坐标消息';
            break;
        case 'link':
            return '收到链接消息';
            break;
        // ... 其它消息
        default:
            return '收到其它消息';
            break;
    }
    // return  "回复【{$msg->Content}】:亲，你来了，欢迎关注【测试公众号】！";
});

$response = $server->serve();

// 将响应输出
$response->send(); 
