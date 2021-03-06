<!doctype html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Aquill: A lightweight and elegant blogging engine.</title>
    <meta name="viewport" content="width=device-width">
    <link href='http://fonts.googleapis.com/css?family=Meddon' rel='stylesheet' type='text/css'>
    <?php echo Asset::styles(); ?>
    <?php echo Asset::scripts(); ?>
    <link rel="icon" href="<?php echo asset('assets/favicon.png'); ?>" sizes="32x32" type="image/png">
</head>
<body onload="prettyPrint()">
    <div id="header">
        <div id="logo" class="icon-aquill"></div>
        <h1>Aquill <sup>alpha</sup></h1>
        <h2>一款优雅的超轻量级博客引擎</h2>
    </div>
    <div id="ui">
        <div class="wrapper">
            <?php echo $ui; ?>
        </div>
        <div class="buttons">
                <a class="button" href="<?php echo asset('docs') ?>">文档</a>
                <p>Aquill目前还在测试和完善中，暂不提供下载。<br>
                发烧友可以前往<a href="https://github.com/aquill/aquill">Github@aquill</a>下载，
                还可以<a href="https://github.com/aquill/aquill">查看DEMO预览</a></p>
            </div>
    </div>
</body>
</html>