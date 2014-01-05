<?php partial('partials/header'); ?>

    <section class="content small">
        <article>
            <h1><?php _et('complete.title'); ?></h1>
        <?php if ($htaccess): ?>
            <p class="code"><?php _et('complete.not_write'); ?></p>
                <p><textarea id="htaccess"><?php echo $htaccess; ?></textarea></p>
        <?php endif; ?>
         <p class="options">
            <a href="<?php echo $admin_url; ?>" class="btn"><?php _et('complete.visit_admin'); ?></a>
            <a href="<?php echo $site_url; ?>" class="btn"><?php _et('complete.visit_site'); ?></a>
        </p>
        </article>
    </section>

<?php partial('partials/footer'); ?>
