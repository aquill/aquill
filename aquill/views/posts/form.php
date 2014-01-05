<form id="postform-<?php echo $post->id; ?>" class="postform" method="POST"
      action="<?php echo $post->id ? url("admin/posts/edit/{$post->id}") : url("admin/posts/new"); ?>"
      accept-charset="UTF-8">
    <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
    <input type="hidden" name="id" value="<?php echo $post->id; ?>">
    <input type="hidden" name="author" value="<?php echo $post->author; ?>">

    <fieldset class="meta split">
        <div class="wrap">
            <div class="control-group">
                <label class="control-label" for="slug"><?php _e('post.slug'); ?></label>

                <div class="controls">
                    <input type="text" name="slug" value="<?php echo urldecode($post->slug()); ?>"
                           id="slug" placeholder="<?php _e('post.slug_placeholder'); ?>"/>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="created_at"><?php _e('post.date'); ?></label>

                <div class="controls">
                    <input type="text" class="datetime" name="created_at" id="created_at"
                           value="<?php echo $post->date(); ?>"/>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="status"><?php _e('post.statuses'); ?></label>

                <div class="controls">
                    <?php echo Form::select('status', $statuses, $post->status); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="category"><?php _e('post.categories'); ?></label>

                <div class="controls">
                    <?php echo Form::select('category[]', $categories, $post->cids(), array('multiple' => 'multiple')); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="excerpt"><?php _e('post.excerpt'); ?></label>

                <div class="controls" style="line-height:0">
                    <textarea name="excerpt" id="excerpt"
                              placeholder="<?php _e('post.excerpt_description'); ?>"><?php echo $post->excerpt; ?></textarea>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="comment_status"><?php _e('post.comment_status'); ?></label>

                <div class="controls">
                    <label>
                        <?php echo Form::checkbox('comment_status', 1, $post->comment_status); ?>
                        <?php _e('post.comment_status_label'); ?>
                    </label>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset class="header">
        <aside class="buttons">
            <div class="wrap">
                <button class="btn green" type="submit">
                    <span class="icon-save"></span>
                    <?php //_e('global.save'); ?></button>
                <button class="btn red toggle" toggle-object="meta" type="button">
                    <span class="icon-trash"></span>
                    <?php //_e('post.more_settings'); ?></button>
                <button class="btn blue toggle" toggle-object="meta" type="button">
                    <span class="icon-preview"></span>
                    <?php //_e('global.preview'); ?></button>
                <button class="btn blue toggle settings" toggle-object="editorbar" type="button">
                    <span class="icon-font"></span>
                    <?php //_e('post.more_settings'); ?></button>
                <button class="btn blue toggle settings" toggle-object="meta" type="button">
                    <span class="icon-settings"></span>
                    <?php //_e('post.more_settings'); ?></button>
            </div>
        </aside>
        <aside class="editorbar">
            <ul>
                <li class="icon-editor-bold"></li>
                <li class="icon-editor-underline"></li>
                <li class="icon-editor-italic"></li>
                <li class="vertical"></li>
                <li class="icon-editor-ordered-list"></li>
                <li class="icon-editor-unordered-list"></li>
                <li class="vertical"></li>
                <li class="icon-editor-quote"></li>
                <li class="icon-editor-code"></li>
                <li class="vertical"></li>
                <li class="icon-editor-link"></li>
                <li class="icon-editor-unlink"></li>
                <li class="vertical"></li>
                <li class="icon-editor-nextpage"></li>
                <li class="icon-editor-more"></li>
            </ul>
        </aside>
    </fieldset>

    <?php echo $messages; ?>

    <fieldset class="preview html" id="markdown-preview"></fieldset>

    <fieldset class="editor">
        <div class="wrap">
            <input placeholder="<?php _e('post.title_placeholder'); ?>" type="text" name="title"
                   value="<?php echo $post->title; ?>">
            <textarea placeholder="<?php _e('post.content_placeholder'); ?>" id="markdown-input"
                      class="textarea-resize"
                      data-markdown-preview="#markdown-preview" name="content" rows="10" cols="50"
                ><?php echo $post->content; ?></textarea>
        </div>
    </fieldset>

</form>
