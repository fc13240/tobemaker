<?php

define('HOSTNAME','http://tobemaker.zycc.net/');

define('DESIGNMG_VERSION','0.1');
define('ROOT_PATH',  dirname(__FILE__).'/');

define('BASE_URL', HOSTNAME.'');

/*
 * MySQL
 * 
 */
//define('DATABASE_HOST', 'localhost');
define('DATABASE_HOST', '127.0.0.1');
define('DATABASE_NAME', 'idea');
define('DATABASE_USER', 'root');
define('DATABASE_PASSWORD', 'qazwsxedc');

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