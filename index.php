<?php
require_once __DIR__ . '/framework/autoload.php';
require_once __DIR__ . '/weixin/oauth.php';

if(isWechat()){
    $user = Oauth::login('/index.php');
}else{
    // echo '非微信端';
    die('请在微信端打开页面');
}

$app = require __DIR__.'/weixin/app.php';
$jsApis = [
    'updateAppMessageShareData', 
    'updateTimelineShareData', 
    'onMenuShareWeibo', 
    'onMenuShareQZone',
    'startRecord',
    'stopRecord',
    'onVoiceRecordEnd',
    'playVoice',
    'pauseVoice',
    'stopVoice',
    'onVoicePlayEnd',
    'uploadVoice',
    'downloadVoice',
    'chooseImage',
    'previewImage',
    'uploadImage',
    'getLocalImgData',
    'downloadImage',
    'translateVoice',
    'getNetworkType',
    'openLocation',
    'getLocation',
    'hideOptionMenu',
    'showOptionMenu',
    'hideMenuItems',
    'showMenuItems',
    'hideAllNonBaseMenuItem',
    'showAllNonBaseMenuItem',
    // 'closeWindow',
    'scanQRCode',
    'chooseWXPay',
    'openProductSpecificView',
    'addCard',
    'chooseCard',
    'openCard',
];
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <title>测试页面</title>

    <link rel="stylesheet" href="./css/bulma.min.css">
    <link rel="stylesheet" href="./css/friend-circle.css">

    <script src="./js/plugin/vue/vue.js"></script>
    <script src="./js/plugin/jquery/jquery-3.3.1.min.js"></script>
    <script src="./js/plugin/layui/layer/layer.js"></script>
    <script src="./js/clipboard.min.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>

    <style type="text/css">
        body{
            background-color: black;
        }
        img{
            width:32%;
        }
    </style>
</head>
<body>
    <script>
        // wx.config({
        //     debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        //     appId: '', // 必填，公众号的唯一标识
        //     timestamp: , // 必填，生成签名的时间戳
        //     nonceStr: '', // 必填，生成签名的随机串
        //     signature: '',// 必填，签名
        //     jsApiList: [] // 必填，需要使用的JS接口列表
        // });
        wx.config(<?php echo $app->js->config($jsApis, true) ?>);
        wx.ready(function(){
            // 自定义“分享到朋友圈”及“分享到QQ空间”按钮的分享内容（1.4.0）
            wx.updateTimelineShareData({ 
                title: '测试分享到朋友圈、分享到QQ空间', // 分享标题
                desc: '测试分享描述', // 分享描述
                link: 'http://weixin.windmax.cn/index.php', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                imgUrl: 'http://weixin.windmax.cn/resources/images/temp_img.jpg', // 分享图标
                success: function () {
                // 页面进入时的设置成功，而非分享成功后的回调
                    console.log('分享成功updateTimelineShareData');
                }
            });
            // 自定义“分享给朋友”及“分享到QQ”按钮的分享内容（1.4.0）
            wx.updateAppMessageShareData({ 
                title: '测试分享给朋友、分享到QQ', // 分享标题
                desc: '测试分享描述', // 分享描述
                link: 'http://weixin.windmax.cn/index.php', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                imgUrl: 'http://weixin.windmax.cn/resources/images/temp_img.jpg', // 分享图标
                success: function () {
                    // 页面进入时的设置成功，而非分享成功后的回调
                    console.log('分享成功updateAppMessageShareData');
                }
            });
            //判断是否是wkwebview
            if(window.wxjs_is_wkwebview){
                document.getElementById("input1").value = 'true';
            }else{
                document.getElementById("input1").value = 'false';
            }
        });
        
        function chooseImage(){
            wx.chooseImage({
                count: 9, // 默认9，一次可选择几张照片
                sizeType: ['original'], // 可以指定是原图original还是压缩图compressed，默认二者都有
                sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
                success: function (res) {
                    var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                    for(var i=0; i<localIds.length; i++){
                        document.getElementById("img"+i).src = localIds[i];
                    }
                }
            });
        }

        function chooseBase64Image(){
            wx.chooseImage({
                count: 9, // 默认9，一次可选择几张照片
                sizeType: ['original'], // 可以指定是原图original还是压缩图compressed，默认二者都有
                sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
                success: function (res) {
                    var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                    for(var i=0; i<localIds.length; i++){
                        wx.getLocalImgData({
                            localId: localIds[i],
                            success: function(res) {
                                var localData = res.localData; // localData是图片的base64数据，可以用img标签显示
                                document.getElementById("img"+i).src = localData;
                            }
                        });
                    }
                }
            });
        }

        function previewImage(){
            // 预览图片接口
            wx.previewImage({
                current: 'http://weixin.windmax.cn/resources/images/renwu1.jpg', // 当前显示图片的http链接
                urls: ['http://weixin.windmax.cn/resources/images/renwu1.jpg', 'http://weixin.windmax.cn/resources/images/renwu2.jpg','http://weixin.windmax.cn/resources/images/renwu3.jpg'] // 需要预览的图片http链接列表
            });
        }

        function uploadImage(index){
            if(index>8 || index<0){
                alert('超出范围'+index);
            }

            var localId = document.getElementById("img"+index).src;
            if(localId.length>0){
                wx.uploadImage({
                    localId: localId, // 需要上传的图片的本地ID，由chooseImage接口获得
                    isShowProgressTips: 1, // 默认为1，显示进度提示
                    success: function (res) {
                        var serverId = res.serverId; // 返回图片的服务器端ID
                        
                        $.ajax({
                            type: "get",
                            url: "http://weixin.windmax.cn/api/index.php?action=wx_image_upload&media_id="+serverId,
                            // dataType: "json",
                            // async: true,
                            // data: {
                            //     action: 'wx_image_upload',
                            //     media_id: serverId
                            // },
                            beforeSend: function () {
                            },
                            success: function (json) {
                                alert(json.data);
                            },
                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                                console.log("请求数据异常：" + errorThrown);
                            }
                        });

                        document.getElementById("info").innerText = serverId;
                        if(index<8){
                            index++;
                            uploadImage(index);
                        }
                    }
                });
            }else{
                // alert('图片src不存在：' + index);
            }
        }
        function uploadBase64Image(){

        }
        function getImg1Src(){
            alert(document.getElementById("img0").src);
        }

        function chooseOne(){
            wx.chooseImage({
                count: 1, // 默认9，一次可选择几张照片
                sizeType: ['original'], // 可以指定是原图original还是压缩图compressed，默认二者都有
                sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
                success: function (res) {
                    var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                    document.getElementById("inputOne").value = localIds[0];
                }
            });
        }
        function showOneId(){
            document.getElementById('imgOne').src = document.getElementById('inputOne').value;
            document.getElementById("info").innerText = document.getElementById('inputOne').value;
        }
        function showOneBase64(){
            wx.getLocalImgData({
                localId: document.getElementById('inputOne').value,
                success: function(res) {
                    var localData = res.localData; // localData是图片的base64数据，可以用img标签显示
                    document.getElementById("imgOne").src = localData;
                    document.getElementById("info").innerText = localData;
                }
            });
        }
    </script>
    <img style="width:21px; height:21px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABUAAAAVCAYAAACpF6WWAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAAZdEVYdFNvZnR3YXJlAEFkb2JlIEltYWdlUmVhZHlxyWU8AAADJmlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS42LWMxMzggNzkuMTU5ODI0LCAyMDE2LzA5LzE0LTAxOjA5OjAxICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIiB4bWxuczpzdFJlZj0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlUmVmIyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ0MgMjAxNyAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6NjhFRDJCOTdCMjQ4MTFFN0FGOEJENDVENTkwOUNEODUiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6NjhFRDJCOThCMjQ4MTFFN0FGOEJENDVENTkwOUNEODUiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo2OEVEMkI5NUIyNDgxMUU3QUY4QkQ0NUQ1OTA5Q0Q4NSIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo2OEVEMkI5NkIyNDgxMUU3QUY4QkQ0NUQ1OTA5Q0Q4NSIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PhgYypYAAAJWSURBVDhPtVNNaxNRFD1vkklSktiFkSotUlBwJ4IrRVx04cqlG/+DC/f6g6TtTgpdtLhyIyqKCF1EcGG7qDE2mU4ymZnM89z33jQZMalCPHB5H3Pveed+jNIEFgzPrX+PwUcgPnSHP+PfSaP2uaTz0w+oyq8DtevugshSSim7g0PyASit8b5ljvNJxxGw9xB4sMvAL0D4lqQBP5T42CrQ2AB0HzjdBJaf2Bji3EZ1E/JFGio9Rg1dNOPXDOJjQpyFwMXHQJUPTGEmaTIGDjoUxKqLlWgeTdFWgm1U0q88+EBKpevPuVcuck6j3hyxH5m1iA+MaDHLmVL5YeMRL6h28JOX/PDjlYuyKCjthBo9+orfkAQxv2itUHEqfYrJFV9QAVrBLvzOPtC6y+hLQPsFcPvZhPT9kUaSaXhMQxJRinuuUaZ4r85KUBZiWpWZ1zkYfv8bLne3gBtPgR7HbfmaJX1HwiC2zgXwLFejsd2Uc1KuVfapJiXl91ZV40pDPC3UKNV6p62xxNGTa5EtWrXZWbD3GPNoSEUxHYVUyMVL6n6fY5rD+z6wTZAahrTB2arMXtZhqk2zIp7FT1bx6Y9ozFD6cMo1B99iYGIJhoZAzAZP9so8LGaIuQpZn5MgZeuRfGqi4K02eckPEesmAUaRC87PQpYyxTwjURU6k70IqrO+OYzSm5yGE74mtZFAGal8RgsKp8xmBhyzfPeKP9RkpF5yGj7xD1piA6ZTmQVOnyHduArcmUUqOGHBP5NYnOcRS0SzAtxasVPwOwqki4Kp6aLxH0iBXzuaSW03c1cYAAAAAElFTkSuQmCC" />
    <input type="text" id="input1" value="123" />

    <img id="img0" />
    <img id="img1" />
    <img id="img2" />
    <img id="img3" />
    <img id="img4" />
    <img id="img5" />
    <img id="img6" />
    <img id="img7" />
    <img id="img8" />
    
    <button onclick="chooseImage()">选择</button>
    <button onclick="chooseBase64Image()">选择Base64</button>
    <button onclick="previewImage()">预览</button>
    <button onclick="uploadImage(0)">上传</button>
    <button onclick="uploadBase64Image()">上传Base64</button>
    <button onclick="getImg1Src()">获取img0的src</button>
    <img id="imgOne" />
    <input type="text" id="inputOne" value="" />
    <button onclick="chooseOne()">选择一张</button>
    <button onclick="showOneId()">显示localId</button>
    <button onclick="showOneBase64()">显示base64</button>
    <div id="info" style="color:white;width:100%;word-break:break-all;word-wrap:break-word;"></div>
</body>
</html>
