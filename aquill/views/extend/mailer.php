<?php partial('partials/header'); ?>

<section class="content container one-column">
    
    <?php echo $messages; ?>

    <div class="wrap">
        <article>
            <h1><?php _e('mailer.title'); ?></h1>

            <p><?php _e('mailer.description'); ?></p>
        </article>

        <form method="post" action="<?php echo url('admin/mailer'); ?>" autocomplete="off">
            
            <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
            
            <fieldset>
                <div class="control-group">
                    <label for="host" class="control-label"><?php _e('mailer.host'); ?></label>

                    <div class="controls">
                        <input placeholder="<?php _e('mailer.host_description'); ?>" id="host" type="text" name="smtp_host" value="<?php echo $smtp_host; ?>">
                    </div>
                </div>

                <div class="control-group">
                    <label for="port" class="control-label"><?php _e('mailer.port'); ?></label>

                    <div class="controls">
                        <input placeholder="<?php _e('mailer.port_description'); ?>" id="port" type="text" name="smtp_port" value="<?php echo $smtp_port; ?>">
                    </div>
                </div>

                <div class="control-group">
                    <label for="secure" class="control-label"><?php _e('mailer.secure'); ?></label>

                    <div class="controls">
                        <?php echo Form::select('smtp_secure', $secures, $smtp_secure); ?>
                    </div>
                </div>

                <div class="control-group">
                    <label for="auth" class="control-label"><?php _e('mailer.auth'); ?></label>

                    <div class="controls">
                        <label>
                            <input <?php echo $smtp_auth ? 'checked' : '' ; ?> id="auth" type="checkbox" name="smtp_auth" value="1">
                            <i><?php _e('mailer.auth_description'); ?></i>
                        </label>
                    </div>
                </div>

                <div class="control-group">
                    <label for="debug" class="control-label"><?php _e('mailer.debug'); ?></label>

                    <div class="controls">
                        <label>
                            <input <?php echo $smtp_debug ? 'checked' : '' ; ?> id="debug" type="checkbox" name="smtp_debug" value="1">
                            <i><?php _e('mailer.debug_description'); ?></i>
                        </label>
                    </div>
                </div>

                <div class="control-group">
                    <label for="user" class="control-label"><?php _e('mailer.user'); ?></label>

                    <div class="controls">
                        <input placeholder="<?php _e('mailer.user_description'); ?>" id="user" type="text" name="smtp_user" value="<?php echo $smtp_user; ?>">
                    </div>
                </div>

                <div class="control-group">
                    <label for="pass" class="control-label"><?php _e('mailer.pass'); ?></label>

                    <div class="controls">
                        <input placeholder="<?php _e('mailer.pass_description'); ?>" id="pass" type="text" name="smtp_pass" value="<?php echo $smtp_pass; ?>">
                    </div>
                </div>

                <section class="form-actions">
                    <button type="submit" class="btn"><?php _et('global.save'); ?></button>
                </section>
            </fieldset>
        </form>
    </div>
</section>
<?php partial('partials/footer'); ?>
