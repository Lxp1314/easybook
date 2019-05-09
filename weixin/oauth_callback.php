<?php
include __DIR__ . '/../framework/autoload.php';

use EasyWeChat\Foundation\Application;

$config = config('weixin');
$app = new Application($config);
$oauth = $app->oauth;

$user = $oauth->user();

session_start();
$_SESSION['wechat_user'] = $user->toArray();

$targetUrl = empty($_SESSION['target_url']) ? '/' : $_SESSION['target_url'];

header('location:'. $targetUrl); // 跳转到 user/profile