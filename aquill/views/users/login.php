<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <?php echo HTML::style('assets/css/global.css'); ?>
    <?php echo HTML::style('assets/css/login.css'); ?>
</head>
<body class="login">

<form class="loginform" method="POST" action="<?php echo url('login'); ?>" accept-charset="UTF-8">
    <fieldset class="split">
        <?php echo $messages; ?>
        <div class="control-group">
            <label for="username"><?php echo __('login.username'); ?></label>
            <input placeholder="<?php echo __('login.username'); ?>" type="text" name="username">
        </div>
        <div class="control-group">
            <label for="password"><?php echo __('login.password'); ?></label>
            <input id="password" placeholder="<?php echo __('login.password'); ?>" type="password" name="password">
        </div>
        <div class="form-actions">
            <button class="btn green" type="submit"><span class="icon-login"></span></button>
            <label class="icon-checkbox-checked"><input type="checkbox" name="remember" value="remember">
                <?php echo __('login.remember'); ?></label>
            <a href="<?php echo url('amnesia'); ?>"><?php echo __('login.amnesia'); ?></a>
        </div>
    </fieldset>
</form>
<div id="footer">
    <?php echo exec_time();
    echo memory_usage(); ?>
</div>
</body>
</html>