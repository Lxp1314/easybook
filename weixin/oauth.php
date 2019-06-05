<?php

class Oauth{
    /**
     * 返回微信授权用户信息
     */
    public static function login($call_back, $base = false){
        $session_id = 'wechat_user';
        $scope = $base ? 'snsapi_base' : 'snsapi_userinfo';
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
            if($base){
                $app->oauth->scopes(['snsapi_base']);
            }
            $app->oauth->redirect()->send();
            die;
        }
        
        // 已经登录过
        $user = $_SESSION[$session_id];
        
        return $user;
    }
}