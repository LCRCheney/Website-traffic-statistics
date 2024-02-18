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
                <li class="active"> <a href="#!">安全</a> </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active">
                  
                  <form action="api.php" method="post" name="edit-form" class="edit-form">
                      <input name="sata" style="display: none;" value="safe_config" />
                    <div class="form-group">
                      <label for="web_site_title">风控阈值-(时间间隔)内最大访问次数</label>
                      <input class="form-control" type="text" id="safe_ZD" name="safe_ZD" value="<?php echo stripslashes(SYSTEM_safe_ZD);?>" placeholder="100" >
                    </div>
                    <div class="form-group">
                      <label for="web_site_title">风控阈值-刷新时间间隔</label>
                      <input class="form-control" type="text" id="safe_JG" name="safe_JG" value="<?php echo stripslashes(SYSTEM_safe_JG);?>" placeholder="60" >
                    </div>
                    <div class="form-group">
                      <label class="btn-block" for="web_site_status">屏蔽国外IP</label>
                      <label class="lyear-switch switch-solid switch-primary">
                          
                          <?php 
                          if(stripslashes(SYSTEM_GWIP)=="1"){
                            echo '<input name="opengw" type="checkbox" checked>';
                          }else {
                            echo '<input name="opengw" type="checkbox">';
                          }
                          ?>
                          
                        
                        <span></span>
                      </label>
                      <small class="help-block">开启后国外ip将不会记录</small>
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
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="js/main.min.js"></script>
</body>
</html>