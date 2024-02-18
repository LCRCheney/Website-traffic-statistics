<?php include './header.php';?>
<?php

if($power==1){
    $sqlcontzl="select * from statistics";//总量
    $sqlcontqt="select * from statistics where to_days(now())-to_days(created_at) =2";//前天
    $sqlcontzt="select * from statistics where to_days(now())-to_days(created_at) =1;";//昨天
    $sqlcontjt="select * from statistics where to_days(created_at)=to_days(now());";//今天
}else{
    $sqlcontzl="select * from statistics where page like '%".$url."%';";//总量
    $sqlcontqt="select * from statistics where to_days(now())-to_days(created_at) =2 AND page like '%".$url."%';";//前天
    $sqlcontzt="select * from statistics where to_days(now())-to_days(created_at) =1 AND page like '%".$url."%';";//昨天
    $sqlcontjt="select * from statistics where to_days(created_at)=to_days(now()) AND page like '%".$url."%';";//今天
}

$cntzl=mysqli_num_rows(Execute($conn,$sqlcontzl));
$cntqt=mysqli_num_rows(Execute($conn,$sqlcontqt));
$cntzt=mysqli_num_rows(Execute($conn,$sqlcontzt));
$cntjt=mysqli_num_rows(Execute($conn,$sqlcontjt));

$sqlcontip='select * from banip';//banip
$cntip=mysqli_num_rows(Execute($conn,$sqlcontip));

?>
    <!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-sm-6 col-lg-3">
            <div class="card bg-danger">
              <div class="card-body clearfix">
                <div class="pull-right">
                  <p class="h6 text-white m-t-0">BanIP</p>
                  <p class="h3 text-white m-b-0 fa-1-5x"><?php echo $cntip;?>个</p>
                </div>
                <div class="pull-left"> <span class="img-avatar img-avatar-48 bg-translucent"><i class="mdi mdi-account fa-1-5x"></i></span> </div>
              </div>
            </div>
          </div>
          
          <div class="col-sm-6 col-lg-3">
            <div class="card bg-success">
              <div class="card-body clearfix">
                <div class="pull-right">
                  <p class="h6 text-white m-t-0">请求总量</p>
                  <p class="h3 text-white m-b-0 fa-1-5x"><?php echo $cntzl; ?> 条</p>
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
                  <p class="h3 text-white m-b-0 fa-1-5x"><?php echo $cntjt;?> 条</p>
                </div>
                <div class="pull-left"> <span class="img-avatar img-avatar-48 bg-translucent"><i class="mdi mdi-arrow-down-bold fa-1-5x"></i></span> </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="card bg-primary">
              <div class="card-body clearfix">
                <div class="pull-right">
                  <p class="h6 text-white m-t-0">站点URL</p>
                  <p class="h3 text-white m-b-0 fa-1-5x"><?php echo $url;?></p>
                </div>
                <div class="pull-left"> <span class="img-avatar img-avatar-48 bg-translucent"><i class="mdi mdi-cloud-download fa-1-5x"></i></span> </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          
          <div class="col-lg-6"> 
            <div class="card">
              <div class="card-header">
                <h4>请求流量(柱状图)</h4>
              </div>
              <div class="card-body">
                <canvas class="js-chartjs-bars"></canvas>
              </div>
            </div>
          </div>
          
          <div class="col-lg-6"> 
            <div class="card">
              <div class="card-header">
                <h4>请求流量(折线图)</h4>
              </div>
              <div class="card-body">
                <canvas class="js-chartjs-lines"></canvas>
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

<!--图表插件-->
<script type="text/javascript" src="js/Chart.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
    var $dashChartBarsCnt  = jQuery( '.js-chartjs-bars' )[0].getContext( '2d' ),
        $dashChartLinesCnt = jQuery( '.js-chartjs-lines' )[0].getContext( '2d' );
    
    var $dashChartBarsData = {
		labels: ['前天', '昨天', '今天'],
		datasets: [
			{
				label: '请求流量',
                borderWidth: 1,
                borderColor: 'rgba(0,0,0,0)',
				backgroundColor: 'rgba(51,202,185,0.5)',
                hoverBackgroundColor: "rgba(51,202,185,0.7)",
                hoverBorderColor: "rgba(0,0,0,0)",
				data: [<?php echo $cntqt;?>, <?php echo $cntzt;?>, <?php echo $cntjt;?>,0]
			}
		]
	};
    var $dashChartLinesData = {
		labels: ['前天', '昨天', '今天'],
		datasets: [
			{
				label: '请求流量',
				data: [<?php echo $cntqt;?>, <?php echo $cntzt;?>, <?php echo $cntjt;?>,0],
				borderColor: '#358ed7',
				backgroundColor: 'rgba(53, 142, 215, 0.175)',
                borderWidth: 1,
                fill: false,
                lineTension: 0.5
			}
		]
	};
    
    new Chart($dashChartBarsCnt, {
        type: 'bar',
        data: $dashChartBarsData
    });
    
    var myLineChart = new Chart($dashChartLinesCnt, {
        type: 'line',
        data: $dashChartLinesData,
    });
});
</script>
<?php require_once 'message.php';?>
</body>
</html>