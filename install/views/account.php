<?php partial('partials/header'); ?>

<section class="content">

    <article>
        <h1><?php _et('account.title'); ?></h1>

        <p><?php _et('account.description'); ?></p>
    </article>

    <form method="post" action="<?php echo url('account'); ?>" autocomplete="off">
        <?php echo $messages; ?>
        <?php echo Form::token(); ?>
        <fieldset>
            <div class="control-group">
                <label for="username" class="control-label"><?php _et('account.username'); ?></label>

                <div class="controls">
                    <input tabindex="1" id="username" name="username" value="<?php echo $username; ?>">
                    <i class="info"><?php _et('account.username_description'); ?></i>
                </div>
            </div>

            <div class="control-group">
                <label for="email" class="control-label"><?php _et('account.email'); ?></label>

                <div class="controls">
                    <input tabindex="2" id="email" type="email" name="email" value="<?php echo $email; ?>">
                    <i class="info"><?php _et('account.email_description'); ?></i>
                </div>
            </div>

            <div class="control-group">
                <label for="password" class="control-label"><?php _et('account.password'); ?></label>

                <div class="controls">
                    <input tabindex="3" id="password" name="password" type="password" value="<?php echo $password; ?>">
                    <i class="info"><?php _et('account.password_description'); ?></i>
                </div>
            </div>
        </fieldset>

        <section class="form-actions">
            <a href="<?php echo url('rewrite'); ?>" class="btn quiet"><?php _et('install.back'); ?></a>
            <button type="submit" class="btn"><?php _et('install.complete'); ?></button>
        </section>
    </form>
</section>

<?php partial('partials/footer'); ?>
