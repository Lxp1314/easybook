<?php

use EasyWeChat\Foundation\Application;

class WeixinText{

    private $app;
    private $message;

    function __construct($app, $message){
        $this->app = $app;
        $this->message = $message;
    }

    public function dealMessage(){
        switch($this->message->Content){
            case '照片书':
                /*-- 发送一条客服消息 --*/
                $this->app->staff->message('转发您的海报，邀请朋友扫码关注我们，当人数达到5人时可以免费在小凡家洗照片20张[嘿哈]
本活动限量1000份，领完即止')->by('tian_ci@kefu1')->to($this->message->FromUserName)->send();
                //需要获取二维码
                $wx_qrcode_content = $this->app->qrcode->temporary($this->message->FromUserName, 2592000);//生成一个30天后过期的二维码
                return "<img src='$wx_qrcode_content->url'/>";
                break;
            case '格式':
                return '老朋友，欢迎参加7月店庆
好礼/礼物/礼物免费赠活动
    万分感谢一直以来对我的支持
                礼物送上，数量有限尽快提交

            <a href="http://book.xiaofandiy.com/shop_celebrate.php">☞点我立即领"七月好礼"</a>';
            break;
            default:
                return "收到消息：" . $this->message->Content;
                break;
        }
    }

}