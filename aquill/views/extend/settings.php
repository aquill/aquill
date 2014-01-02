<?php partial('partials/header'); ?>

<?php partial('extend/sidebar'); ?>

    <div class="container">
        <div class="wrap">
            <hgroup>
                <h1>Settings</h1>
            </hgroup>

            <form method="post" action="<?php echo url('admin/settings'); ?>" novalidate="">

                <fieldset class="split">

                    <div class="control-group">
                        <label for="sitename" class="control-label">Site name</label>

                        <div class="controls">
                            <input type="text" name="sitename" value="<?php echo $site_title; ?>"></p>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="" class="control-label">Site description</label>

                        <div class="controls">
                            <textarea name="description" rows="3" cols="50"><?php echo $site_description; ?></textarea>
                        </div>
                    </div>


                    <div class="control-group">
                        <label for="home_page" class="control-label">Home Page</label>

                        <div class="controls">
                            <select name="home_page">
                                <option value="1" selected="selected">Posts</option>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="posts_per_page" class="control-label">Posts per page</label>

                        <div class="controls">
                            <input type="text" value="20">
                        </div>
                    </div>

                </fieldset>

                <fieldset class="split">
                    <legend>Comments</legend>

                    <div class="control-group">
                        <label for="allow" class="control-label">Allow comments</label>

                        <div class="controls">
                            <label><input id="auto_published_comments" name="auto_published_comments" class="icon-on"
                                          type="checkbox"
                                          value="1" checked="">Allow people to post comments on new articles</label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="comment_notifications" class="control-label">Email notification</label>

                        <div class="controls">
                            <label><input id="comment_notifications" name="comment_notifications" type="checkbox"
                                          value="1" checked="">Email notification for new comments</label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="comment_moderation_keys" class="control-label">Spam keywords</label>

                        <div class="controls">
                            <textarea name="comment_moderation_keys" rows="3" cols="50"></textarea>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn">Save</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

<?php partial('partials/footer'); ?>