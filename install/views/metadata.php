<?php partial('partials/header'); ?>

<section class="content">
    <article>
        <h1><?php echo __('metadata.title'); ?></h1>
        <p><?php echo __('metadata.description'); ?></p>
    </article>

    <form method="post" action="<?php echo url('metadata'); ?>" autocomplete="off">
        <?php echo $messages; ?>
        <?php echo Form::token(); ?>
        <fieldset>
            <div class="control-group">
                <label for="title" class="control-label"><?php echo __('metadata.site_title'); ?></label>

                <div class="controls">
                    <input id="title" name="title" value="<?php echo $title; ?>">
                    <i class="info"><?php echo __('metadata.site_title_description'); ?></i>
                </div>
            </div>

            <div class="control-group">
                <label for="description" class="control-label"><?php echo __('metadata.site_description'); ?></label>

                <div class="controls" style="line-height:0;">
                    <textarea id="description" name="description"><?php echo $description; ?></textarea>
                    <i class="info"><?php echo __('metadata.site_description_description'); ?></i>
                </div>
            </div>

            <div class="control-group">
                <label for="url" class="control-label"><?php echo __('metadata.site_url'); ?></label>

                <div class="controls">
                    <input id="url" name="url" value="<?php echo $url; ?>">
                    <i class="info"><?php echo __('metadata.site_url_description'); ?></i>
                </div>
            </div>

            <div class="control-group">
                <label for="index" class="control-label"><?php echo __('metadata.site_index'); ?></label>

                <div class="controls">
                    <input id="index" name="index" value="<?php echo $index; ?>">
                    <i class="info"><?php echo __('metadata.site_index_description'); ?></i>
                </div>
            </div>
        </fieldset>

        <section class="form-actions">
            <a href="<?php echo url('database'); ?>" class="btn quiet"><?php echo __('install.back'); ?></a>
            <button type="submit" class="btn"><?php echo __('install.next'); ?></button>
        </section>
    </form>
</section>

<?php partial('partials/footer'); ?>
