<?php install_include('header'); ?>

    <section class="content">
        <article>
            <h1>Your database details</h1>

            <p>Firstly, we’ll need a database. Anchor needs them to store all of your blog’s information, so it’s vital
                you fill these in correctly. If you don’t know what these are, you’ll need to contact your webhost.</p>
        </article>

        <form method="post" action="<?php echo URL::to('database'); ?>" autocomplete="off">
            <?php echo $messages; ?>
            <?php echo Form::token(); ?>
            <input type="hidden" name="charset" value="utf8">
            <fieldset>
                <p>
                    <label for="driver">Driver</label>
                    <select name="driver" id="driver">
                        <option value="mysql">Mysqsl</option>
                        <option value="sqlite">Sqlite</option>
                        <option value="pgsql">Pgsql</option>
                    </select>
                </p>
                <p>
                    <label for="host">Database Host</label>
                    <input id="host" name="host" value="<?php echo $host; ?>">

                    <i>Most likely <b>localhost</b> or <b>127.0.0.1</b>.</i>
                </p>

                <p>
                    <label for="port">Port</label>
                    <input id="port" name="port" value="<?php echo $port; ?>">

                    <i>Usually <b>3306</b>.</i>
                </p>

                <p>
                    <label for="username">Username</label>
                    <input id="username" name="username" value="<?php echo $username; ?>">

                    <i>The database user, usually <b>root</b>.</i>
                </p>

                <p>
                    <label for="password">Password</label>
                    <input id="password" name="password" value="<?php echo $password; ?>">

                    <i>Leave blank for empty password.</i>
                </p>

                <p>
                    <label for="database">Database Name</label>
                    <input id="database" name="database" value="<?php echo $database; ?>">

                    <i>Your database’s name.</i>
                </p>

                <p>
                    <label for="prefix">Table Prefix</label>
                    <input id="prefix" name="prefix" value="<?php echo $prefix; ?>">

                    <i>Database table name prefix.</i>
                </p>

                <p>
                    <label for="collation">Collation</label>
                    <select id="collation" name="collation">
                        <?php foreach ($collations as $code => $collation): ?>
                            <?php $selected = ($code == 'utf8_general_ci') ? ' selected' : ''; ?>
                            <option value="<?php echo $code; ?>" <?php echo $selected; ?>>
                                <?php echo $code; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <i>Change if <b>utf8_general_ci</b> doesn’t work.</i>
                </p>
            </fieldset>

            <section class="options">
                <a href="<?php echo URL::to('start'); ?>" class="btn quiet">&laquo; Back</a>
                <button type="submit" class="btn">Next Step &raquo;</button>
            </section>
        </form>
    </section>

<?php install_include('footer'); ?>