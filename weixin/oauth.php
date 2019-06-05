<?php

class Oauth{
    /**
     * 返回微信授权用户信息
     * $call_back 授权成功回调页面
     * $userinfo 是否显示授权，默认静默授权
     */
    public static function login($call_back, $userinfo = false){
        $session_id = 'wechat_user';
        $scope = $userinfo ? 'snsapi_userinfo' : 'snsapi_base';
        $newOauth = false;//重新发起授权
        if(empty($_SESSION['scope']) || $_SESSION['scope'] !== $scope){
            $_SESSION['scope'] = $scope;
            $newOauth = true;
        }
        // 未登录
        if ($newOauth || empty($_SESSION[$session_id])) {
            // 设置回调地址
            $_SESSION['target_url'] = $call_back;
            $app = require __DIR__.'/./app.php';
            if($userinfo){
                $app->oauth->scopes(['snsapi_userinfo']);
            }
            $app->oauth->redirect()->send();
            die;
        }
        
        // 已经登录过
        $user = $_SESSION[$session_id];
        
        return $user;
    }
}