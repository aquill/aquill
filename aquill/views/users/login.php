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
            <label for="username">Username</label>
            <input placeholder="Username" type="text" name="username">
        </div>
        <div class="control-group">
            <label for="password">Password</label>
            <input id="password" placeholder="Password" type="password" name="password">
        </div>
        <div class="form-actions">
            <button class="btn green" type="submit">Login</button>
            <a href="<?php echo url('amnesia'); ?>">Forgotten your password?</a>
        </div>
    </fieldset>
</form>
<?php echo exec_time(); echo memory_usage(); ?>
</body>
</html>