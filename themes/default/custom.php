<?php theme_include('header'); ?>

    <div id="content">

        <?php if (has_posts()) : ?>

            <?php $first = true; while (get_posts()) : the_post(); ?>

                <?php if($first) : ?>

                <article id="post-<?php echo post_id(); ?>" class="post entry first">
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

                <?php $first = false; else : ?>

                <article id="post-<?php echo post_id(); ?>" class="post entry">
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

                <?php endif; ?>

            <?php endwhile; ?>

            <?php echo posts_paging(); ?>

        <?php else: ?>

            <article class="no-found">
                <h1>Not Found.</h1>
            </article>

        <?php endif; ?>

    </div>

<?php theme_include('footer'); ?>