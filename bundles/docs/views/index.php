<!doctype html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Aquill: A lightweight and elegant blogging engine.</title>
    <meta name="viewport" content="width=device-width">
    <?php echo Asset::styles(); ?>
    <?php echo Asset::scripts(); ?>
</head>
<body onload="prettyPrint()">
    <div id="site" class="wrapper">
        <?php echo $content; ?>
    </div>
</body>
</html>