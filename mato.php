<?php
header("Access-Control-Allow-Origin: *");
include './config/sqlConfig.php';
include './config/systemConfig.php';
include './public/dbInc.php';

session_start();


$ZD = stripslashes(SYSTEM_safe_ZD); // 允许的最大访问次数
$JG = stripslashes(SYSTEM_safe_JG);; // 时间间隔（秒）

// 获取用户IP
$ip = $_SERVER['REMOTE_ADDR'];

// 设置日志文件路径
$logFile = 'log.txt';

// 获取当前时间戳
$currentTime = time();

// 读取日志文件内容
$logContent = file_get_contents($logFile);

// 将日志文件内容转换为数组
$logData = json_decode($logContent, true);

// 如果日志文件不存在或者内容为空，则初始化为空数组
if (!$logData) {
    $logData = [];
}

// 检查当前IP在日志中的记录
if (isset($logData[$ip])) {
    // 获取IP的访问记录
    $ipRecord = $logData[$ip];
    echo $logData[$ip]['count'];
    // 检查最后一次访问时间是否在60秒之内
    if ($currentTime - $ipRecord['lastAccess'] < $JG) {
        // 如果在60秒内访问超过3次，则返回404
        if ($ipRecord['count'] >= $ZD) {
            http_response_code(404);
            exit;
        } else {
            // 更新访问次数和时间
            $logData[$ip]['lastAccess'] = $currentTime;
            $logData[$ip]['count'] += 1;
        }
    } else {
        // 重置访问次数和时间
        $logData[$ip]['lastAccess'] = $currentTime;
        $logData[$ip]['count'] = 1;
    }
} else {
    // 如果IP没有记录，则新增记录
    $logData[$ip] = [
        'lastAccess' => $currentTime,
        'count' => 1
    ];
}

// 将更新后的日志数据写入日志文件
file_put_contents($logFile, json_encode($logData));


if(1!=1){
    
}else{
    //检查是否开启统计
    if(stripslashes(SYSTEM_OPEN)=="1"){
    // 获取 GET 请求参数
    $referer = $_GET['referer'] ?? '';
    $page = $_GET['page'] ?? '';
    $ip = $_SERVER['REMOTE_ADDR'];

    $conn = Connect();

    $ip_sql = "SELECT * FROM banip WHERE ip='$ip'";
    $ip_result = mysqli_query($conn, $ip_sql);

    if (mysqli_num_rows($ip_result) > 0) {
            http_response_code(404); // 返回状态码 404  echo "您已经进入黑名单！";
            exit;
        } else {
            
            if(stripslashes(SYSTEM_GWIP)=="1"){
                if(isForeignIP($ip)){
                    //echo '已屏蔽国外ip';
                    http_response_code(404);
                    exit;
                }else{
                    joinsql($referer,$page,$ip);
                }
            }else{
                joinsql($referer,$page,$ip);
            }
    }
}else {
    //echo "统计服务器暂时关闭，感谢您选择".stripslashes(SYSTEM_TITTLE)."模板";
    http_response_code(502);
    exit;
}

}


function isForeignIP($ip) {
    $url = 'http://ip-api.com/json/' . $ip;
    $response = file_get_contents($url);
    $data = json_decode($response);

    if ($data->country != 'China') {
        return true;
    } else {
        return false;
    }
}

function joinsql($referer,$page,$ip){
    $conn = Connect();
    // 插入数据到数据库
    $sql_insert_data = "INSERT INTO statistics (referer, page, ip) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql_insert_data);
    $stmt->bind_param("sss", $referer, $page, $ip);
    if ($stmt->execute()) {
        echo "用户改进计划数据提交成功，感谢您选择".stripslashes(SYSTEM_TITTLE)."模板";
        exit;
    } else {
        echo "用户改进计划数据提交失败: " . $conn->error;
        exit;
    }
    $stmt->close();
    $conn->close();
}

?>
