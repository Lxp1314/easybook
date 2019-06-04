<?php
require_once __DIR__.'/../framework/autoload.php';

if(empty($_REQUEST['action'])){
    responseJson(400, 'action not found');
}
$action = $_REQUEST['action'];
if($action === 'wx_image_upload'){
    $media_id = $_REQUEST['media_id'];
    require __DIR__.'/../weixin/image_download.php';
    $url = ImageDownload::download($media_id);
    responseJson(200, 'ok', $url);
}