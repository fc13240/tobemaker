<?php

define('HOSTNAME','localhost:8080');

define('DESIGNMG_VERSION','0.1');
define('ROOT_PATH',  dirname(__FILE__).'/');

define('BASE_URL', 'http://'.HOSTNAME.'/xampp/tobemaker/');

/*
 * MySQL
 * 
 */
//define('DATABASE_HOST', 'localhost');
define('DATABASE_HOST', '127.0.0.1');
define('DATABASE_NAME', 'idea');
define('DATABASE_USER', 'root');
define('DATABASE_PASSWORD', '');

// 七牛云存储配置
define('ACCESS_KEY','RTmVwPnuQZv2HKjM6_HUQYmS-nSEIHEtUn5U0a68');
define('SECRET_KEY','bm9caZ5h6cEC3ErGiwwvYRo4zsyKEVkLGlhDLM3-');
define('BUCKET', 'tobemaker-pub');
define('QINIU_UP','http://up.qiniu.com/');
define('QINIU_DOWN','http://'.BUCKET.'.qiniudn.com/');

//邮箱工具

define('MAIL_HOST','smtp.126.com');
define('MAIL_ADDRESS', 'tobemaker@126.com');
define('MAIL_PASS', 'tobemaker1');
define('MAIL_USER', 'tobemaker');

// 百度统计相关
define('BAIDUTJ_APPID', 'd2289fe0f6d090638e4fa53929e4b152');

// 检查当前访问域名与设置的BASE_URL是否一致，避免出现跨站ajax的错误
if ( $_SERVER['HTTP_HOST'] != HOSTNAME ){
    header('Location: '.BASE_URL);
}