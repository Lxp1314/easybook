<?php

$app = include 'app.php';
$server = $app->server;
$server->setMessageHandler(function ($message) {
    global $app;
    $staffService = $app->staff;//客服消息服务
    $openId = $message->FromUserName;
    $staffService->message(json_encode($message))
        // ->by('wuyun@test')
        ->to($openId)
        ->send();

        // 用户信息 $app->user->get($message->FromUserName);
        // {
        //     "subscribe": 1,
        //     "openid": "oXfiP5lm2s4SXbtDDalXqebjM6iM",
        //     "nickname": "刘海云",
        //     "sex": 1,
        //     "language": "zh_CN",
        //     "city": "昌平",
        //     "province": "北京",
        //     "country": "中国",
        //     "headimgurl": "http:\/\/thirdwx.qlogo.cn\/mmopen\/RiceC3to0Ane1BPZcsjnNDGLiaeR9QPoSDkouB6ckqN0wSd7iaMQ92kzibsV63Z769GmTiaFVnBUKaaTFI3BOPJaYZIK7DA6N2Bich\/132",
        //     "subscribe_time": 1557799175,
        //     "remark": "",
        //     "groupid": 0,
        //     "tagid_list": [],
        //     "subscribe_scene": "ADD_SCENE_QR_CODE",
        //     "qr_scene": 0,
        //     "qr_scene_str": ""
        // }
    
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
            // {
            //     "ToUserName": "gh_712b3ff655bb",
            //     "FromUserName": "oXfiP5lm2s4SXbtDDalXqebjM6iM",
            //     "CreateTime": "1557802213",
            //     "MsgType": "text",
            //     "Content": "你好",
            //     "MsgId": "22302368909933924"
            // }
            require_once 'msg_text.php';
            $txt = new WeixinText($app, $message);
            return $txt->dealContent();
        case 'image':
            // $message的内容
            // {
            //     "ToUserName": "gh_712b3ff655bb",
            //     "FromUserName": "oXfiP5lm2s4SXbtDDalXqebjM6iM",
            //     "CreateTime": "1557802574",
            //     "MsgType": "image",
            //     "PicUrl": "http:\/\/mmbiz.qpic.cn\/mmbiz_jpg\/wvUs691qMSSCyuIiam9n97ibnkL29m9gsnQqiaia9hjfLAPsI4HpibrnicmjYzkV3THw5icLTcrgfWgRqf9pqibibM6GVQw\/0",
            //     "MsgId": "22302370543420374",
            //     "MediaId": "PsX6qshm2IQA7nRm0dFtTnyzBYMu2zOVsvR6fgICx7xmKdR6EK5rkndwtlTwaMu2"
            // }
            return '收到图片消息：' . $message->PicUrl;
            break;
        case 'voice':
            // $message的内容
            // {
            //     "ToUserName": "gh_712b3ff655bb",
            //     "FromUserName": "oXfiP5lm2s4SXbtDDalXqebjM6iM",
            //     "CreateTime": "1557802766",
            //     "MsgType": "voice",
            //     "MediaId": "syJg-5heOVlzLcyJ6boDqKsDySBz9WPwTk4xtzNlGYbFoY-Hr43_Tq193eIsG-Vd",
            //     "Format": "amr",
            //     "MsgId": "22302371864173547",
            //     "Recognition": null
            // }
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
