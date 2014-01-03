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
            <h1><?php _et('start.title'); ?></h1>
            <p><?php _et('start.description'); ?></p>
        </article>
        <form method="post" action="<?php echo url('start'); ?>">
            <p>
                <select id="lang" name="language">
                    <option value="en"><?php _et('start.language'); ?></option>
                    <?php foreach ($languages as $key => $lang): ?>
                        <option value="<?php echo $key; ?>"><?php echo $lang; ?></option>
                    <?php endforeach; ?>
                </select>
            </p>
            <p>
                <select id="timezone" name="timezone">
                    <option value="utc"><?php _et('start.timezone'); ?></option>
                    <?php foreach ($timezones as $zone): ?>
                        <option value="<?php echo $zone['timezone_id']; ?>"><?php echo $zone['label']; ?></option>
                    <?php endforeach; ?>
                </select>
            </p>
            <p>
                <span class="black color"></span>
                <span class="green color"></span>
                <span class="blue color"></span>
                <span class="purple color"></span>
                <span class="cyan color"></span>
            </p>
            <p>
                <button class="btn" type="submit"><?php _et('start.start'); ?></button>
            </p>
            
        </form>
    </section>
    <footer>
    <?php echo 'Aquill '.AQUILL_VERSION.'.'; ?>
    <?php echo exec_time(); ?> <?php echo memory_usage(); ?>      
    </footer>

<?php echo Asset::container('footer')->scripts(); ?>
</body>
</html>