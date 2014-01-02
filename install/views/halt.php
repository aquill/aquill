<!doctype html>
<html lang="en-gb">
<head>
    <meta charset="utf-8">
    <title><?php _et('install.title'); ?></title>
    <meta name="robots" content="noindex, nofollow">
    <?php echo Asset::container('header')->styles(); ?>
    <script type="text/javascript">var base = "<?php echo url('admin') . '/'; ?>";</script>
    <?php echo Asset::container('header')->scripts(); ?></head>
    
<body class="halt">

    <section class="content">
        <article>
            <h1><?php _et('install.halt'); ?></h1>
            <p><?php echo $messages; ?></p>
            <p>Please <a href="<?php echo urlencode('start'); ?>"><?php _et('install.again'); ?></a></p>
        </article>
    </section>
    <footer>
    <?php echo 'Aquill '.AQUILL_VERSION.'.'; ?>
    <?php echo exec_time(); ?> <?php echo memory_usage(); ?>      
    </footer>

<?php echo Asset::container('footer')->scripts(); ?>
</body>
</html>