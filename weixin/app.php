<?php
require_once __DIR__ . '/../framework/autoload.php';

use EasyWeChat\Foundation\Application;

$config = config('weixin');
$app = new Application($config);
return $app;