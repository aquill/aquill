<div class="wrap">
    <hgroup>
        <h1><?php echo $category->id ? sprintf('Editing %s\'s Category', $category->title) : __('Add Category'); ?></h1>
    </hgroup>

    <form class="categoryform" method="POST" action="<?php echo $category->id ? url("admin/categories/edit/{$category->id}") : url("admin/categories/new"); ?>"
          accept-charset="UTF-8">

        <fieldset class="split">
            <div class="control-group width-50">
                <label class="control-label" for="title">Title</label>

                <div class="controls">
                    <input placeholder="Title" name="title" id="title" type="text"
                           value="<?php echo $category->name; ?>"/>
                </div>
            </div>

            <div class="control-group width-50">
                <label class="control-label" for="slug">slug</label>

                <div class="controls">
                    <input placeholder="Slug" name="slug" id="slug" type="text"
                           value="<?php echo $category->slug; ?>"/>
                </div>
            </div>

            <div class="control-group width-70">
                <label for="description" class="control-label">Description</label>

                <div class="controls">
                    <textarea placeholder="Description" name="description" rows="10"
                              cols="50"><?php echo $category->description; ?></textarea>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn green">Update</button>
                <a class="btn red delete" href="<?php echo url("admin/categories/delete/{$category->id}"); ?>">Delete</a>
            </div>
        </fieldset>

    </form>
</div>