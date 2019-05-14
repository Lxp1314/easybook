<?php
//启动时间
define('APP_START', microtime(true));
//composer自动加载
require __DIR__ . '/../vendor/autoload.php';
//加载配置
$_CONFIG = require_once __DIR__ . '/config.php';
//加载帮助方法
require_once __DIR__ . '/helpers.php';