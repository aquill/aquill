<?php partial('partials/header'); ?>

<?php //partial('extend/sidebar'); ?>

    <div class="container extend">

        <form method="post" action="<?php echo url('admin/general'); ?>" novalidate="">

            <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">

            <fieldset class="header">
                <div class="wrap">
                    <h1><?php _e('extend.settings'); ?></h1>
                    <aside class="form-actions buttons">
                        <button type="submit" class="btn green">
                            <span class="icon-save"></span>
                            <?php //_e('global.update'); ?></button>
                    </aside>
                </div>
            </fieldset>

            <?php echo $messages; ?>

            <fieldset class="split">
                <div class="wrap">

                    <div class="control-group">
                        <label for="site_title" class="control-label"><?php _e('extend.site_title'); ?></label>

                        <div class="controls">
                            <input type="text" id="site_title" name="site_title" value="<?php echo $site_title; ?>"></p>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="site_description"
                               class="control-label"><?php _e('extend.site_description'); ?></label>

                        <div class="controls">
                            <textarea id="site_description" name="site_description" rows="3"
                                      cols="50"><?php echo $site_description; ?></textarea>
                        </div>
                    </div>

                    <div class="control-group">
                                                <label for="home_page" class="control-label"><?php _e('extend.language'); ?></label>
<div class="controls">

                <select id="lang" name="language">
                    <?php foreach ($languages as $key => $lang): ?>
                        <option value="<?php echo $key; ?>"><?php echo $lang; ?></option>
                    <?php endforeach; ?>
                </select>
                </div>
            </div>
            <div class="control-group">
                <label for="timezone" class="control-label"><?php _e('extend.timezone'); ?></label>
<div class="controls">
                  <select id="timezone" name="timezone">
                    <?php foreach ($timezones as $value => $option): ?>
                        <option value="<?php echo $value; ?>"><?php echo $option; ?></option>
                    <?php endforeach; ?>
                </select>
</div>

            </div>

                    <div class="control-group">
                        <label for="home_page" class="control-label"><?php _e('extend.site_color'); ?></label>

                        <div class="controls">

                            <?php $colors = array('black', 'green', 'blue', 'purple', 'cyan'); ?>
                            <?php foreach ($colors as $color) : ?>
                                <label class="<?php echo $color; ?> color">
                                    <input type="radio" name="site_color" value="<?php echo $color; ?>"  
                                            <?php echo $color == $site_color ? 'checked' : ''; ?>>
                                </label>
                            <?php endforeach; ?>

                        </div>
                    </div>

                    <div class="control-group">
                        <label for="per_page" class="control-label"><?php _e('extend.per_page'); ?></label>

                        <div class="controls">
                            <input type="text" id="per_page" name="per_page" value="<?php echo $per_page; ?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="comment_status" class="control-label"><?php _e('extend.comment_status'); ?></label>

                        <div class="controls">
                            <label>
                                <input id="comment_status" name="comment_status" type="checkbox"
                                        value="1" <?php echo $comment_status ? 'checked' : '' ; ?>>
                                        <?php _e('extend.auto_published_comments'); ?></label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="email_notification"
                               class="control-label"><?php _e('extend.email_notification'); ?></label>

                        <div class="controls">
                            <label>
                                <input <?php echo $email_notification ? 'checked' : '' ; ?> 
                                        id="email_notification" name="email_notification" type="checkbox" value="1">
                                <?php _e('extend.email_notification_desc'); ?></label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="spam_keywords" class="control-label"><?php _e('extend.spam_keywords'); ?></label>

                        <div class="controls">
                            <textarea id="spam_keywords" name="spam_keywords" rows="3" cols="50"><?php echo $spam_keywords; ?></textarea>
                        </div>
                    </div>

                </div>
            </fieldset>
        </form>
    </div>

<?php partial('partials/footer'); ?>