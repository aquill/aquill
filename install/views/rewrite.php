<?php install_include('header'); ?>

<section class="content">
    <article>
        <h1><?php echo __('rewrite.title'); ?></h1>
        <p><?php echo __('rewrite.description'); ?></p>
    </article>

    <form method="post" action="<?php echo url('rewrite'); ?>" autocomplete="off">
        <?php echo $messages; ?>
        <?php echo Form::token(); ?>
        <fieldset>
            <div class="control-group">
                <label for="permalink" class="control-label"><?php echo __('rewrite.post_rewrite'); ?></label>

                <div class="controls">
                    <?php $checked = null; foreach ($post_rewrites as $key => $value) : ?>
                        <?php if ($key == 'custom') : ?>
                        <label>
                            <input type="radio" name="post_rewrite" value="<?php echo $value; ?>" 
                                <?php if(is_null($checked)) echo 'checked'; ?>>
                            <span><?php echo __('rewrite.post_rewrite_' . $key); ?></span>
                            <input id="custom" type="text" name="post_rewrite_custom" size="35"
                                    value="<?php if(is_null($checked)) echo $post_rewrite; ?>" 
                                    style="display:inline;">
                        </label>
                        <?php break; endif; ?>
                        <label>
                            <input type="radio" name="post_rewrite" value="<?php echo $value; ?>" 
                                <?php if ($value == $post_rewrite) echo $checked = 'checked'; ?>>
                            <span><?php echo __('rewrite.post_rewrite_' . $key); ?></span>
                            <code><?php echo $value; ?></code>
                        </label><br>
                    <?php endforeach; ?>
                    <i><?php echo __('rewrite.post_rewrite_description'); ?></i>
                </div>
            </div>

            <div class="control-group">
                <label for="permalink" class="control-label"><?php echo __('rewrite.page_rewrite'); ?></label>

                <div class="controls">
                    <input id="custom" type="text" name="page_rewrite" value="<?php echo $page_rewrite; ?>">
                    <i><?php echo __('rewrite.page_rewrite_description'); ?></i>
                </div>
            </div>

            <div class="control-group">
                <label for="permalink" class="control-label"><?php echo __('rewrite.category_rewrite'); ?></label>

                <div class="controls">
                    <input id="custom" type="text" name="category_rewrite" value="<?php echo $category_rewrite; ?>">
                    <i><?php echo __('rewrite.category_rewrite_description'); ?></i>
                </div>
            </div>

            <div class="control-group">
                <label for="permalink" class="control-label"><?php echo __('rewrite.tag_rewrite'); ?></label>

                <div class="controls">
                    <input id="custom" type="text" name="tag_rewrite" value="<?php echo $tag_rewrite; ?>">
                    <i><?php echo __('rewrite.tag_rewrite_description'); ?></i>
                </div>
            </div>
        </fieldset>

        <section class="form-actions">
            <a href="<?php echo url('metadata'); ?>" class="btn quiet"><?php echo __('install.back'); ?></a>
            <button type="submit" class="btn"><?php echo __('install.next'); ?></button>
        </section>
    </form>
</section>

<?php install_include('footer'); ?>
