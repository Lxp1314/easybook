<?php
if(empty($_REQUEST['action'])){
    die('action not found');
}
$action = $_REQUEST['action'];
if($action === 'wx_image_upload'){
    $media_id = $_REQUEST['media_id'];
    require __DIR__.'/../weixin/image_download.php';
    $url = ImageDownload::download($media_id);
    echo $url;
}