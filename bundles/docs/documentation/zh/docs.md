# 简介

- [Aquill 介绍](#aquill-development)
- [Aquill 名称](#aquill-name)
- [如何使用 Aquill](#learning-aquill)
- [开发团队](#development-team)

<a name="aquill-development"></a>
## Aquill 介绍

Aquill是在Laravel基础开发的轻量级博客引擎，如果你熟悉类似于laravel的框架，你会很容易看懂它。比如ROR、Expressjs这两个是我用过的，他们有很多相同之处。

写Aquill的时候，我阅读过大量框架代码，最终选择了laravel，一方面是因为laravel的新潮和人气，另一方面有大量的插件包，方便移植。但是laravel 4做了大胆的尝试，用composer来管理项目，针对开发者而言，这是个不错的主意，但是Aquill面对的是最终用户，秉着代码洁癖的心理，我选择了laravel 3.0.0，这是个不错的精简版本，为了让博客运行的更加轻便，在laravel3.0.0的基础上又做修改，去除了一些不常用的模块和功能。

<a name="aquill-name"></a>
## Aquill 名称

Aquill读音[ækwil]，是a + quill的组合，取quill的意思，一根羽毛，一支鹅毛笔，羽毛很轻，鹅毛笔是最初识的书写工具，符合博客的形象，Logo的设计也由此而来。

<a name="learning-aquill"></a>
## 学习和使用 Aquill

虽然Aquill是在Laravel基础开发而来，但是还是有些许不同之处，因此Aquill提供了非常详细的文档，它详细说明了Aquill的各个方面以及怎样使用。

<a name="development-team"></a>
## 开发团队

Aquill目前全由Github@[chenos](https://github.com/aquill/chenos)一人开发，项目代码托管在Guihub[@aquill](https://github.com/aquill/aquill)上，欢迎大家一起踊跃参与。


#安装与设置

- [Aquill 介绍](#aquill-development)
- [Aquill 名称](#aquill-name)
- [如何使用 Aquill](#learning-aquill)
- [开发团队](#development-team)

## 环境要求

- Apache, Nginx，以后会考虑支持SAE等平台（IIS未测试）
- PHP 5.3.6+
- MySQL 5.2+, （SQLite 3, PostgreSQL还没来得及测试）。

如果大家还在用5.3之前的版本，可以考虑换个配置高一点的服务器。

## 友好化的链接

提前做好准备工作，用nginx的朋友可能还需要配置一下vhost文件，怎么配置呢？接着往下看吧。

    location / {
        try_files $uri $uri/ /index.php?$args;     # ?$args 这段参数不要忘了
    }

如果你放在某个子目录下面你需要这么写

    location /blog/ {
        try_files $uri $uri/ /blog/index.php?$args;     # ?$args 这段参数不要忘了
    }

Apache就容易多了，需要支持apache支持mod_rewrite，直接在Aquill的目录下添加`.htaccess`文件即可，内容如下：

    <IfModule mod_rewrite.c>
        RewriteEngine on

        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d

        RewriteRule ^(.*)$ index.php/$1 [L]
    </IfModule>

## 安装

1. 把Aquill代码上传并解压到服务器，设置目录`aquill/config`和`aquill/storage`权限为`0777`。这一点很关键，安装过程中需要在文件夹内写入一些必要的配置信息。
2. 为Aquill创建一个数据库，如果你没有权限，和其他数据表放在一起时，需要区分表前缀。
3. 打开网址，如果你是首次安装，你应该看到安装界面了，根据系统向导进行安装就可以了。
4. 安装成功之后，最好把`aquill/config`目录权限更改回来`0774`。

## 诸多待解决的问题

- 浏览器兼容性。目前只在最新版的Safari，Chrome，Firefox下测试通过，其他的带测试。（IE是个大问题，目前只考虑支持到IE9，IE8部分支持，其他的滚蛋吧）
- 控件。为了更友好的UI，重写了checkbox，radio，select，datetime控件，js还有bug，待完善。
- 相册拖拽上传。拖拽上传使用了HTML5的新特性，对于IE的兼容性有些差，目前还在测试中。

# 扩展包（功能暂时不完善）

- [插件包信息](#info)

继承了laravel的特点，Aquill也同时可以使用laravel社区上丰富的拓展包，不过有些插件包需要少量修改才可以在Aquill上运行。拓展包和插件类似，但是更为强大，每个拓展包都可以包含自己的视图、设置、路由等。为了让用户更方面使用拓展包，管理员只要在拓展面板`admin/bundles`里启动它，启动的插件包会显示在控制面板首页，管理员可以进行更为详细的设置。

<a name="aquill-name"></a>
## 插件包信息

插件包信息存放在插件包目录下的bundle.info里。文件结构和[ini](http://cn2.php.net/parse_ini_file)相似，一个完整的插件包信息：

    ; Aquill Documentation
    ;
    ; Author:     Aqiull Team <aquill.team@gmail.com>
    ; Copyright:  (c) 2013-2014 Aqiull Team
    ; License:    http://aquill.org/license
    ;
    ; This file format fully consistent with the ini-file
    ; Empty strings and strings beginning with ; symbols ignored
    ; For more information see http://php.net/manual/en/function.parse-ini-file.php
    ;

    ;
    ; Bundle info
    ;
    name        = "Documentation"
    url         = https://github.com/aquill/bundles/docs

    author      = "Aquill Team"
    author_url  = http://www.aquill.org/

    version     = 0.1.1
    license     = http://aquill.org/license

    description = "Document for Aquill"
    ;tags       = "one-column"

# 主题

    ; Aquill Default Theme
    ;
    ; Author:     Aqiull Team <aquill.team@gmail.com>
    ; Copyright:  (c) 2013 Aqiull Team
    ; License:    http://aquill.org/license
    ;
    ; This file format fully consistent with the ini-file
    ; Empty strings and strings beginning with ; symbols ignored
    ; For more information see http://php.net/manual/en/function.parse-ini-file.php
    ;

    ;
    ; Theme info
    ;
    name  = "Default"
    url   = https://github.com/aquill/themes/default

    author      = "Aquill Team"
    author_url  = http://www.aquill.org/

    version     = 0.1.1
    license     = http://aquill.org/license

    description = "Default theme for Aquill"
    tags        = "one-column"

# 主题参考函数

- [全局]()
- [文章]()
- [分类]()
- [标签]()
- [评论]()

为了降低学习成本，Aquill的主题参考函数，借鉴了WordPress的特点。

## 全局

`add_theme_script`

`add_theme_style`

`add_theme_asset`

`autop($pee, $br = true)`

`body_class($classes = array())`

`csrf_token()`

`csrf_token_input()`

`get_avatar()`

`is_admin()`

`is_author()`

`is_home()`

`is_category()`

`is_page()`

`is_post()`

`is_tag()`

`theme_asset()`

`theme_footer()`

`theme_header()`

`theme_include($filename)`

`theme_scripts($container = 'header')`

`theme_styles($container = 'header')`

`site_head_title()`

`site_title()`

`site_description()`

`site_menu_list()`

## 文章

`get_posts()`：获取最新文章列表。

`has_posts()`：检测当前页面（只能在首页和自定义页面中使用）是否含有文章列表，这是个布尔函数，存在则返回`TRUE`，否则`FALSE`。

`post_author()`：文章作者。

`post_id()`：文章ID。

`post_title()`：文章标题。

`post_date($format = 'Y-m-d H:i:s')`：文章发布日期。

`post_content()`：HTML格式的文章内容。

`post_excerpt()`：文章描述

`post_text()`：纯文本格式的文字内容

`post_link()`：文章链接

`post_previous()`：前一篇文章的链接

`post_next()`：下一篇文章的链接

`posts_paging()`：文章分页列表

`the_post()`：检索下一篇文章并激活，需要在while中使用。

实例

    <?php if (has_posts()) : ?>

        <?php while (get_posts()) : the_post(); ?>

            <h1><?php echo post_title(); ?></h1>
            <div><?php echo post_content(); ?></div>

        <?php endwhile; ?>

        <?php echo posts_paging(); ?>

    <?php else: ?>

        <p>Not Found.</p>

    <?php endif; ?>

## 分类


`get_categories()`

`has_categories()`

`category_description()`

`category_id()`

`category_link()`

`category_list()`

`category_name()`

`category_slug()`

`the_category()`

## 标签

`get_tags()`

`has_tags()`

`tag_description()`

`tag_id()`

`tag_link()`

`tag_list()`

`tag_name()`

`tag_slug()`

`the_tag()`

## 评论

`comments_open()`

`comment_id()`

`comment_author()`

`comment_author_name()`

`comment_author_email()`

`comment_author_url()`

`comment_avatar_avatar()`

`comment_date($format = 'Y-m-d H:i:s')`

`comment_content()`

`comment_message()`

`comment_text()`

`comment_paging()`

`comment_parent()`

`comment_list()`

`get_comments()`

`has_comments()`

`comment_post_input()`

`comment_name_input()`

`comment_email_input()`

`comment_url_input()`

`comment_content_input()`

`the_comment()`

