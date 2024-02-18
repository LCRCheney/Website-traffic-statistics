<?php
include './public.php';
if($_POST['sata']=="web_config"){
    $_POST = str_replace(PHP_EOL, '', $_POST);
    $filename='../config/systemConfig.php';
    $str_file=file_get_contents($filename);
    
    $pattern="/'SYSTEM_TITTLE',.*?\)/";
    if (preg_match($pattern, $str_file)) {
        $_POST['tittle']=addslashes($_POST['tittle']);
        $str_file=preg_replace($pattern, "'SYSTEM_TITTLE','{$_POST['tittle']}')", $str_file);
    }
    
    $pattern="/'SYSTEM_OPEN',.*?\)/";
    if (preg_match($pattern, $str_file)) {
        if (isset($_POST['openweb'])) {
        // 复选框被选中
            $str_file=preg_replace($pattern, "'SYSTEM_OPEN','1')", $str_file);
        } else {
        // 复选框未被选中
            $str_file=preg_replace($pattern, "'SYSTEM_OPEN','0')", $str_file);
        }
    }
    
    
    
    if (!file_put_contents($filename, $str_file)) {
        echo '<script>window.location.href="web_config.php?notifications=3&notifications_content=修改失败，请检查权限！"</script>';
        exit;
    }
    echo '<script>window.location.href="web_config.php?notifications=1&notifications_content=修改成功"</script>';
    exit;
}else if($_POST['sata']=="safe_config"){
    $_POST = str_replace(PHP_EOL, '', $_POST);
    $filename='../config/systemConfig.php';
    $str_file=file_get_contents($filename);
    
    $pattern="/'SYSTEM_safe_ZD',.*?\)/";
    if (preg_match($pattern, $str_file)) {
        $_POST['safe_ZD']=addslashes($_POST['safe_ZD']);
        $str_file=preg_replace($pattern, "'SYSTEM_safe_ZD','{$_POST['safe_ZD']}')", $str_file);
    }
    
    $pattern="/'SYSTEM_safe_JG',.*?\)/";
    if (preg_match($pattern, $str_file)) {
        $_POST['safe_JG']=addslashes($_POST['safe_JG']);
        $str_file=preg_replace($pattern, "'SYSTEM_safe_JG','{$_POST['safe_JG']}')", $str_file);
    }
    
    $pattern="/'SYSTEM_GWIP',.*?\)/";
    if (preg_match($pattern, $str_file)) {
        if (isset($_POST['opengw'])) {
        // 复选框被选中
            $str_file=preg_replace($pattern, "'SYSTEM_GWIP','1')", $str_file);
        } else {
        // 复选框未被选中
            $str_file=preg_replace($pattern, "'SYSTEM_GWIP','0')", $str_file);
        }
    }
    
    
    
    if (!file_put_contents($filename, $str_file)) {
        echo '<script>window.location.href="safe_config.php?notifications=3&notifications_content=修改失败，请检查权限！"</script>';
        exit;
    }
    echo '<script>window.location.href="safe_config.php?notifications=1&notifications_content=修改成功"</script>';
    exit;
}
