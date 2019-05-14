<?php
use EasyWeChat\Foundation\Application;
// require_once '../QrCode/QrCode.php';
// use Endroid\QrCode\QrCode;
// use EasyWeChat\Message\Image;
class WeixinEvent{
    private $app;
    private $message;

    function __construct($app, $message){
        $this->app = $app;
        $this->message = $message;
    }

    public function dealEvent(){
        switch ($this->message->Event){
            case 'subscribe':
                //关注
                return $this->subscribe();
            case 'unsubscribe':
                //取关
                return $this->unsubscribe();
            case 'SCAN':
                //扫码
                return $this->scan();
            default:
                return '未知事件' . $this->message->Event;
        }
    }

    /**
     * 关注事件
     */
    private function subscribe(){
        $userService = $this->app->user;
        $this->app
            ->staff
            ->message(json_encode($this->message))
            ->by('wuyun@kefu2')
            ->to($this->message->FromUserName)->send();
        return '感谢您的关注';
    }

    /**
     * 取关事件
     */
    private function unsubscribe(){
        loginfo('取消关注：' . json_encode($this->message));
        return '取消关注事件';
    }

    /**
     * 扫码事件
     */
    private function scan(){
        return '扫码事件';
    }
}