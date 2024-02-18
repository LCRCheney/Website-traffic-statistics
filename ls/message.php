<script src="assets/message.min.js"></script>
<link rel="stylesheet" href="assets/message.min.css">
<script>
    function message_success(message) {Qmsg.config({timeout: 1500});Qmsg.success(message)}
    function message_error(message) {Qmsg.config({timeout: 3000});Qmsg.error(message)}
    function message_warning(message) {Qmsg.config({timeout: 1000});Qmsg.warning(message)}
</script>
<?php
/*
弹窗提示
$_GET['notifications'] 状态
参数1，2，3/success,warning,danger
$_GET['notifications_content'] 内容
*/
if ($_GET['notifications'] == "1" || $_GET['notifications'] == "2" || $_GET['notifications'] == "3") {
    if ($_GET['notifications'] == '1') {
        echo '<script>message_success("'.$_GET['notifications_content'].'")</script>';
    }
    if ($_GET['notifications'] == '2') {
        echo '<script>message_warning("'.$_GET['notifications_content'].'")</script>';
    }
    if ($_GET['notifications'] == '3') {
        echo '<script>message_error("'.$_GET['notifications_content'].'")</script>';
    }
}
?>