<?php theme_include('header'); ?>

    <div id="content">

        <?php if (has_posts()) : ?>

            <?php while (get_posts()) : the_post(); ?>

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
                </article>
            <?php endwhile; ?>

            <?php echo posts_paging(); ?>

        <?php else: ?>

            <article class="no-found">
                <h1>Not Found.</h1>
            </article>

        <?php endif; ?>

    </div>

<?php theme_include('footer'); ?>