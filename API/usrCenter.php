<?php

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:POST');
header('Content-Type:application/json; charset=utf-8');
require 'config.php';
require 'Core/DB/MySQL/mysql_core.php';
require 'Core/Security/sign_core.php';
require 'Core/Data/return_core.php';
require 'Lib/LibSMTP.php';
require 'Core/custom_functions.php';
require 'Core/Security/token_core.php';
require 'Core/DB/Redis/redis_core.php';
session_start();
$sign = new sign_core();
$mysql = new mysql_core();
$return = new return_core();
$token = new token_core();
$redis = new redis_core();
if (isEmpty($_POST['type']))
    $return->retMsg('emptyParam');
switch ($_POST['type']) {
    case 'plan-all':
        $sql = 'SELECT name, lim_time, multi_device, flow, line, speed_rank, auto_renewal, charge FROM main_user_plan WHERE uid = ?';
        $params = array(1 => $token->getVal('uid'));
        $result = $mysql->bind_query($sql, $params);
        $result['row'] = count($result);
        $return->retMsg('success', $result);
        break;
    case 'billing-all':
        $sql = 'SELECT type, money, timestamp, id FROM main_user_billing WHERE uid = ?';
        $params = array(1 => $token->getVal('uid'));
        $result = $mysql->bind_query($sql, $params);
        $result['row'] = count($result);
        $return->retMsg('success', $result);
        break;
    case 'billing-top':
        $sql = 'SELECT money, money_in, money_out FROM main_users WHERE uid = ?';
        $params = array(1 => $token->getVal('uid'));
        $return->retMsg('success', $mysql->bind_query($sql, $params));
        break;
}