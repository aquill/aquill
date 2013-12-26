<div class="wrap">
    <hgroup>
        <h1><?php echo $user->id ? sprintf('Editing %s\'s Profile', $user->username) : __('Add User'); ?></h1>
    </hgroup>
    <form class="userform" method="POST" 
     action="<?php echo $post->id ? URL::to_action("users::edit/{$user->id}") : URL::to_action("users::new"); ?>"
     accept-charset="UTF-8">
        <fieldset class="split">
            <div class="control-group  width-60">
                <label for="real_name" class="control-label">Real Name</label>

                <div class="controls">
                    <input placeholder="Real Name" type="text" name="real_name" value="<?php echo $user->real_name; ?>">
                </div>
            </div>
            <div class="control-group width-80">
                <label for="bio" class="control-label">Bio</label>

                <div class="controls">
                    <textarea placeholder="Bio" name="bio" rows="10" cols="50"><?php echo $user->bio; ?></textarea>
                </div>
            </div>
            <div class="control-group width-50">
                <label for="status" class="control-label">Status</label>

                <div class="controls">
                    <?php echo Form::select('status', $statuses, $user->status); ?>
                </div>
            </div>
            <div class="control-group width-50">
                <label for="role" class="control-label">Role</label>

                <div class="controls">
                    <?php echo Form::select('role', $roles, $user->role); ?>
                </div>
            </div>
            <div class="control-group width-60">
                <label for="username" class="control-label">Username</label>

                <div class="controls">
                    <input placeholder="Username" type="text" name="username"
                           value="<?php echo $user->username; ?>">
                </div>
            </div>
            <div class="control-group width-60">
                <label for="password" class="control-label">Password</label>

                <div class="controls">
                    <input type="password" name="password">
                </div>
            </div>
            <div class="control-group width-60">
                <label for="email" class="control-label">Email</label>

                <div class="controls">
                    <input placeholder="Email" type="text" name="email" value="<?php echo $user->email; ?>">
                </div>
            </div>
            <div class="form-actions">
                <button class="btn" type="submit">Save</button>
            </div>
        </fieldset>
    </form>
</div>