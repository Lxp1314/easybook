<?php

class Oauth{
    /**
     * 返回微信授权用户信息
     */
    public static function login($call_back){
        // 未登录
        if (empty($_SESSION['wechat_user'])) {
            // 设置回调地址
            $_SESSION['target_url'] = $call_back;
            $app = require './app.php';
            $app->oauth->redirect()->send();
            die;
        }
        
        // 已经登录过
        $user = $_SESSION['wechat_user'];
        
        return $user;
    }
}