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
    'closeWindow',
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
            background-color: white;
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
                    alert('分型成功updateTimelineShareData');
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
                    alert('分享成功updateAppMessageShareData');
                }
            });
        });
        
        function chooseImage(){
            wx.chooseImage({
                count: 1, // 默认9
                sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
                sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
                success: function (res) {
                    var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                }
            });
        }
    </script>
    <img id="img1" />
    <button onclick="chooseImage()">shangchuan</button>
</body>
</html>
