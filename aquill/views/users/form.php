<form class="userform" method="POST"
      action="<?php echo $user->id ? url("admin/users/edit/{$user->id}") : url("admin/users/new"); ?>"
      accept-charset="UTF-8">

    <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
    <input type="hidden" name="id" value="<?php echo $user->id; ?>">

    <fieldset class="header">
        <div class="wrap">
            <h1><?php echo $user->id ? __('user.edit', array('username' => $user->username)) : __('user.add'); ?></h1>
            <aside class="form-actions buttons">
                <button type="submit" class="btn green">
                    <span class="icon-save"></span>
                    <?php //_e('global.update'); ?></button>
                <a class="button red delete"
                   href="<?php echo url('admin/users/delete/' . $user->id); ?>">
                   <span class="icon-delete"></span>
                   <?php //_e('global.delete'); ?></a>
            </aside>
        </div>
    </fieldset>

    <?php echo $messages; ?>

    <fieldset class="split">
        <div class="wrap">
            <div class="control-group">
                <label for="username" class="control-label"><?php _e('user.username'); ?></label>

                <div class="controls">
                    <input <?php echo $user->id ? 'readonly="readonly"' : '' ; ?> placeholder="username" type="text" name="username" value="<?php echo $user->username; ?>">
                    <i class="info"><?php _e('user.username_description'); ?></i>
                </div>
            </div>
            <div class="control-group">
                <label for="bio" class="control-label"><?php _e('user.bio'); ?></label>

                <div class="controls" style="line-height:0">
                    <textarea name="bio" rows="3" cols="50"
                              placeholder="<?php _e('user.bio_description'); ?>"><?php echo $user->bio; ?></textarea>
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
                <label for="url" class="control-label"><?php _e('user.url'); ?></label>

                <div class="controls">
                    <input placeholder="<?php _e('user.url_description'); ?>" type="text" name="url"
                           value="<?php echo $user->url; ?>">
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
        </div>
    </fieldset>
</form>
