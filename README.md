
## 简介

用于manyuser的商业前端模板。  
自造轮子。感谢[Zero Clover](mailto:hmsxcxy@vip.qq.com)的交流支持。

## 更新

1.考虑到用户与开通套餐多对多的关系，简化原先user表。并重新设计，实现用户注册但不及时开通端口，订购后才为其开通。

## 优点

* 更多可配置项放入数据库中，后台管理方便随时更改
* 更像一个交易平台

## 吐槽

ss-panel不是说不好，满足不了我想要的。  
另，不会改slim框架的东西。好吧其实我没玩过slim。（掩面逃  
特别想改了user表的表名，现在意思对不上我的设想，但是怕在manyuser里一起改了，大家的兼容性不好。  
委屈了我的强迫症 + 代码洁癖。

## 依赖

* PHP >= 5.4
* MYSQL（避免一张表两个时间戳无法创建表问题）
* Apache/Nginx

## 框架

* ThinkPHP 3.2

## 类库
* Bootstrap 3.3.5
* Jquery

## 安装

1. 在Application/Common/config.php里修改数据库相关配置
2. 把源码放入网站根目录（请保证/Application/Runtime有足够的读写权限）
3. Apache开启rewrite模块/Nginx在配置文件中url重写并重启服务

      ```
            location / {
            root /var/www;
            index index.html index.htm index.php;
            if (!-d $request_filename) {
                rewrite ^/(.*)/(.*)/*$  /index.php?m=$1&a=$2  last;
                break;
                }
            }
      ```


4. 将appsocks.sql导入数据库(注意设置字符集编码为utf8防止乱码)
5. 设置云监控（360、阿里云都有免费的）定时任务去执行/appsocks/index.php/Home/Public/cron
5. 打开站点
6. 后台管理正常登录后面板点击进入（默认管理帐号 admin@admin.com 密码 123456）
7. 安装[manyuser](https://github.com/mengskysama/shadowsocks/tree/manyuser)，填写数据库连接信息，启动服务后一切完成

## 缺陷

* 后台管理员编辑普通用户信息功能
* 购买支付功能（ **支付宝免签是个难题** ）
* 邀请注册功能
* 找回密码功能


## 已完成

* 注册功能
* 登录功能
* 套餐订购界面样式
* 套餐支付界面样式
* 用户个人密码修改
* 用户个人套餐查看
* 用户购买记录查看
* 后台站点信息统计
* 后台用户管理查看所有用户功能
* 后台用户管理点击用户名称显示账单功能
* 后台套餐管理添加、删除功能（取消删除和编辑功能，而支持停用。原因涉及用户以往的购买记录无法查询被删的套餐信息。）
* 后台节点管理查看所有节点
* 使用教程
* 技术支持

## Demo

讲道理，当然没有咯
