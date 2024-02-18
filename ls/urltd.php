<?php include './header.php';?>
<?php
$urltd="无";
$cntip=0;
$urltd=$_GET['url'];
$backid=$_GET['id'];
if(!empty($_GET['url'])){
    $sqlcontzl="select * from statistics where page like '%".$urltd."%';";//总量
    $sqlcontjt="select * from statistics where to_days(created_at)=to_days(now()) AND page like '%".$urltd."%';";//今天
    $cntzltd=mysqli_num_rows(Execute($conn,$sqlcontzl));
    $cntjttd=mysqli_num_rows(Execute($conn,$sqlcontjt));
}


?>
    <!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-toolbar clearfix">
                  <?php if($power==1){?>
                <form class="pull-right search-bar" method="get" action="urltd.php" role="form">
                  <div class="input-group">
                    <div class="input-group-btn">
                      <button class="btn btn-default dropdown-toggle" id="search-btn" data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false">
                      URL
                      </button>
                    </div>
                    <input type="text" class="form-control" value="" name="url" placeholder="请输入URL">
                  </div>
                </form><?php }?>
                <div class="toolbar-btn-action">
                    <a class="btn btn-warning m-r-5" href="info.php?id=<?php echo $backid?>"><i class="mdi mdi-keyboard-backspace"></i> 返回</a>
                  <a class="btn btn-primary m-r-5" href="#"><i class="mdi mdi-reload"></i> 刷新</a>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
          <div class="col-sm-6 col-lg-3">
            <div class="card bg-success">
              <div class="card-body clearfix">
                <div class="pull-right">
                  <p class="h6 text-white m-t-0">请求总量</p>
                  <p class="h3 text-white m-b-0 fa-1-5x"><?php echo $cntzltd; ?> 条</p>
                </div>
                <div class="pull-left"> <span class="img-avatar img-avatar-48 bg-translucent"><i class="mdi mdi-arrow-down-bold fa-1-5x"></i></span> </div>
              </div>
            </div>
          </div>
          
          <div class="col-sm-6 col-lg-3">
            <div class="card bg-purple">
              <div class="card-body clearfix">
                <div class="pull-right">
                  <p class="h6 text-white m-t-0">本日新增流量</p>
                  <p class="h3 text-white m-b-0 fa-1-5x"><?php echo $cntjttd;?> 条</p>
                </div>
                <div class="pull-left"> <span class="img-avatar img-avatar-48 bg-translucent"><i class="mdi mdi-arrow-down-bold fa-1-5x"></i></span> </div>
              </div>
            </div>
          </div>
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
<script type="text/javascript">
$(function(){
    $('.search-bar .dropdown-menu a').click(function() {
        var field = $(this).data('field') || '';
        $('#search-field').val(field);
        $('#search-btn').html($(this).text() + ' <span class="caret"></span>');
    });
});
</script>
<?php require_once 'message.php';?>
</body>
</html>