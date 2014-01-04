<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <?php echo HTML::style('assets/css/global.css'); ?>
    <?php echo HTML::style('assets/css/login.css'); ?>
</head>
<body <?php echo admin_body_class('login amnesia'); ?>>

<form class="loginform" method="POST" action="<?php echo url('login'); ?>" accept-charset="UTF-8">
    <fieldset class="split">
        <?php echo $messages; ?>
        <div class="control-group">
            <label for="email"><?php _e('login.email'); ?></label>
            <input id="email" placeholder="<?php _e('login.email'); ?>" type="email" name="email">
        </div>
        <div class="form-actions">
            <button class="btn green" type="submit"><span class="icon-login"></span></button>
        </div>
    </fieldset>
</form>
<div id="footer">
    <?php echo exec_time();
    echo memory_usage(); ?>
</div>
</body>
</html>