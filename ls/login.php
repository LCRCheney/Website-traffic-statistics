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
if (!empty($_SESSION['name'])) {
    //unset($_SESSION['name']);//测试
    echo '<script>window.location.href="index.php?notifications=1&notifications_content=您已登录"</script>';
    exit;
}

if ($_POST['state'] == 'login') {

    //极验二次验证
    require_once dirname(dirname(__FILE__)) . '/public/geetest/lib/class.geetestlib.php';
    require_once dirname(dirname(__FILE__)) . '/public/geetest/config/config.php';

    $GtSdk = new GeetestLib(CAPTCHA_ID, PRIVATE_KEY);
    if ($_SESSION['gtserver'] == 1) {   //服务器正常
        $result = $GtSdk->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode']);
        if ($result) {
        } else {
            echo '<script>window.location.href="login.php?notifications=2&notifications_content=人机验证失败，请重新验证！"</script>';
            exit;
        }
    } else {  //服务器宕机,走failback模式
        if ($GtSdk->fail_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'])) {
        } else {
            echo '<script>window.location.href="login.php?notifications=2&notifications_content=人机验证失败，请重新验证！"</script>';
            exit;
        }
    }


    if (empty($_POST['username'])) {
        echo '<script>window.location.href="login.php?notifications=2&notifications_content=请输入账号"</script>';
        exit;
    }
    if (empty($_POST['password'])) {
        echo '<script>window.location.href="login.php?notifications=2&notifications_content=请输入密码"</script>';
        exit;
    }

    $username = addslashes($_POST['username']);//获取登录表单信息
    $password = md5($_POST['password']);//获取登录表单信息
    $username = fliter_sql($username);
    $sql = Execute($conn, "select * from user where username = '{$username}' and password = '{$password}'");//查询数据库

    if (mysqli_num_rows($sql) !== 1) {
        echo '<script>window.location.href="login.php?notifications=2&notifications_content=账号或密码错误"</script>';
        exit;
    }

    $result = mysqli_fetch_array($sql);

    //登陆成功设置session name
    $_SESSION['username'] = $result['username'];
    $_SESSION['url'] = $result['url'];
    $_SESSION['uid'] = $result['uid'];
    $_SESSION['power'] = $result['power'];
    $_SESSION['qq'] = $result['qq'];
    $_SESSION['time'] = $result['time'];

    echo '<script>window.location.href="index.php?notifications=1&notifications_content=登陆成功"</script>';
    exit;
}
Close($conn); //关闭数据库连接
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>后台|登录</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="images/logo-ico.png">
    <!-- Base Styling  -->
    <link rel="stylesheet" href="css/login/fonts.css">
    <link rel="stylesheet" href="css/login/style.css">
</head>

<body>
    <div id="main-wrapper" class="show">

        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-7 p-0 b-center bg-size">
                    <!--<img class="img-fluid" src="assets/images/bg-register.png" alt="tabib app">-->
                </div>
                <div class="col-xl-5 p-0">
                    <div class="login-tabib">
                        <div>
                            <div class="text-center">
                                <a class="logo">
                                    <!--<img class="img-fluid" src="assets/images/logo.png" alt="loogin page">-->
                                </a>
                            </div>
                            <div class="login-main">
                                <form class="theme-form" method="post" action="login.php">
                                    <input name="state" style="display: none;" value="login" />
                                    <h4>登录 | 流量统计后台</h4>
                                    <p>输入你的用户名和密码来登录流量统计后台</p>
                                    <div class="form-group m-b-10">
                                        <label class="col-form-label">用户名</label>
                                        <input class="form-control" type="text" name="username" placeholder="在这里输入用户名">
                                    </div>
                                    <div class="form-group m-b-10">
                                        <label class="col-form-label">密码</label>
                                        <div class="form-input position-relative">
                                            <input class="form-control" type="password" name="password" placeholder="在这里输入密码">
                                            <div class="show-hide"><span class="show"></span></div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <div class="checkbox p-0">
                                            <input id="checkbox1" type="checkbox">
                                            <label class="text-muted" for="checkbox1">记住密码
                                    </label>
                                        </div>
                                        <a class="link text-primary" href="">忘记密码</a>
                                        <div  class="form-group mb-3"><br>
                                            <!-- 极验 -->
                                            <div id="embed-captcha"></div>
                                            <div id="notice" class="hide" role="alert">请先完成验证</div>
                                            <p id="wait" class="show">正在加载验证码......</p>
                                        </div>
                                        <div class="mt-3">
                                            <button href="" class="btn btn-primary w-100" type="submit">登录</button>
                                        </div>
                                    </div>
                                    <p class="mt-4 mb-0">没有账号?<a class="ms-2 text-primary text-center" onclick="zc()">注册</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- JQuery v3.5.1 -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>

    <!-- popper js -->
    <script src="assets/plugins/popper/popper.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Moment -->
    <script src="assets/plugins/moment/moment.min.js"></script>

    <!-- Date Range Picker -->
    <script src="assets/plugins/daterangepicker/daterangepicker.min.js"></script>

    <!-- Main Custom JQuery -->
    <script src="assets/js/toggleFullScreen.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        function zc(){
            message_error("请找陈晨(Cheney) QQ1969947820 进行注册并开启模板设置界面的统计开关");
        }
    </script>
    <?php require_once 'message.php';?>
</body>
<!-- 引入极验所需 -->
<?php require_once '../public/geetest/geetest.php';?>
</html>