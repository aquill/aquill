<form id="postform-<?php echo $post->id; ?>" class="postform" method="POST"
      action="<?php echo $post->id ? url("admin/posts/edit/{$post->id}") : url("admin/posts/new"); ?>"
      accept-charset="UTF-8">

    <fieldset class="meta split">
        <div class="wrap">
            <div class="control-group">
                <label class="control-label" for="slug"><?php echo __('post.slug'); ?></label>

                <div class="controls">
                    <input placeholder="<?php echo __('post.slug_placeholder'); ?>" type="text" name="slug"
                           value="<?php echo urldecode($post->slug()); ?>" id="slug"/>
                    <i><?php echo __('post.slug_description'); ?></i>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="created"><?php echo __('post.date'); ?></label>

                <div class="controls">
                    <input type="text" name="created" id="created"
                           value="<?php echo $post->date(); ?>"/>
                    <i><?php echo __('post.date_description'); ?></i>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="status"><?php echo __('post.statuses'); ?></label>

                <div class="controls">
                    <?php echo Form::select('status', $statuses, $post->status); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="category"><?php echo __('post.categories'); ?></label>

                <div class="controls">
                    <?php echo Form::select('category', $categories, $post->category); ?>
                    <i><?php echo __('post.categories_description'); ?></i>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="desc"><?php echo __('post.excerpt'); ?></label>

                <div class="controls" style="line-height:0">
                    <textarea name="desc"><?php echo $post->excerpt; ?></textarea>
                    <i><?php echo __('post.excerpt_description'); ?></i>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="comments"><?php echo __('post.comment_status'); ?></label>

                <div class="controls">
                    <label>
                        <?php echo Form::checkbox('comments', 1, $post->comment_status); ?>
                        <?php echo __('post.comment_status_label'); ?>
                    </label>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset class="header">
        <div class="wrap">
            <div class="controls">
                <input placeholder="<?php echo __('post.title_placeholder'); ?>" type="text" name="title"
                       value="<?php echo $post->title; ?>">
            </div>
            <aside class="buttons">
                <button class="btn blue toggle" toggle-object="meta" type="button">
                    <?php echo __('post.more_settings'); ?></button>
                <button class="btn green" type="submit">
                    <?php echo __('global.save'); ?></button>
                <button class="btn red toggle" toggle-object="meta" type="button">
                    <?php echo __('global.preview'); ?></button>
            </aside>
        </div>
    </fieldset>

    <fieldset class="preview html" id="markdown-preview"></fieldset>

    <fieldset class="editor">
        <div class="wrap">
            <textarea placeholder="<?php echo __('post.content_placeholder'); ?>" id="markdown-input"
                      class="textarea-resize"
                      data-markdown-preview="#markdown-preview" name="html" rows="10" cols="50"
                ><?php echo $post->content; ?></textarea>
        </div>
    </fieldset>

</form>
