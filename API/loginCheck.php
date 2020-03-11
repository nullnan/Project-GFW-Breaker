<?php
header('Access-Control-Allow-Origin:http://localhost');
header('Access-Control-Allow-Methods:POST');
header(('Access-Control-Allow-Credentials:true'));
header('Content-Type:application/json; charset=utf-8');
require 'config.php';
require 'Core/DB/MySQL/mysql_core.php';
require 'Core/Security/sign_core.php';
require 'Core/Data/return_core.php';
require 'Lib/LibSMTP.php';
require 'Core/custom_functions.php';
require 'Core/Security/token_core.php';
session_start();
$token = new token_core();
$return = new return_core();
//$token->setToken(5, 'EnderTheCoder');
if ($token->judgeToken()) $token->updateToken();
$return->setType('success');
$return->setVal('is_login', $token->judgeToken());
$return->run();