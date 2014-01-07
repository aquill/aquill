<?php partial('partials/header'); ?>

<section class="content container one-column">
    
    <?php echo $messages; ?>

    <div class="wrap">
        <article>
            <h1><?php _e('urls.title'); ?></h1>

            <p><?php _e('urls.description'); ?></p>
        </article>

        <form method="post" action="<?php echo url('admin/urls'); ?>" autocomplete="off">
            
            <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
            
            <fieldset>
                <div class="control-group">
                    <label for="permalink" class="control-label"><?php _e('urls.tag'); ?></label>

                    <div class="controls">
                        <input id="custom" type="text" name="rewrite_home" value="<?php echo $rewrite_home; ?>">
                        <i class="info"><?php _e('urls.tag_description'); ?></i>
                    </div>
                </div>

                <div class="control-group">
                    <label for="permalink" class="control-label">
                        <span><?php _e('urls.post'); ?></span>
                        <i class="info"><?php _e('urls.post_description'); ?></i>
                    </label>

                    <div class="controls">
                        <?php $checked = null;
                        foreach ($posts as $key => $value) : ?>
                            <?php if ($key == 'custom') : ?>
                                <label class="custom">
                                    <input type="radio" name="rewrite_post" value=""
                                        <?php if (is_null($checked)) echo 'checked'; ?>>
                                    <span><?php _e('urls.post_' . $key); ?></span>
                                    <input id="custom" type="text" name="rewrite_post_custom" size="35"
                                           value="<?php if (is_null($checked)) echo $rewrite_post; ?>"
                                           style="display:inline;">
                                </label>
                                <?php break; endif; ?>
                            <label>
                                <input type="radio" name="rewrite_post" value="<?php echo $value; ?>"
                                    <?php if ($value == $rewrite_post) echo $checked = 'checked'; ?>>
                                <span><?php _e('urls.post_' . $key); ?></span>
                                <code><?php echo $value; ?></code>
                            </label><br>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="control-group">
                    <label for="permalink" class="control-label"><?php _e('urls.page'); ?></label>

                    <div class="controls">
                        <input id="custom" type="text" name="rewrite_page" value="<?php echo $rewrite_page; ?>">
                        <i class="info"><?php _e('urls.page_description'); ?></i>
                    </div>
                </div>

                <div class="control-group">
                    <label for="permalink" class="control-label"><?php _e('urls.category'); ?></label>

                    <div class="controls">
                        <input id="custom" type="text" name="rewrite_category" value="<?php echo $rewrite_category; ?>">
                        <i class="info"><?php _e('urls.category_description'); ?></i>
                    </div>
                </div>

                <div class="control-group">
                    <label for="permalink" class="control-label"><?php _e('urls.tag'); ?></label>

                    <div class="controls">
                        <input id="custom" type="text" name="rewrite_tag" value="<?php echo $rewrite_tag; ?>">
                        <i class="info"><?php _e('urls.tag_description'); ?></i>
                    </div>
                </div>

                <div class="control-group">
                    <label for="permalink" class="control-label"><?php _e('urls.tag'); ?></label>

                    <div class="controls">
                        <input id="custom" type="text" name="rewrite_author" value="<?php echo $rewrite_author; ?>">
                        <i class="info"><?php _e('urls.tag_description'); ?></i>
                    </div>
                </div>
            </fieldset>

            <section class="form-actions">
                <button type="submit" class="btn"><?php _et('global.save'); ?></button>
            </section>
        </form>
    </div>
</section>

<?php partial('partials/footer'); ?>
