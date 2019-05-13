<?php

use EasyWeChat\Foundation\Application;
require_once '../QrCode/QrCode.php';
use Endroid\QrCode\QrCode;

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
                return $this->msg1();
            case '格式':
                return $this->msg2();
            case '二维码':
                return $this->msg3();
            default:
                return "收到消息：" . $this->message->Content;
        }
    }

    /**
     * 照片书
     */
    private function msg1(){
        /*-- 发送一条客服消息 --*/
        $this->app->staff->message( <<<EOF
转发您的海报，邀请朋友扫码关注我们，当人数达到5人时可以免费在小凡家洗照片20张[嘿哈]
本活动限量1000份，领完即止
EOF
        )->by('tian_ci@kefu1')->to($this->message->FromUserName)->send();
                        
        //生成一个30天后过期的二维码
        $wx_qrcode_content = $this->app->qrcode->temporary($this->message->FromUserName, 2592000);
        $qrcode_url = $wx_qrcode_content->url;
        /*-- 根据链接，生成一个二维码 --*/
        $qrCode = new QrCode();
        $qrCode->setText($qrcode_url)
            ->setSize(220)
            ->setPadding(0)
            ->setErrorCorrection(QrCode::LEVEL_MEDIUM)
            ->setForegroundColor(array('r' => 0x00, 'g' => 0x00, 'b' => 0x00, 'a' => 0))
            ->setBackgroundColor(array('r' => 0xff, 'g' => 0xff, 'b' => 0xff, 'a' => 1))
        ;

        $qCodePath = '../images/promote_qrcode/' . md5($this->message->FromUserName) . '.jpg';
        $im = imagecreatetruecolor(240,  240);
        imageFill($im, 0, 0, imageColorAllocate($im, 0xff, 0xff ,0xff));
        imagecopy($im, $qrCode->getImage(), 10, 10, 0, 0, 220, 220);
        imagejpeg($im,$qCodePath);

        /*-- 将二维码贴到海报图上 --*/
        $bigImgPath = "../images/promote_qrcode/temp_img.jpg";//背景图片路径
        $bigImg = imagecreatefromstring(file_get_contents($bigImgPath));
        $qCodeImg = imagecreatefromstring(file_get_contents($qCodePath));
        imagecopymerge($bigImg, $qCodeImg, 760, 1026, 0, 0, 240, 240, 100);
        imagejpeg($bigImg, $qCodePath);

        /*-- 上传到素材 --*/
        $res_media = $app->material_temporary->uploadImage($qCodePath);
        $res_media = json_decode($res_media, true);
        $media_id = $res_media['media_id'];

        return new Image(['media_id' => $media_id]);
    }

    /**
     * 格式
     */
    private function msg2(){
        return <<<EOF
老朋友，欢迎参加7月店庆
好礼/礼物/礼物免费赠活动
万分感谢一直以来对我的支持
礼物送上，数量有限尽快提交

<a href="http://book.xiaofandiy.com/shop_celebrate.php">☞点我立即领"七月好礼"</a>
EOF;
    }

    /**
     * 二维码
     */
    private function msg3(){

    }
}