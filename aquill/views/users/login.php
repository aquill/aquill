<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <?php echo HTML::style('assets/css/global.css'); ?>
    <?php echo HTML::style('assets/css/login.css'); ?>
</head>
<body <?php echo admin_body_class('login'); ?>>

<form class="loginform" method="POST" action="<?php echo url('login'); ?>" accept-charset="UTF-8">
    <fieldset class="split">
        <?php echo $messages; ?>
        <div class="control-group">
            <label for="username"><?php _e('login.username'); ?></label>
            <input placeholder="<?php _e('login.username'); ?>" type="text" name="username">
        </div>
        <div class="control-group">
            <label for="password"><?php _e('login.password'); ?></label>
            <input id="password" placeholder="<?php _e('login.password'); ?>" type="password" name="password">
        </div>
        <div class="form-actions">
            <button class="btn green" type="submit"><span class="icon-login"></span></button>
            <label class="icon-checkbox checked"><input type="checkbox" name="remember" value="remember">
                <?php _e('login.remember'); ?></label>
            <a href="<?php echo url('amnesia'); ?>"><?php _e('login.amnesia'); ?></a>
        </div>
    </fieldset>
</form>
<div id="footer">
    <?php echo exec_time();
    echo memory_usage(); ?>
</div>
</body>
</html>