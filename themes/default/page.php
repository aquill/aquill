<?php theme_include('header'); ?>

    <div id="content">
        <article id="post-<?php echo page_id(); ?>" class="post">
            <div class="entry-header">
                <h1 class="entry-title">
                    <a href="<?php echo page_link(); ?>" rel="bookmark"><?php echo page_title(); ?></a>
                </h1>
            </div>

            <div class="entry-content">
                <?php echo page_content(); ?>
            </div>
        </article>
    </div>

<?php theme_include('footer'); ?>