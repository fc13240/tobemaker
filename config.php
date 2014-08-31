<?php

define('HOSTNAME','http://localhost');

define('DESIGNMG_VERSION','0.1');
define('ROOT_PATH',  dirname(__FILE__).'/');

define('BASE_URL', 'http://www.cc.com/');

/*
 * MySQL
 * 
 */
//define('DATABASE_HOST', 'localhost');
define('DATABASE_HOST', '127.0.0.1');
define('DATABASE_NAME', 'idea');
define('DATABASE_USER', 'root');
define('DATABASE_PASSWORD', '');

/*
 * Database Tables
 */
define('TABLENAME_AD', 'ad_img');
define('TABLENAME_USER', 'user');

define('ACCESS_KEY','-KZQqWyVFjjfoQDpkVb_Z1q-T7BrBKTJZfhEQ3XW');
define('SECRET_KEY','_L0dnTqGE8PhJ1zNB3c97oX7pPge9TDzkKALu9gW');
define('BUCKET', 'yzzwordpress');
define('QINIU_UP','http://up.qiniu.com/');
define('QINIU_DOWN','http://'.BUCKET.'.qiniudn.com/');

//邮箱工具

define('MAIL_HOST','smtp.126.com');
define('MAIL_ADDRESS', 'tobemaker@126.com');
define('MAIL_PASS', 'tobemaker1');
define('MAIL_USER', 'tobemaker');
