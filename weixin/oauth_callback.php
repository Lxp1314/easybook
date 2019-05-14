<?php
$app = require_once 'app.php';
$oauth = $app->oauth;
$user = $oauth->user();

session_start();
$_SESSION['wechat_user'] = $user->toArray();
$targetUrl = empty($_SESSION['target_url']) ? '/' : $_SESSION['target_url'];
header('location:'. $targetUrl);