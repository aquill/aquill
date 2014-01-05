<div id="sidebar" class="sidebar">
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
                <a <?php echo uri_has('settings') ? 'class="active" ' : ' '; ?>href="<?php echo url('admin/settings'); ?>">
                    <strong>Settings</strong>
                    <time>Site</time>
                </a>
            </li>
            <li class="post">
                <a <?php echo uri_has('themes') ? 'class="active" ' : ' '; ?>href="<?php echo url('admin/themes'); ?>">
                    <strong>Themes</strong>
                    <time>Site</time>
                </a>
            </li>
            <li class="post">
                <a <?php echo uri_has('bundles') ? 'class="active" ' : ' '; ?>href="<?php echo url('admin/bundles'); ?>">
                    <strong>Bundles</strong>
                    <time>Site</time>
                </a>
            </li>
            <li class="post">
                <a <?php echo uri_has('migrations') ? 'class="active" ' : ' '; ?>href="<?php echo url('admin/migrations'); ?>">
                    <strong>Migrations</strong>
                    <time>Site</time>
                </a>
            </li>
        </ul>
    </aside>
</div>