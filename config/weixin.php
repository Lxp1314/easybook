<?php
return [
    'debug'  => true,

    //测试号
    'app_id' => 'wxa88af71505f895da',
    'secret' => 'cf05973f5465279b2249ed983ffe19cc',
    'token'  => 'mytest',

    //易书在线
    // 'app_id' => 'wx7c58cc4ee296d6d7',
    // 'secret' => 'aa56d5f56c8cd378832cd5fbaec53b54',
    // 'token'  => 'wuyun',

    // 'aes_key' => null, // 可选

    'log' => [
        'level' => 'debug',
        'file'  => '/source/easybook/logs/easywechat.log', // XXX: 绝对路径！！！！
    ],

    /**
     * OAuth 配置
     *
     * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
     * callback：OAuth授权完成后的回调页地址
     */
    'oauth' => [
        'scopes'   => ['snsapi_userinfo'],
        'callback' => '/weixin/oauth_callback.php',
    ],

];