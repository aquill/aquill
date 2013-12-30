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
        <?php if (has_tags()) : ?>
        <h3>Tags:</h3>
        <ul class="tag">
            <?php while (get_tags()) : the_tag(); ?>
                <li><a class="tag" href="<?php echo tag_link(); ?>"><?php echo tag_name(); ?></a></li>
            <?php endwhile; ?>
        </ul>
        <?php endif; ?>

        <?php if (has_categories()) : ?>
            <h3>Categories:</h3>
            <ul class="tag">
                <?php while (get_categories()) : the_category(); ?>
                    <li><a href="<?php echo category_link(); ?>"><?php echo category_name(); ?></a></li>
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>
    </div>
</article>