<?php
require_once __DIR__ . '/framework/autoload.php';

if(isWechat()){
    session_start();
    // 未登录
    if (empty($_SESSION['wechat_user'])) {
    
        $_SESSION['target_url'] = '/userinfo.php';
      
        // return $oauth->redirect();
        // 这里不一定是return，如果你的框架action不是返回内容的话你就得使用
        $app = require_once './weixin/app.php';
        $oauth->redirect()->send();
    }
      
    // 已经登录过
    $user = $_SESSION['wechat_user'];
    
    var_dump($user);
}else{
    echo '非微信端';
}
