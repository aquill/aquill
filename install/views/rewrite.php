<?php partial('partials/header'); ?>

<section class="content">
    <article>
        <h1><?php _et('rewrite.title'); ?></h1>
        <p><?php _et('rewrite.description'); ?></p>
    </article>

    <form method="post" action="<?php echo url('rewrite'); ?>" autocomplete="off">
        <?php echo $messages; ?>
        <?php echo Form::token(); ?>
        <fieldset>
            <div class="control-group">
                <label for="permalink" class="control-label"><?php _et('rewrite.tag'); ?></label>

                <div class="controls">
                    <input id="custom" type="text" name="home" value="<?php echo $home; ?>">
                    <i class="info"><?php _et('rewrite.tag_description'); ?></i>
                </div>
            </div>
            <div class="control-group">
                <label for="permalink" class="control-label"><?php _et('rewrite.post'); ?></label>

                <div class="controls">
                    <?php $checked = null; foreach ($posts as $key => $value) : ?>
                        <?php if ($key == 'custom') : ?>
                        <label>
                            <input type="radio" name="post" value="<?php echo $value; ?>" 
                                <?php if(is_null($checked)) echo 'checked'; ?>>
                            <span><?php _et('rewrite.post_' . $key); ?></span>
                            <input id="custom" type="text" name="post_custom" size="35"
                                    value="<?php if(is_null($checked)) echo $post; ?>" 
                                    style="display:inline;">
                        </label>
                        <?php break; endif; ?>
                        <label>
                            <input type="radio" name="post" value="<?php echo $value; ?>" 
                                <?php if ($value == $post) echo $checked = 'checked'; ?>>
                            <span><?php _et('rewrite.post_' . $key); ?></span>
                            <code><?php echo $value; ?></code>
                        </label><br>
                    <?php endforeach; ?>
                    <i class="info2"><?php _et('rewrite.post_description'); ?></i>
                </div>
            </div>

            <div class="control-group">
                <label for="permalink" class="control-label"><?php _et('rewrite.page'); ?></label>

                <div class="controls">
                    <input id="custom" type="text" name="page" value="<?php echo $page; ?>">
                    <i class="info"><?php _et('rewrite.page_description'); ?></i>
                </div>
            </div>

            <div class="control-group">
                <label for="permalink" class="control-label"><?php _et('rewrite.category'); ?></label>

                <div class="controls">
                    <input id="custom" type="text" name="category" value="<?php echo $category; ?>">
                    <i class="info"><?php _et('rewrite.category_description'); ?></i>
                </div>
            </div>

            <div class="control-group">
                <label for="permalink" class="control-label"><?php _et('rewrite.tag'); ?></label>

                <div class="controls">
                    <input id="custom" type="text" name="tag" value="<?php echo $tag; ?>">
                    <i class="info"><?php _et('rewrite.tag_description'); ?></i>
                </div>
            </div>

            <div class="control-group">
                <label for="permalink" class="control-label"><?php _et('rewrite.tag'); ?></label>

                <div class="controls">
                    <input id="custom" type="text" name="author" value="<?php echo $author; ?>">
                    <i class="info"><?php _et('rewrite.tag_description'); ?></i>
                </div>
            </div>
        </fieldset>

        <section class="form-actions">
            <a href="<?php echo url('metadata'); ?>" class="btn quiet"><?php _et('install.back'); ?></a>
            <button type="submit" class="btn"><?php _et('install.next'); ?></button>
        </section>
    </form>
</section>

<?php partial('partials/footer'); ?>
