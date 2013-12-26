<div id="sidebar" class="sidebar">

    <?php admin_include('search'); ?>

    <aside id="postlist" class="widget widget-list">
        <h3 class="widget-title">Extend</h3>
        <ul class="list">
            <?php /*$variable = array(
                    'settings' => 'Settings',
                    'themes' => 'Themes',
                    'modules' => 'Modules',
                ); foreach ($variable as $key => $value): */
            ?>
            <li class="post">
                <a <?php echo is_page('settings') ? 'class="active" ' : ' '; ?>href="<?php echo url('admin/settings'); ?>">
                    <strong>Settings</strong>
                    <time>Site</time>
                </a>
            </li>
            <li class="post">
                <a <?php echo is_page('themes') ? 'class="active" ' : ' '; ?>href="<?php echo url('admin/themes'); ?>">
                    <strong>Themes</strong>
                    <time>Site</time>
                </a>
            </li>
            <li class="post">
                <a <?php echo is_page('bundles') ? 'class="active" ' : ' '; ?>href="<?php echo url('admin/bundles'); ?>">
                    <strong>Bundles</strong>
                    <time>Site</time>
                </a>
            </li>
        </ul>
    </aside>
</div>