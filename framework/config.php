<?php
//加载配置文件
$_CONFIG = [];
$dir_config = __DIR__ . '/../config';
$tmp = scandir($dir_config);
foreach($tmp as $v){
    $path = $dir_config . '/' . $v;
    if(is_file($path)){
        $pathinfo = pathinfo($path);
        if($pathinfo['extension'] == 'php'){
            $_CONFIG[$pathinfo['filename']] = include($path);
        }
    }
}

unset($dir_config);
unset($tmp);
return $_CONFIG;