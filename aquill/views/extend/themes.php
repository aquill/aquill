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
                <h1 class="theme-name">
                    <span><?php echo $theme->name ; ?></span>
                </h1>
                <p class="theme-author"><?php _e('global.theme_author', array('author' => $theme->author())); ?></p>
                <p class="theme-version"><?php _e('global.theme_version'); ?><?php echo $theme->version; ?></p>
                <?php if ($theme->description) : ?>
                <p class="theme-description"><?php _e('global.theme_description'); ?><?php echo $theme->description ; ?></p>
                <?php endif; if ($theme->tags) : ?>
                <p class="theme-tags"><?php _e('global.theme_tags'); ?><?php echo $theme->tags ; ?></p>
                <?php endif; ?>
                <?php if ($current_theme != $theme->view) : ?>
                <p class="theme-button"><button><?php _e('global.activate'); ?></button></p>
                <?php else : ?>
                <p class="theme-button"><small class="theme-current button"><?php _e('global.current_theme'); ?></small></p>
                <?php endif; ?>
            </div>
        </form>
    </div>
    <?php endforeach; ?>
</div>
<?php partial('partials/footer'); ?>
