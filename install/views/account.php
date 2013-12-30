<?php install_include('header'); ?>

<section class="content">

    <article>
        <h1><?php echo __('account.title'); ?></h1>

        <p><?php echo __('account.description'); ?></p>
    </article>

    <form method="post" action="<?php echo url('account'); ?>" autocomplete="off">
        <?php echo $messages; ?>
        <?php echo Form::token(); ?>
        <fieldset>
            <div class="control-group">
                <label for="username" class="control-label"><?php echo __('account.username'); ?></label>

                <div class="controls">
                    <input tabindex="1" id="username" name="username" value="<?php echo $username; ?>">
                    <i><?php echo __('account.username_description'); ?></i>
                </div>
            </div>

            <div class="control-group">
                <label for="email" class="control-label"><?php echo __('account.email'); ?></label>

                <div class="controls">
                    <input tabindex="2" id="email" type="email" name="email" value="<?php echo $email; ?>">
                    <i><?php echo __('account.email_description'); ?></i>
                </div>
            </div>

            <div class="control-group">
                <label for="password" class="control-label"><?php echo __('account.password'); ?></label>

                <div class="controls">
                    <input tabindex="3" id="password" name="password" type="password" value="<?php echo $password; ?>">
                    <i><?php echo __('account.password_description'); ?></i>
                </div>
            </div>
        </fieldset>

        <section class="form-actions">
            <a href="<?php echo url('rewrite'); ?>" class="btn quiet"><?php echo __('install.back'); ?></a>
            <button type="submit" class="btn"><?php echo __('install.complete'); ?></button>
        </section>
    </form>
</section>

<?php install_include('footer'); ?>
