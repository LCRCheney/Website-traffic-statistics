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
    //判断是否登入
    if (empty($_SESSION['username'])&&empty($_SESSION['uid'])&&empty($_SESSION['power'])&&empty($_SESSION['url'])) {
        echo '<script>window.location.href="login.php?notifications=3&notifications_content=您未登录"</script>';
        exit;
    }
    
    $power=$_SESSION['power'];
    $url=$_SESSION['url'];
    $username=$_SESSION['username'];
    $uid=$_SESSION['uid'];
    $qq=$_SESSION['qq'];
    $time=$_SESSION['time'];
    
if ($_POST['state'] == 'out') {
    unset($_SESSION['name']);
    unset($_SESSION['qq']);
    unset($_SESSION['username']);
    unset($_SESSION['uid']);
    unset($_SESSION['power']);
    unset($_SESSION['url']);
    unset($_SESSION['time']);
    
    
    echo '<script>window.location.href="login.php?notifications=1&notifications_content=退出成功"</script>';
}

?>
<?php include './public.php';?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>管理后台|首页</title>
    <link rel="icon" href="favicon.ico" type="image/ico">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/materialdesignicons.min.css" rel="stylesheet">
    <link href="css/style.min.css" rel="stylesheet">
</head>

<body>
<div class="lyear-layout-web">
    <div class="lyear-layout-container">
        <!--左侧导航-->
        <aside class="lyear-layout-sidebar">

            <!-- logo -->
            <div id="logo" class="sidebar-header">
                <a style="height: 66px;"><?php echo stripslashes(SYSTEM_TITTLE);?>流量统计后台</a>
            </div>
            <div class="lyear-layout-sidebar-scroll">

                <nav class="sidebar-main">
                    <ul class="nav nav-drawer">
                        <li class="nav-item active"> <a href="index.php"><i class="mdi mdi-home"></i> 后台首页</a> </li>
                        <li class="nav-item nav-item-has-subnav">
                            <a href="javascript:void(0)"><i class="mdi mdi-database"></i> 数据</a>
                            <ul class="nav nav-subnav">
                                <?php if($power==1){?>
                                <li><a href="urltd.php"><i class="mdi mdi-file-document">url统计</i></a></li>
                                <?php }?>
                                <li> <a href="search.php"><i class="mdi mdi-magnify">精确查询</i></a> </li>
                                <li> <a href="getlog.php"><i class="mdi mdi-file-document">请求日志</i></a> </li>
                            </ul>
                        </li>
                        <li class="nav-item nav-item-has-subnav">
                            <a href="javascript:void(0)"><i class="mdi mdi-settings"></i> 设置</a>
                            <ul class="nav nav-subnav">
                            <?php if($power==1){?>
                            
                                <li><a href="safe_config.php"><i class="mdi mdi-shield-half-full">安全设置</i></a></li>
                                <li><a href="web_config.php"><i class="mdi mdi-settings">网站设置</i></a></li>
                            <?php }?>
                            <li><a href="reloadpwd.php"><i class="mdi mdi-lock-outline">修改密码</i></a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>

                <div class="sidebar-footer">
                    <p class="copyright">Copyright &copy; 2024. <a target="_blank" href="">陈晨</a> All rights reserved.</p>
                </div>
            </div>

        </aside>
        <!--End 左侧导航-->

        <!--头部信息-->
        <header class="lyear-layout-header">

            <nav class="navbar navbar-default">
                <div class="topbar">

                    <div class="topbar-left">
                        <div class="lyear-aside-toggler">
                            <span class="lyear-toggler-bar"></span>
                            <span class="lyear-toggler-bar"></span>
                            <span class="lyear-toggler-bar"></span>
                        </div>
                        <span class="navbar-page-title"> 后台首页 </span>
                    </div>

                    <ul class="topbar-right">
                        <li class="dropdown dropdown-profile">
                            <a href="javascript:void(0)" data-toggle="dropdown">
                                <span><?php echo $_SESSION['username'];?><span class="caret"></span></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li> <a href="inform.php"><i class="mdi mdi-account"></i> 个人信息</a> </li>
                                <li> <a href="reloadpwd.php"><i class="mdi mdi-lock-outline"></i> 修改密码</a> </li>
                                <li> <a href="javascript:void(0)"><i class="mdi mdi-delete"></i> 清空缓存</a></li>
                                <li class="divider"></li>
                                <li><form method="post" action="index.php"><button class="btn btn-primary"><i class="mdi mdi-logout-variant"></i> 退出登录</button><input name="state" style="display: none;" value="out" /></form></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!--End 头部信息-->