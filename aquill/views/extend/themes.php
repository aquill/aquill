<?php partial('partials/header'); ?>
<?php //partial('extend/sidebar'); ?>
<div class="container one-column">
    <?php echo $messages; ?>
    <?php foreach ($themes as $theme) : ?>
    <div class="wrap theme">
        <form class="themeform" method="post" action="<?php echo url('admin/themes/'.$theme->view) ; ?>">

            <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="site_theme" value="<?php echo $theme->view; ?>">

            <div class="theme-screenshot"><img width="60%" src="<?php echo $theme->screenshot ; ?>"></div>
            <div class="theme-info">
                <h1 class="theme-name"><?php echo $theme->name ; ?></h1>
                <p class="theme-author">By <?php echo $theme->author(); ?></p>
                <p class="theme-version">Version: <?php echo $theme->version; ?></p>
                <?php if ($theme->description) : ?>
                <p class="theme-description">Description: <?php echo $theme->description ; ?></p>
                <?php endif; if ($theme->tags) : ?>
                <p class="theme-tags">Tags: <?php echo $theme->tags ; ?></p>
                <?php endif; ?>
                <p class="theme-button"><button>Activate</button></p>
            </div>
        </form>
    </div>
    <?php endforeach; ?>
</div>
<?php partial('partials/footer'); ?>
