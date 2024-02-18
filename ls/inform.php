<?php include './header.php'?>
    
    <!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <form method="post" action="#!" class="site-form">
                  <div class="form-group">
                    <label for="username">用户名</label>
                    <input type="text" class="form-control" disabled="disabled" value="<?php echo $username;?>"/>
                  </div>
                  <div class="form-group">
                    <label for="nickname">QQ</label>
                    <input type="text" class="form-control" disabled="disabled" value="<?php echo $qq;?>">
                  </div>
                  <div class="form-group">
                    <label for="nickname">注册时间</label>
                    <input type="text" class="form-control" disabled="disabled" value="<?php echo $time;?>">
                  </div>
                  <div class="form-group">
                    <label for="email">站点</label>
                    <input type="text" class="form-control" name="url" placeholder="请输入正确的网站地址" value="<?php echo $url;?>">
                    <small id="emailHelp" class="form-text text-muted">请保证您填写的网站地址是正确的。否则无法正确统计网站</small>
                  </div>
                  <button type="submit" class="btn btn-primary">没做好</button>
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
</body>
</html>