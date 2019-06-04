<?php
require_once __DIR__ . '/framework/autoload.php';
require_once __DIR__ . '/weixin/oauth.php';

if(isWechat()){
    session_start();
    $user = Oauth::login('/index.php');
}else{
    // echo '非微信端';
    die('请在微信端打开页面');
}

$app = require __DIR__.'/weixin/app.php';
// $app->jssdk->buildConfig(array $APIs, $debug = false, $beta = false, $json = true);
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
        wx.config(<?php echo $app->jssdk->buildConfig(array('onMenuShareQQ', 'onMenuShareWeibo'), true) ?>);
    </script>
    <button>shangchuan</button>
</body>
</html>
