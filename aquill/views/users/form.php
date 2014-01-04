<div class="wrap">
    <hgroup>
        <h1><?php echo $user->id ? __('user.edit', array('username' => $user->username)) : __('user.add'); ?></h1>
    </hgroup>
    <form class="userform" method="POST"
          action="<?php echo $post->id ? url("admin/users/edit/{$user->id}") : url("admin/users/new"); ?>"
          accept-charset="UTF-8">
        <fieldset class="split">
            <div class="control-group">
                <label for="username" class="control-label"><?php _e('user.username'); ?></label>

                <div class="controls">
                    <input placeholder="username" type="text" name="username" value="<?php echo $user->username; ?>">
                    <i class="info"><?php _e('user.username_description'); ?></i>
                </div>
            </div>
            <div class="control-group">
                <label for="bio" class="control-label"><?php _e('user.bio'); ?></label>

                <div class="controls" style="line-height:0">
                    <textarea name="bio" rows="3" cols="50" placeholder="<?php _e('user.bio_description'); ?>"><?php echo $user->bio; ?></textarea>
                </div>
            </div>
            <div class="control-group">
                <label for="role" class="control-label"><?php _e('user.role'); ?></label>

                <div class="controls">
                    <?php echo Form::select('role', $roles, $user->role); ?>
                </div>
            </div>
            <div class="control-group">
                <label for="nicename" class="control-label"><?php _e('user.nicename'); ?></label>

                <div class="controls">
                    <input placeholder="nicename" type="text" name="nicename"
                           value="<?php echo $user->nicename; ?>">
                    <i class="info"><?php _e('user.nicename_description'); ?></i>
                </div>
            </div>
            <div class="control-group">
                <label for="password" class="control-label"><?php _e('user.password'); ?></label>

                <div class="controls">
                    <input type="password" name="password" placeholder="<?php _e('user.password_description'); ?>">
                </div>
            </div>
            <div class="control-group">
                <label for="confirm" class="control-label"><?php _e('user.confirm'); ?></label>

                <div class="controls">
                    <input type="password" name="confirm" placeholder="<?php _e('user.confirm_description'); ?>">
                </div>
            </div>
            <div class="control-group">
                <label for="email" class="control-label"><?php _e('user.email'); ?></label>

                <div class="controls">
                    <input placeholder="Email" type="text" name="email" value="<?php echo $user->email; ?>">
                    <i class="info"><?php _e('user.email_description'); ?></i>
                </div>
            </div>
            <div class="form-actions">
                <button class="btn" type="submit"><?php _e('global.save'); ?></button>
            </div>
        </fieldset>
    </form>
</div>