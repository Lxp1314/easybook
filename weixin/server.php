<?php

include __DIR__ . '/../framework/autoload.php';

use EasyWeChat\Foundation\Application;

$options = config('weixin');

$app = new Application($options);
$server = $app->server;
$server->setMessageHandler(function ($message) {
    global $app;
    $staffService = $app->staff;//客服消息服务
    $openId = $message->FromUserName;
    $staffService->message(json_encode($message))
        // ->by('wuyun@test')
        ->to($oepnId)
        ->send();
    switch ($message->MsgType) {
        case 'event':
            // $message的内容
            // {
            //     "ToUserName": "gh_712b3ff655bb",
            //     "FromUserName": "oXfiP5lm2s4SXbtDDalXqebjM6iM",
            //     "CreateTime": "1557799175",
            //     "MsgType": "event",
            //     "Event": "subscribe",
            //     "EventKey": null
            // }
            require_once 'msg_event.php';
            $event = new WeixinEvent($app, $message);
            return $event->dealEvent();
        case 'text':
            // $message的内容

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
