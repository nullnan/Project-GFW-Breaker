<?php
//Site Settings
define("URL", "http://localhost");//网站地址
define("API", "http://locahost/API");//网站api地址
//DB Settings
define("DB_HOST", "localhost");//数据库主机
define("DB_NAME", "GFW-Breaker");//默认数据库名
define("DB_USERNAME", "Ender");//数据库用户名
define("DB_PASSWORD", "Feng,HK,4778!");//数据库密码
define("PREFIX", 'main_');
//Email Settings
define("SMTP_SERVER_ADDR", "smtp.sina.com");//邮件服务器地址
define("SMTP_SERVER_PORT", "25");//邮件服务器端口
define("SMTP_USER_EMAIL", "f1991455223@sina.com");//邮箱
define("SMTP_PASSWORD", "Feng,HK,4778!");//邮箱密码
define("SMTP_USERNAME", "f1991455223@sina.com");//邮箱用户名
//Security Settings
define('PASSWORD_SALT', '8f76ebaf6bf52191727147ebf46dbf3a');//密码的盐
define('MAX_SIGN_LIVE', 10);//签名生存时间,单位是秒
define('MAX_TOKEN_LIVE', 86400);//token生存时间,单位是秒
define('TOKEN_SALT', 'B9FA9854EC4D8D04E823217A2A4F8F52');//token的盐
define('ADMIN_SALT', 'IWANTTOMAKEBIGMONEY!!!');