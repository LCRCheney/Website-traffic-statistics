<?php
@header("Content-type: text/html; charset=utf-8");
//引入数据库配置
require_once "../config/sqlConfig.php";
//引入数据库操作函数库
require_once "../public/dbInc.php";

//启动session
@session_start();

//数据库连接检测
$conn = Connect();

// 报告 E_NOTICE 之外的所有错误
error_reporting(E_ALL & ~E_NOTICE);
//引入基本配置
require_once "../config/systemConfig.php";
