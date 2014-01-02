<?php partial('partials/header'); ?>

    <section class="content">
        <article>
            <h1><?php _et('database.title'); ?></h1>
            <p><?php _et('database.description'); ?></p>
        </article>

        <form method="post" action="<?php echo url('database'); ?>" autocomplete="off">
            <?php echo $messages; ?>
            <?php echo Form::token(); ?>
            <input type="hidden" name="charset" value="utf8">
            <fieldset>
                <div class="control-group">
                    <label for="driver" class="control-label"><?php _et('database.driver'); ?></label>

                    <div class="controls">
                        <select name="driver" id="driver">
                            <option value="mysql">Mysqsl</option>
                            <option value="sqlite">Sqlite</option>
                            <option value="pgsql">Pgsql</option>
                        </select>
                        <i class="info"><?php _et('database.driver_description'); ?></i>
                    </div>
                </div>

                <div class="control-group">
                    <label for="host" class="control-label"><?php _et('database.host'); ?></label>

                    <div class="controls">
                        <input id="host" name="host" value="<?php echo $host; ?>">

                        <i class="info"><?php _et('database.host_description'); ?></i>
                    </div>
                </div>

                <div class="control-group">
                    <label for="port" class="control-label"><?php _et('database.port'); ?></label>

                    <div class="controls">
                        <input id="port" name="port" value="<?php echo $port; ?>">

                        <i class="info"><?php _et('database.port_description'); ?></i>
                    </div>
                </div>

                <div class="control-group">
                    <label for="username" class="control-label"><?php _et('database.username'); ?></label>

                    <div class="controls">
                        <input id="username" name="username" value="<?php echo $username; ?>">

                        <i class="info"><?php _et('database.username_description'); ?></i>
                    </div>
                </div>

                <div class="control-group">
                    <label for="password" class="control-label"><?php _et('database.password'); ?></label>

                    <div class="controls">
                        <input id="password" name="password" value="<?php echo $password; ?>">
                        <i class="info"><?php _et('database.password_description'); ?></i>
                    </div>
                </div>

                <div class="control-group">
                    <label for="database" class="control-label"><?php _et('database.database'); ?></label>

                    <div class="controls">
                        <input id="database" name="database" value="<?php echo $database; ?>">
                        <i class="info"><?php _et('database.database_description'); ?></i>
                    </div>
                </div>

                <div class="control-group">
                    <label for="prefix" class="control-label"><?php _et('database.prefix'); ?></label>

                    <div class="controls">
                        <input id="prefix" name="prefix" value="<?php echo $prefix; ?>">
                        <i class="info"><?php _et('database.prefix_description'); ?></i>
                    </div>
                </div>

                <div class="control-group">
                    <label for="collation" class="control-label"><?php _et('database.collation'); ?></label>

                    <div class="controls">
                        <select id="collation" name="collation">
                            <?php foreach ($collations as $code => $collation): ?>
                                <?php $selected = ($code == 'utf8_general_ci') ? ' selected' : ''; ?>
                                <option value="<?php echo $code; ?>" <?php echo $selected; ?>>
                                    <?php echo $code; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <i class="info"><?php _et('database.collation_description'); ?></i>
                    </div>
                </div>
            </fieldset>

            <section class="form-actions">
                <a href="<?php echo url('start'); ?>" class="btn quiet"><?php _et('install.back'); ?></a>
                <button type="submit" class="btn"><?php _et('install.next'); ?></button>
            </section>
        </form>
    </section>

<?php partial('partials/footer'); ?>