<div class="wrap">
    <hgroup>
        <h1><?php echo $comment->id ? __('comment.edit', array('name' => $comment->name)) : __('comment.add'); ?></h1>
    </hgroup>
    <form class="commentform" method="POST"
          action="<?php echo $comment->id ? url("admin/comments/edit/{$comment->id}") : url("admin/comments/new"); ?>"
          accept-charset="UTF-8">

        <fieldset class="split">
            <div class="control-group">
                <label for="name" class="control-label"><?php _e('comment.name'); ?></label>

                <div class="controls">
                    <input placeholder="<?php _e('comment.name_placeholder'); ?>" type="text" name="name"
                           value="<?php echo $comment->name; ?>">
                </div>
            </div>
            <div class="control-group">
                <label for="email" class="control-label"><?php _e('comment.email'); ?></label>

                <div class="controls">
                    <input placeholder="<?php _e('comment.email_placeholder'); ?>" type="text" name="email"
                           value="<?php echo $comment->email; ?>">
                </div>
            </div>
            <div class="control-group">
                <label for="url" class="control-label"><?php _e('comment.url'); ?></label>

                <div class="controls">
                    <input placeholder="<?php _e('comment.url_placeholder'); ?>" type="text" name="url"
                           value="<?php echo $comment->url; ?>">
                </div>
            </div>
            <div class="control-group">
                <label for="status" class="control-label"><?php _e('comment.status'); ?></label>

                <div class="controls">
                    <?php echo Form::select('status', $statuses, $comment->status); ?>
                </div>
            </div>
            <div class="control-group">
                <label for="text" class="control-label"><?php _e('comment.comment'); ?></label>

                <div class="controls">
                    <textarea placeholder="<?php _e('comment.comment_placeholder'); ?>" name="text" rows="3"
                              cols="60"><?php echo $comment->content; ?></textarea>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn green"><?php _e('global.update'); ?></button>
                <a class="btn red"
                   href="<?php echo url('admin/comment/delete/' . $comment->id); ?>"><?php _e('global.delete'); ?></a>
            </div>
        </fieldset>
    </form>
</div>

<?php echo Form::close(); ?>