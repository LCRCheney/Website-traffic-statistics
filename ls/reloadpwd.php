<?php include './header.php';?>
<?php
if($_POST['sata']=="pwd"){
$pwd1=md5($_POST['oldpwd']);
$pwd2=md5($_POST['newpwd']);
$pwd3=md5($_POST['confirmpwd']);

if($pwd3!=$pwd2){
     echo '<script>window.location.href="reloadpwd.php?notifications=2&notifications_content=两次密码不一致"</script>';
     exit();
}else{
    $sql = Execute($conn, "select * from user where username = '{$username}' and password = '{$pwd1}'");//查询数据库

    if (mysqli_num_rows($sql) !== 1) {
        echo '<script>window.location.href="reloadpwd.php?notifications=3&notifications_content=原密码不正确"</script>';
        exit;
    }else{
        $sql1 = Execute($conn, "UPDATE user SET password = '$pwd2' WHERE uid='$uid'");//查询数据库

        if (mysqli_num_rows($sql1) == 1) {
            echo '<script>window.location.href="reloadpwd.php?notifications=3&notifications_content=未知错误"</script>';
            exit;
        }else{
            echo '<script>window.location.href="reloadpwd.php?notifications=1&notifications_content=修改成功"</script>';
        }
    }
}
}
?>
    <!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                
                <form method="post" action="reloadpwd.php" class="site-form">
                    <input name="sata" style="display: none;" value="pwd" />
                  <div class="form-group">
                    <label for="old-password">旧密码</label>
                    <input type="password" class="form-control" name="oldpwd" id="oldpwd" placeholder="输入账号的原密码">
                  </div>
                  <div class="form-group">
                    <label for="new-password">新密码</label>
                    <input type="password" class="form-control" name="newpwd" id="newpwd" placeholder="输入新的密码">
                  </div>
                  <div class="form-group">
                    <label for="confirm-password">确认新密码</label>
                    <input type="password" class="form-control" name="confirmpwd" id="confirmpwd" placeholder="再次输入新的密码">
                  </div>
                  <button type="submit" class="btn btn-primary">修改密码</button>
                </form>
       
              </div>
            </div>
          </div>
          
        </div>
        
      </div>
      
    </main>
    <!--End 页面主要内容-->
  </div>
</div>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="js/main.min.js"></script>
<?php require_once 'message.php';?>
</body>
</html>