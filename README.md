# news
#### 简介

1. 采用 Laravel5.8 版本框架搭建
2. 前端使用 Bootstrap4 框架，适配移动、PC
3. 管理后台使用 Laravel-admin 1.8.4 版本 
5. 各个板块可自定义、扩展性强、注重细节、性能优秀
6. 写作支持 MarkDown 语法编辑器、Simditor 编辑器
7. 完美支持音乐播放、相册管理、视频播放
8. 支持邮箱订阅，发布文章，队列邮件通知
9. 支持全文检索

#### 服务器要求
 - 安装 Nginx 【推荐版本1.8】 / Apache -- 切记设置 Laravel 的伪静态，隐藏index.php文件入口。
 - 安装 Composer
 - 安装 MySQL 【推荐存储引擎 InnoDB】
 - 安装 Git 【推荐安装】
 - 安装 PHP >= 7.1.3 【推荐版本7.2】
 - (如果对PHP不熟悉、或者对于Laravel框架不熟悉的同学，推荐使用宝塔面板。[宝塔面板](https://www.bt.cn/?invite_code=MV9wbXRqeWc=))
 > PHP必要扩展
 ```
  DOM PHP 扩展
  OpenSSL PHP 拓展
  PDO PHP 拓展
  Mbstring PHP 拓展
  Tokenizer PHP 拓展
  XML PHP 拓展
  Ctype PHP 拓展
  JSON PHP 拓展
  BCMath PHP 拓展
  FileInfo PHP 扩展
  sqliet3 php 扩展
 ```

#### 常见问题
 - 1.执行 `composer install` 命令,报错无法下载扩展?
 > 首先确保MySQL数据库能正常连接，然后检查 PHP 扩展、再次确认 PHP >= 7.1.3 版本。Linux 可以执行 `php -m` 查看已有扩展。
 
 - 2.无法上传大视频或者歌曲文件？
 > **确认上传文件目录 `public` 和 `storage` 有增删权限**。然后配置 PHP 配置文件 `php.ini` 的上传文件配置。在配置文件中找到如下参数修改:
 
 ```
file_uploads = on ;是否允许通过HTTP上传文件的开关。
upload_max_filesize = 1024m ;允许上传文件大小的最大值。
post_max_size = 1024m ;指通过表单 POST 给 PHP 的所能接收的最大值。
max_execution_time = 600 ;每个 PHP 页面运行的最大时间值(秒)。
memory_limit = 128m ;每个 PHP 页面所吃掉的最大内存。
```

- 3.音乐、视频无法播放，HTTP 异步请求报 206 或 416 状态码？
 > 安装好后，音乐、视频无法播放， HTTP 异步请求 出现 **416 、206** 的状态码。是由于缺失 PHP 必要扩展，检查 PHP 扩展是否包含安装教程中所罗列的必要扩展。
