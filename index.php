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
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>测试页面</title>

    <link rel="stylesheet" href="./css/bulma.min.css">
    <link rel="stylesheet" href="./css/friend-circle.css">

    <script src="./js/plugin/vue/vue.js"></script>
    <script src="./js/plugin/jquery/jquery-3.3.1.min.js"></script>
    <script src="./js/plugin/layui/layer/layer.js"></script>
    <script src="./js/clipboard.min.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
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
        wx.config(<?php echo $app->js->config(array('chooseImage', 'onMenuShareQQ', 'onMenuShareWeibo'), true) ?>);
        wx.ready(function(){
            wx.updateAppMessageShareData({ 
                title: '测试分享', // 分享标题
                desc: '测试分享描述', // 分享描述
                link: 'http://weixin.windmax.cn/index.php', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                imgUrl: 'http://weixin.windmax.cn/resources/images/temp_img.jpg', // 分享图标
                success: function () {
                // 设置成功
                }
            })
        });
    </script>
    <button>shangchuan</button>
</body>
</html>
