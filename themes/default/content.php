<article id="post-<?php echo post_id(); ?>" class="post">
    <div class="entry-header">
        <h1 class="entry-title">
            <a href="<?php echo post_link(); ?>" rel="bookmark"><?php echo post_title(); ?></a>
        </h1>

        <div class="entry-meta">
            <?php echo post_author();?>
            <?php echo post_date();?>
        </div>
    </div>

    <div class="entry-content">
        <?php echo post_content(); ?>
    </div>

    <div class="entry-footer">
        <?php echo tag_list(); ?>
        <?php echo category_list(); ?>
    </div>
</article>