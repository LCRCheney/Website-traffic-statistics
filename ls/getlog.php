<?php include './header.php';?>
    <!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
                <div class="card-toolbar clearfix">
                    <div class="toolbar-btn-action">
                        <a class="btn btn-primary m-r-5" href="getlog.php"><i class="mdi mdi-reload"></i> 刷新</a>
                    </div>
                </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>请求页面</th>
                        <th>IP</th>
                        <th>请求时间</th>
                        <th>操作</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($power==1){
                    $number_result =  Execute($conn,"SELECT * FROM statistics ORDER BY id DESC;");
                    }else if($power == 2){
                        $number_result =  Execute($conn,"SELECT * FROM statistics WHERE page LIKE '%".$url."%' ORDER BY id DESC;");
                    }
                    while ($page_row = mysqli_fetch_array($number_result)){  
                        echo "<tr>";
                        echo "<td>".$page_row['id']."</td>";
                        echo '<td><a target="_blank" href='.$page_row['page'].'>'.$page_row['page'].'</a></td>';
                        
                        if($page_row['ip']!="无数据"){
                        echo '<td><a target="_blank" href="https://www.ipshudi.com/'.$page_row['ip'].'.htm">'.$page_row['ip'].'</a></td>';
                        }else{
                            echo '<td>'.$page_row['ip'].'</td>';
                        }
                        echo "<td>".$page_row['created_at']."</td>";
                        if($power==1){
                            echo '<td>
                          <div class="btn-group">
                            <a class="btn btn-xs btn-default" href="#!" title="编辑" data-toggle="tooltip"><i class="mdi mdi-pencil"></i></a>
                            <a class="btn btn-xs btn-default" href="info.php?id='.$page_row['id'].'" title="查看" data-toggle="tooltip"><i class="mdi mdi-eye"></i></a>
                            <a class="btn btn-xs btn-default" href="#!" title="删除" data-toggle="tooltip"><i class="mdi mdi-window-close"></i></a>
                          </div>
                        </td>';
                        }else{
                            echo '<td>
                          <div class="btn-group">
                            <a class="btn btn-xs btn-default" href="info.php?id='.$page_row['id'].'" title="查看" data-toggle="tooltip"><i class="mdi mdi-eye"></i></a>
                          </div>
                        </td>';
                        }
                        
                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                  </table>
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