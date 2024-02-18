# 网站流量统计后台
#### 通过其他网站js代码来实现多网站流量统计

>后台使用开源UI搭建，目前项目正在不定时更新
## 展示

![图片名称](/zs/1.png) 

## 使用
1. **上传源码到服务器**
2. **导入数据表到你的数据库**
3. **在config/sqlConfig.php中修改数据库配置**
4. **在ls/public/geetest/config/config.php中添加你自己的极验验证key和id(如果你不想使用该功能的话，请自行在login.php中删除验证部分)**
5. **使用http(s)://你的域名/ls 进入后台，登录管理员账号Admin(默认密码1969947820记得及时更改)**
6. **打开设置和安全设置，配置网站**
7. **确认无误后修改根目录下index.html的公告**
8. **在你想要统计流量的网站添加js代码**
   
```
<script>
        var page = window.location.href;
        var referer = document.referrer;
        var url = "http(s)://你的域名/mato.php" + "?referer=" + encodeURIComponent(referer) + "&page=" + encodeURIComponent(page);
        var xhr = new XMLHttpRequest();
        xhr.open("GET", url, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
            }
        };
        xhr.send();
</script>
``` 

## 不足
1. **目前没有添加用户功能，需要自行去数据库添加(密码是md5加密 power=1是超级管理员 power=2是普通用户) 功能后续更新会添加**
