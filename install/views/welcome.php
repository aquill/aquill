<!doctype html>
<html lang="en-gb">
<head>
    <meta charset="utf-8">
    <title><?php _et('install.title'); ?></title>
    <meta name="robots" content="noindex, nofollow">
    <?php echo Asset::container('header')->styles(); ?>
    <script type="text/javascript">var base = "<?php echo url('admin') . '/'; ?>";</script>
    <?php echo Asset::container('header')->scripts(); ?></head>
    
<body class="halt <?php echo session::get('current.color', 'purple'); ?>">

    <section class="content">
        <article>
            <h1><?php _et('start.title'); ?></h1>
            <p><?php _et('start.description'); ?></p>
        </article>
        <form method="post" action="<?php echo url('start'); ?>">
            <p class="control-group">
                <select id="lang" name="language">
                    <option value="en"><?php _et('start.language'); ?></option>
                    <?php foreach ($languages as $key => $lang): ?>
                        <option value="<?php echo $key; ?>"><?php echo $lang; ?></option>
                    <?php endforeach; ?>
                </select>
            </p>
            <p class="control-group">
                <select id="timezone" name="timezone">
                    <option value="utc"><?php _et('start.timezone'); ?></option>
                    <?php foreach ($timezones as $value => $option): ?>
                        <option value="<?php echo $value; ?>"><?php echo $option; ?></option>
                    <?php endforeach; ?>
                </select>
            </p>
            <p>
                <?php $colors = array('black', 'green', 'blue', 'purple', 'cyan'); ?>
                <?php foreach ($colors as $c) : ?>
                    <label class="<?php echo $c; ?> color">
                        <input <?php echo $c == $color ? 'checked' : ''; ?> type="radio" name="color" value="<?php echo $c; ?>">
                    </label>
                <?php endforeach; ?>
            </p>
            <p>
                <button class="btn" type="submit"><?php _et('start.start'); ?></button>
            </p>
            
        </form>
    </section>
    <footer>
    <?php echo 'Aquill '.AQUILL_VERSION.'.'; ?><br>
    <?php echo exec_time(); ?> <?php echo memory_usage(); ?>      
    </footer>

<?php echo Asset::container('footer')->scripts(); ?>
</body>
</html>