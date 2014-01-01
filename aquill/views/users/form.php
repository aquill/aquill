<div class="wrap">
    <hgroup>
        <h1><?php echo $user->id ? __('user.edit', array('username' => $user->username)) : __('user.add'); ?></h1>
    </hgroup>
    <form class="userform" method="POST"
          action="<?php echo $post->id ? url("admin/users/edit/{$user->id}") : url("admin/users/new"); ?>"
          accept-charset="UTF-8">
        <fieldset class="split">
            <div class="control-group">
                <label for="username" class="control-label"><?php echo __('user.username'); ?></label>

                <div class="controls">
                    <input placeholder="username" type="text" name="username" value="<?php echo $user->username; ?>">
                    <i><?php echo __('user.username_description'); ?></i>
                </div>
            </div>
            <div class="control-group">
                <label for="bio" class="control-label"><?php echo __('user.bio'); ?></label>

                <div class="controls" style="line-height:0">
                    <textarea name="bio" rows="3" cols="50"><?php echo $user->bio; ?></textarea>
                    <i><?php echo __('user.bio_description'); ?></i>
                </div>
            </div>
            <div class="control-group">
                <label for="role" class="control-label"><?php echo __('user.role'); ?></label>

                <div class="controls">
                    <?php echo Form::select('role', $roles, $user->role); ?>
                </div>
            </div>
            <div class="control-group">
                <label for="nicename" class="control-label"><?php echo __('user.nicename'); ?></label>

                <div class="controls">
                    <input placeholder="nicename" type="text" name="nicename"
                           value="<?php echo $user->nicename; ?>">
                    <i><?php echo __('user.nicename_description'); ?></i>
                </div>
            </div>
            <div class="control-group">
                <label for="password" class="control-label"><?php echo __('user.password'); ?></label>

                <div class="controls">
                    <input type="password" name="password">
                    <i><?php echo __('user.password_description'); ?></i>
                </div>
            </div>
            <div class="control-group">
                <label for="confirm" class="control-label"><?php echo __('user.confirm'); ?></label>

                <div class="controls">
                    <input type="password" name="confirm">
                    <i><?php echo __('user.confirm_description'); ?></i>
                </div>
            </div>
            <div class="control-group">
                <label for="email" class="control-label"><?php echo __('user.email'); ?></label>

                <div class="controls">
                    <input placeholder="Email" type="text" name="email" value="<?php echo $user->email; ?>">
                    <i><?php echo __('user.email_description'); ?></i>
                </div>
            </div>
            <div class="form-actions">
                <button class="btn" type="submit"><?php echo __('global.save'); ?></button>
            </div>
        </fieldset>
    </form>
</div>