<?php theme_include('header'); ?>

    <div id="content">

        <?php if (has_posts()) : ?>

            <?php while (get_posts()) : the_post(); ?>

                <?php theme_include('content'); ?>

            <?php endwhile; ?>

            <?php echo posts_paging(); ?>

        <?php else: ?>

            <article class="no-found">
                <h1>Not Found.</h1>
            </article>

        <?php endif; ?>

    </div>

<?php theme_include('footer'); ?>