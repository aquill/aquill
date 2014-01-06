<?php partial('partials/header'); ?>
<div class="container dashboard">
    <div class="wrap">
        <?php $variable = array(
            'blog' => array('posts', 'tags', 'comments', 'users', 'media'),
            'settings' => array('general', 'urls', 'mailer', 'themes', 'bundles'),
        ); foreach ($variable as $key => $items) : ?>
            <dl>
                <dt><?php _e('dashboard.'.$key); ?></dt>
                <?php foreach ($items as $item) : ?>
                    <dd>
                        <a class="icon-<?php echo $item; ?>" href="<?php echo url('admin/'.$item) ?>"><?php _e('dashboard.'.$item); ?></a>
                    </dd>
                <?php endforeach; ?>
            </dl>
        <?php endforeach; ?>
    </div>
</div>
<?php partial('partials/footer'); ?>