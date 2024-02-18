<?php include './header.php';?>
    <?php 
if($power!=1){
    echo '<script>window.location.href="index.php?notifications=3&notifications_content=无权限"</script>';
}
?>
    <!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <ul class="nav nav-tabs page-tabs">
                <li class="active"> <a href="#!">基本</a> </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active">
                  
                  <form action="api.php" method="post" name="edit-form" class="edit-form">
                      <input name="sata" style="display: none;" value="web_config" />
                    <div class="form-group">
                      <label for="web_site_title">名字</label>
                      <input class="form-control" type="text" id="tittle" name="tittle" value="<?php echo stripslashes(SYSTEM_TITTLE);?>" placeholder="请输入名字" >
                    </div>
                    <div class="form-group">
                      <label class="btn-block" for="web_site_status">站点开关</label>
                      <label class="lyear-switch switch-solid switch-primary">
                          
                          <?php 
                          if(stripslashes(SYSTEM_OPEN)=="1"){
                            echo '<input name="openweb" type="checkbox" checked>';
                          }else {
                            echo '<input name="openweb" type="checkbox">';
                          }
                          ?>
                          
                        
                        <span></span>
                      </label>
                      <small class="help-block">站点关闭后将不能统计，后台可正常登录</small>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary m-r-5">确 定</button>
                    </div>
                  </form>
                  
                </div>
              </div>

            </div>
          </div>
          
        </div>
        
      </div>
      
    </main>
    <!--End 页面主要内容-->
  </div>
</div>
<?php require_once 'message.php';?>
<script type="text/javas<?php require_once 'message.php';?>cript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="js/main.min.js"></script>
</body>
</html>