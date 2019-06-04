<?php
/**
 * OAuth授权完成后的回调页地址，在/config/weixin.php中
 */
$app = require 'app.php';
$oauth = $app->oauth;
$user = $oauth->user();

// session_start();
$_SESSION['wechat_user'] = $user->toArray();
$targetUrl = empty($_SESSION['target_url']) ? '/' : $_SESSION['target_url'];
header('location:'. $targetUrl);