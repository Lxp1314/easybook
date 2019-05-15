<?php
/**
 * 访问config目录下的配置值，比如app.php下的debug：config('app.debug')
 * 只能读取到一级配置，耳机配置用config('app.debug')['xxx']的方式。
 */
function config($key, $default = null){
    global $_CONFIG;

    $index = strrpos($key, '.');
    if($index !== false){
        $key1 = substr($key, 0, $index);
        $key2 = substr($key, $index+1);
        if(isset($_CONFIG[$key1][$key2])){
            return $_CONFIG[$key1][$key2];
        }
        return $default;
    }else{
        if(isset($_CONFIG[$key])){
            return $_CONFIG[$key];
        }else{
            return $default;
        }
    }
}

include 'Log.php';
use framework\Log;

function loginfo($message){
    $log = new Log;
    $log->info($message);
}

function logdebug(){
    $log = new Log;
    $log->debug($message);
}

function logerror(){
    $log = new Log;
    $log->error($message);
}

/**
 * 检查是否是微信端
 */
function isWechat(){
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
        return true;
    }else{
        return false;
    }
}