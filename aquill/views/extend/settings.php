<?php partial('partials/header'); ?>

<?php partial('extend/sidebar'); ?>

    <div class="container">

        <form method="post" action="<?php echo url('admin/settings'); ?>" novalidate="">

            <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">

            <fieldset class="header">
                <div class="wrap">
                    <h1><?php _e('setting.settings'); ?></h1>
                    <aside class="form-actions buttons">
                        <button type="submit" class="btn green">
                            <span class="icon-save"></span>
                            <?php //_e('global.update'); ?></button>
                    </aside>
                </div>
            </fieldset>

            <fieldset class="split">
                <div class="wrap">

                    <div class="control-group">
                        <label for="site_title" class="control-label"><?php _e('setting.site_title'); ?></label>

                        <div class="controls">
                            <input type="text" id="site_title" name="site_title" value="<?php echo $site_title; ?>"></p>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="site_description"
                               class="control-label"><?php _e('setting.site_description'); ?></label>

                        <div class="controls">
                            <textarea id="site_description" name="site_description" rows="3"
                                      cols="50"><?php echo $site_description; ?></textarea>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="home_page" class="control-label"><?php _e('setting.site_color'); ?></label>

                        <div class="controls">

                            <?php $colors = array('black', 'green', 'blue', 'purple', 'cyan'); ?>
                            <?php foreach ($colors as $color) : ?>
                                <label class="<?php echo $color; ?> color">
                                    <input <?php echo $color == $site_color ? 'checked' : ''; ?> type="radio"
                                                                                                 name="color"
                                                                                                 value="<?php echo $color; ?>">
                                </label>
                            <?php endforeach; ?>

                        </div>
                    </div>

                    <div class="control-group">
                        <label for="per_page" class="control-label"><?php _e('setting.per_page'); ?></label>

                        <div class="controls">
                            <input type="text" id="per_page" name="per_page" value="20">
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="comment_status" class="control-label"><?php _e('setting.comment_status'); ?></label>

                        <div class="controls">
                            <label><input id="comment_status" name="comment_status"
                                          type="checkbox"
                                          value="1" checked=""><?php _e('setting.auto_published_comments'); ?></label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="email_notification"
                               class="control-label"><?php _e('setting.email_notification'); ?></label>

                        <div class="controls">
                            <label><input id="email_notification" name="email_notification" type="checkbox"
                                          value="1" checked=""><?php _e('setting.email_notification_desc'); ?></label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="spam_keywords" class="control-label"><?php _e('setting.spam_keywords'); ?></label>

                        <div class="controls">
                            <textarea id="spam_keywords" name="spam_keywords" rows="3" cols="50"></textarea>
                        </div>
                    </div>

                </div>
            </fieldset>
        </form>
    </div>
    </div>

<?php partial('partials/footer'); ?>