<?php partial('header'); ?>

<?php partial('extend/sidebar'); ?>

    <div id="main" class="container">
        <div class="wrap">
        <hgroup>
            <h1>Your database details</h1>

        </hgroup>

            <p>Firstly, we’ll need a database. Anchor needs them to store all of your blog’s information, so it’s vital
                you fill these in correctly. If you don’t know what these are, you’ll need to contact your webhost.</p>

        <form method="post" action="<?php echo url('admin/migrations'); ?>" autocomplete="off">
            <?php echo $messages; ?>
            <?php echo Form::token(); ?>
            <input type="hidden" name="charset" value="utf8">
            <fieldset>
                <div class="control-group">
                    <label for="blog" class="control-label">Blog Engine</label>
                    <div class="controls">
                    <select name="blog" id="blog">
                        <option value="wordpress">WordPress</option>
                        <option value="typecho">Typecho</option>
                        <option value="emlog">Emlog</option>
                        <option value="zblog">Zblog</option>
                        <option value="pjblog">PJblog</option>
                    </select>
                    </div>
                </div>
                <div class="control-group">
                    <label for="driver" class="control-label">Driver</label>
                    <div class="controls">
                    <select name="driver" id="driver">
                        <option value="mysql">Mysqsl</option>
                        <option value="sqlite">Sqlite</option>
                        <option value="pgsql">Pgsql</option>
                    </select>
                    </div>
                </div>
                <div class="control-group">
                    <label for="host" class="control-label">Database Host</label>
                    <div class="controls">
                    <input id="host" name="host" value="<?php echo $host; ?>">

                    <i>Most likely <b>localhost</b> or <b>127.0.0.1</b>.</i>
                    </div>
                </div>

                <div class="control-group">
                    <label for="port" class="control-label">Port</label>
                    <div class="controls">
                    <input id="port" name="port" value="<?php echo $port; ?>">

                    <i>Usually <b>3306</b>.</i>
                    </div>
                </div>

                <div class="control-group">
                    <label for="username" class="control-label">Username</label>
                    <div class="controls">
                    <input id="username" name="username" value="<?php echo $username; ?>">

                    <i>The database user, usually <b>root</b>.</i>
                    </div>
                </div>

                <div class="control-group">
                    <label for="password" class="control-label">Password</label>
                    <div class="controls">
                    <input id="password" name="password" value="<?php echo $password; ?>">

                    <i>Leave blank for empty password.</i>
                    </div>
                </div>

                <div class="control-group">
                    <label for="database" class="control-label">Database Name</label>
                    <div class="controls">
                    <input id="database" name="database" value="<?php echo $database; ?>">

                    <i>Your database’s name.</i>
                    </div>
                </div>

                <div class="control-group">
                    <label for="prefix" class="control-label">Table Prefix</label>
                    <div class="controls">
                    <input id="prefix" name="prefix" value="<?php echo $prefix; ?>">

                    <i>Database table name prefix.</i>
                    </div>
                </div>

                <div class="control-group">
                    <label for="collation" class="control-label">Collation</label>
                    <div class="controls">
                    <select id="collation" name="collation">
                        <?php foreach ($collations as $code => $collation): ?>
                            <?php $selected = ($code == 'utf8_general_ci') ? ' selected' : ''; ?>
                            <option value="<?php echo $code; ?>" <?php echo $selected; ?>>
                                <?php echo $code; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <i>Change if <b>utf8_general_ci</b> doesn’t work.</i>
                    </div>
                </div>
            </fieldset>

            <section class="form-actions">
                <a href="<?php echo url('start'); ?>" class="btn quiet">&laquo; Back</a>
                <button type="submit" class="btn">Next Step &raquo;</button>
            </section>
        </form>
        </div>
    </div>

<?php partial('footer'); ?>