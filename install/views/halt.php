<?php partial('partials/header'); ?>

    <section class="content">
        <article>
            <h1><?php _ei('install.halt'); ?></h1>
            <p><?php echo $messages; ?></p>
            <p>好像你已经安装过了，重新安装请<a href="<?php echo urlencode('start'); ?>"><?php _ei('install.again'); ?></a></p>
        </article>
    </section>

<?php partial('partials/footer'); ?>
