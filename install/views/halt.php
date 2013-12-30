<?php install_include('header'); ?>

    <section class="content">
        <article>
            <h1><?php echo __('install.halt'); ?></h1>
            <p><?php echo $messages; ?></p>
            <p><a href="<?php echo current_url(); ?>"><?php echo __('install.again'); ?></a></p>
        </article>
    </section>

<?php install_include('footer'); ?>
