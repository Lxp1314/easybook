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
}elseif($action === 'base64_upload'){
    $media_id = $_REQUEST['media_id'];
    $image = $_POST['base64'];
    if (strstr($image,",")){
        // $image = explode(',',$base64);
        $image = explode(',',$image)[1];
    }
    $savePath = __DIR__."/../storages/images/uploads/".time().'.png';
    $r = file_put_contents($savePath, base64_decode($image));
    if(!$r){
        responseJson(400, 'error', '上传失败');
    }else{
        responseJson(200, 'ok', $savePath);
    }
}