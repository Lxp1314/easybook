<?php

class ImageDownload{
    public static function download($media_id){
        $app = require './app.php';
        $content = $app->material_temporary->getStream($media_id);
        $path = '/storages/images/uploads/' . $media_id . '.jpg';
        file_put_contents('..' . $path, $contents);
        return 'http://weixin.windmax.cn' . $path;
    }
}