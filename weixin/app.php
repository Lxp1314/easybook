<?php
require_once __DIR__ . '/../framework/autoload.php';

use EasyWeChat\Foundation\Application;

$config = config('weixin');
var_dump($config);die;
$app = new Application($config);
return $app;