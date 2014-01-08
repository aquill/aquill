## Aquill介绍

Aquill是在Laravel基础开发的轻量级博客引擎，如果你熟悉类似于laravel的框架，你会很容易看懂Aquill。不过为了让博客运行的更加轻便，我在laravel3.0.0的基础上做了修改，又去除了一些不常用的模块和功能。

### 名称的来由

Aquill是a + quill的组合，取quill的意思，一根羽毛，一支鹅毛笔，羽毛很轻，鹅毛笔是最初识的书写工具，符合博客的形象。Aquill读音：[ækwil]。

Aquill目前全由我一人开发，项目代码托管在Guihub[@aquill](https://github.com/aquill/aquill)上，欢迎大家一起踊跃参与。

## Aquill的环境要求

- Apache, Nginx，以后会考虑支持SAE等平台
- PHP 5.3.6+
- MySQL 5.2+, （SQLite 3, PostgreSQL还没来得及测试）。

如果大家还在用5.3之前的版本，可以考虑换个配置高一点的服务器。）

提前做好准备工作，用nginx的朋友可能还需要配置一下vhost文件，怎么配置呢？接着往下看吧。

	location / {
	    try_files $uri $uri/ /index.php?$args;    # ?$args 这段参数不要忘了
	}

如果你放在某个子目录下面你需要这么写

	location /blog/ {
	    try_files $uri $uri/ /index.php?$args;
	}

Apache就容易多了，直接在Aquill的目录下添加`.htaccess`文件即可，内容如下：

	<IfModule mod_rewrite.c>
    	RewriteEngine on

    	RewriteCond %{REQUEST_FILENAME} !-f
    	RewriteCond %{REQUEST_FILENAME} !-d

    	RewriteRule ^(.*)$ index.php/$1 [L]
	</IfModule>

## 安装

- 把Aquill代码上传并解压到服务器，设置目录权限：`aquill/config`和`aquill/storage`目录权限`0777`。这一点很关键，安装过程中需要在文件夹内写入一些必要的配置信息。
- 打开网址，如果你是首次安装，你应该看到安装界面了，为了适应和满足不同用户的口味，系统默认添加了五种配色，紫，蓝，青，绿，黑。如下图：

![开始安装](bundles/docs/assets/images/start.png)

Aquill默认有中文和English两种语言，你可以自由选择，当然你也可以在之后的任何时候更改。

![开始安装](bundles/docs/assets/images/start-zh.png)

![开始安装](bundles/docs/assets/images/database.png)


![开始安装](bundles/docs/assets/images/metadata.png)

点击开始安装，接下来按照提示输入信息即可，看到下面这个界面就说明博客已经安装成功了。

<img src="bundles/docs/assets/images/complete.png" alt="安装成功">

我们先来看看管理面板吧，记得要先登录

<img src="bundles/docs/assets/images/dashboard.png" alt="安装成功">


![开始安装](bundles/docs/assets/images/new.png)

![开始安装](bundles/docs/assets/images/post.png)

![开始安装](bundles/docs/assets/images/bundles.png)

![开始安装](bundles/docs/assets/images/rewrite.png)

![开始安装](bundles/docs/assets/images/media.png)

![开始安装](bundles/docs/assets/images/themes.png)

![开始安装](bundles/docs/assets/images/comments.png)

![开始安装](bundles/docs/assets/images/mailer.png)

