<form id="postform-<?php echo $post->id; ?>" class="postform" method="POST" 
    action="<?php echo $post->id ? URL::to_action("posts::edit/{$post->id}") : URL::to_action("posts::new"); ?>"
    accept-charset="UTF-8">

    <fieldset class="meta split">
        <div class="wrap">
            <div class="control-group width-60">
                <label class="control-label" for="slug">Slug</label>

                <div class="controls">
                    <input placeholder="Slug" type="text" name="slug"
                           value="<?php echo urldecode($post->slug); ?>" id="slug"/>
                </div>
            </div>
            <div class="control-group width-50">
                <label class="control-label" for="created">Date</label>

                <div class="controls">
                    <input type="text" name="created" id="created"
                           value="<?php echo urldecode($post->created); ?>"/>
                </div>
            </div>
            <div class="control-group width-50">
                <label class="control-label" for="status">Statuses</label>

                <div class="controls">
                    <?php echo Form::select('status', $statuses, $post->status); ?>
                </div>
            </div>
            <div class="control-group width-40">
                <label class="control-label" for="category">Category</label>

                <div class="controls">
                    <?php echo Form::select('category', $categories, $post->category); ?>
                </div>
            </div>
            <div class="control-group width-60">
                <label class="control-label" for="comments">Comment</label>

                <div class="controls">
                    <label><?php echo Form::checkbox('comments', 1, $post->comments); ?>Comment for
                        the post.</label>
                </div>
            </div>
            <div class="control-group width-80">
                <label class="control-label" for="desc">Description</label>

                <div class="controls">
                    <textarea name="desc"><?php echo $post->description; ?></textarea>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset class="header">
        <div class="wrap">
            <div class="controls">
                <input placeholder="Enter title here" type="text" name="title" value="<?php echo $post->title; ?>">
            </div>
            <aside class="buttons">
                <button class="btn blue toggle" toggle-object="meta" type="button">More Settings</button>
                <button class="btn green" type="submit">Save</button>
                <button class="btn red toggle" toggle-object="meta" type="button">Preview</button>
            </aside>
        </div>
    </fieldset>

    <fieldset class="preview html" id="markdown-preview"></fieldset>

    <fieldset class="editor">
        <div class="wrap">
            <textarea placeholder="Write something..." id="markdown-input" class="textarea-resize"
                      data-markdown-preview="#markdown-preview" name="html" rows="10" cols="50"
                ><?php echo $post->html; ?></textarea>
        </div>
    </fieldset>

</form>
