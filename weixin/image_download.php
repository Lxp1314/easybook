<?php

class ImageDownload{
    public static function download($media_id){
        $app = require __DIR__.'/./app.php';
        $temporary = $app->material_temporary;
        $temporary->download($media_id, "../storages/images/uploads/", $media_id.".jpg");
        // $content = $temporary->getStream($media_id);
        // $path = '/storages/images/uploads/' . $media_id . '.jpg';
        // file_put_contents('..' . $path, $contents);
        return 'http://weixin.windmax.cn/storages/images/uploads/' . $media_id . ".jpg";
    }
}