<div class="wrap">
    <hgroup>
        <h1><?php echo $comment->id ? sprintf('Editing %s\'s Comment', $comment->name) : __('Add Comment'); ?></h1>
    </hgroup>
    <form class="commentform" method="POST"
          action="<?php echo $comment->id ? URL::to_action("comments::edit/{$comment->id}") : URL::to_action("comments::new"); ?>"
          accept-charset="UTF-8">

        <fieldset class="split">
            <div class="control-group width-60">
                <label for="name" class="control-label">Real Name</label>

                <div class="controls">
                    <input placeholder="Name" type="text" name="name" value="<?php echo $comment->name; ?>">
                </div>
            </div>
            <div class="control-group width-60">
                <label for="email" class="control-label">Email</label>

                <div class="controls">
                    <input placeholder="Email" type="text" name="email" value="<?php echo $comment->email; ?>">
                </div>
            </div>
            <div class="control-group width-60">
                <label for="url" class="control-label">Website</label>

                <div class="controls">
                    <input placeholder="Website" type="text" name="url" value="<?php echo $comment->url; ?>">
                </div>
            </div>
            <div class="control-group width-50">
                <label for="status" class="control-label">Statuses</label>

                <div class="controls">
                    <?php echo Form::select('status', $statuses, $comment->status); ?>
                </div>
            </div>
            <div class="control-group width-80">
                <label for="text" class="control-label">Comment</label>

                <div class="controls">
                    <textarea placeholder="Comment" name="text" rows="10"
                              cols="50"><?php echo $comment->text; ?></textarea>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn green">Update</button>
                <a class="btn red" href="<?php echo url('admin/category/' . $comment->id); ?>">Delete</a>
            </div>
        </fieldset>
    </form>
</div>

<?php echo Form::close(); ?>