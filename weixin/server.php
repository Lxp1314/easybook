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
            switch ($message->Event){
                case 'subscribe':
                    return '感谢您的关注';
                case 'unsubscribe':
                    return '取消关注事件';
            }
            return '收到事件消息';
            break;
        case 'text':
            include 'msg_text.php';
            // loginfo('1:' . json_encode($message));
            $txt = new WeixinText($app, $message);
            return $txt->dealMessage();
            break;
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
