<?php 
include './header.php';

$id=$_GET['id'];
if(!empty($id)){
    $number_result =  Execute($conn,"SELECT * FROM statistics WHERE id='$id';");
}else{
    echo '<script>window.location.href="getlog.php?notifications=2&notifications_content=ID不能为空"</script>';
}
?>
    
    <!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header"><h4>详细信息</h4></div>
              <div class="card-body">
                <?php while ($page_row = mysqli_fetch_array($number_result)){  ?>
                  <div class="form-group">
                    <label for="example-nf-email">响应页面</label>
                    <input class="form-control" type="text" value="<?php echo $page_row['page']?>">
                    <br>
                    <a class="btn btn-primary" href="urltd.php?url=<?php echo $page_row['page']?>&id=<?php echo $id?>">查询该URL的本日流量</a>
                  </div>
                  <div class="form-group">
                    <label for="example-nf-password">反馈页面</label>
                    <input class="form-control" type="text" value="<?php echo $page_row['referer']?>">
                  </div>
                  <div class="form-group">
                    <label for="example-nf-password">响应IP</label>
                    <input class="form-control" type="text" value="<?php echo $page_row['ip']?>">
                  </div>
                  <div class="form-group">
                    <label for="example-nf-password">请求时间</label>
                    <input class="form-control" type="text" value="<?php echo $page_row['created_at']?>">
                  </div>
                  <?php } ?>
              </div>
            </div>
            <div class="card">
              <div class="card-header"><h4>操作</h4></div>
              <div class="card-body">
                  <div class="form-group">
                      <label class="btn-block" for="web_site_status">屏蔽此IP</label>
                      无权限
                  </div>
                  <a class="btn btn-primary" href="getlog.php">返回</a>
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

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="js/main.min.js"></script>
<?php require_once 'message.php';?>
</body>
</html>