<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo site_title(); ?> - <?php echo site_description(); ?></title>
    <?php echo theme_styles(); ?>
</head>

<body <?php echo body_class(); ?>>
    
    <div id="header" class="col toolbar">
        <hgroup>
            <h1 class="site-title"><?php echo site_title(); ?></h1>
            <h2 class="site-description"><?php echo site_description(); ?></h2>
        </hgroup>

        <div class="site-navigation">
            <?php echo site_navigation(); ?>
        </div>
    </div>

    <div id="main" class="container">