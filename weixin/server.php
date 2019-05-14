<?php

include __DIR__ . '/../framework/autoload.php';

use EasyWeChat\Foundation\Application;

$options = config('weixin');

$app = new Application($options);
$server = $app->server;
$server->setMessageHandler(function ($message) {
    global $app;
    switch ($message->MsgType) {
        case 'event':
            require_once 'msg_event.php';
            $event = new WeixinEvent($app, $message);
            return $event->dealEvent();
        case 'text':
            require_once 'msg_text.php';
            $txt = new WeixinText($app, $message);
            return $txt->dealContent();
        case 'image':
            return '收到图片消息：' . $message->PicUrl;
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
        default:
            return '收到其它消息';
            break;
    }
    // return  "回复【{$msg->Content}】:亲，你来了，欢迎关注【测试公众号】！";
});

$response = $server->serve();

// 将响应输出
$response->send(); 
