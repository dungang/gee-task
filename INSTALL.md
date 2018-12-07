安装
--

只说明linux Centos的安装

window环境直接安装一个集成环境，比如xampp即可

文档中的域名请替换成自己的域名，域名解析配置不多说明

系统的开发环境
--
- window10
- xampp-3.2.2


demo运行环境
--
- centos7.4
- php-5.6
- 5.5.60-MariaDB
- nginx-1.12.2

centos
----
> mysql 安装

```sh
yum install mariadb mariadb-server 

```

> php5.6 环境准备

```sh
#清除已安装的php,可选操作
yum remove php*

rpm -Uvh https://mirror.webtatic.com/yum/el7/epel-release.rpm
rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm
wget http://packages.sw.be/rpmforge-release/rpmforge-release-0.5.1-1.el5.rf.x86_64.rpm
yum install rpmforge
```

> nginx 环境
 
 ```sh
 yum install nginx
 ```
 

> 或apache 环境
 
 ```sh
 yum install httpd
```
 
> php安装

```sh
#安装php5.6
yum install php56w php56-fpm php56w-mbstring php56w-opcache php56w-pdo php56w-pdo-mysql php56w-intl php56w-icu php56w-expose php56w-gd php56w-dom php56w-memcache

#如果是nginx作为web服务器
yum install php56w-fpm 

```

部署代码
--

```sh
#上传路径 
/var/www/gee-task

#添加可写目录
mkdir runtime
chmod -D 777 runtime
mkdir web/assests
chmod -D 777 web/assets
```

创建数据库
--
这里太简单了就不多说明了，如果是生产使用db.sql,如果是演示使用geetask.sql

>修改geetask的数据库配置

```php
cd /var/www/gee-task/config
vim db.php

#修改配置
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=geetask',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8mb4',

    // Schema cache options (for production environment)
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 60,
    'schemaCache' => 'cache',
];
```


为方便部署，vendor文件我打包了，就不用composer install,直接解压即可

```sh
#到项目的仓库，只能从gitee.com的仓库下载附件
#linux环境下载 vendor.tar.gz
#window环境下载 vendor.rar

#只说明linux的使用方法，window用rar软件解压即可
#上传到/var/www/gee-task/
cd /var/www/gee-task/
tar -xzvf vendor.tar.gz
```

配置
--

> nginx

```sh
cd /etc/nginx
vim nginx

#添加如下配置
  http {
    ...
    #从这里开始
    server {
		listen       80;
		server_name  geetask.weifutek.com;
		root         /var/www/gee-task/web/;
		
		index	index.php;
	
	    # Load configuration files for the default server block.
	    include /etc/nginx/default.d/*.conf;
	
	    location / {
			try_files $uri $uri/ /index.php$is_args$args;
	    }
	
	
	    #error_page 404 /404.html;
	    #    location = /40x.html {
	    #}
	
	    #error_page 500 502 503 504 /50x.html;
	    #    location = /50x.html {
	    #}
	
		location ~ \.php$ {
			include fastcgi_params;
			fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
			#fastcgi_pass unix:/var/run/php/php-fpm.sock;
			fastcgi_pass 127.0.0.1:9000;
			try_files $uri =404;
		}
		
		location ~ /\.(ht|svn|git) {
			deny all;
		}
    }
    #结束
    ....
 }
```

> apache

```sh
cd /etc/httpd/conf.d/
touch geetask.conf
vim geetask.conf
##添加如下配置
<VirtualHost *:80>
	ServerAdmin webmaster@geetask.weifutek.com
	DocumentRoot "/var/www/gee-task/web"
	ServerName geetask.weifutek.com
	ErrorLog "logs/geetask.weifutek.com-error.log"
	CustomLog "logs/geetask.weifutek.com-access.log" common
</VirtualHost>
```

启动服务器
--

> nginx

```sh
systemctl start php-fpm
systemctl start nginx
```


> apache

```sh
systemctl start httpd
```