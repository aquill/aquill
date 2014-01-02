<div class="wrap">
    <hgroup>
        <h1><?php echo $category->id ? __('category.edit', array('name' => $category->name)) : __('category.add'); ?></h1>
    </hgroup>

    <form class="categoryform" method="POST"
          action="<?php echo $category->id ? url("admin/categories/edit/{$category->id}") : url("admin/categories/new"); ?>"
          accept-charset="UTF-8">

        <fieldset class="split">
            <div class="control-group">
                <label class="control-label" for="name"><?php _e('category.name'); ?></label>

                <div class="controls">
                    <input placeholder="Name" name="name" id="name" type="text"
                           value="<?php echo $category->name; ?>"/>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="slug"><?php _e('category.slug'); ?></label>

                <div class="controls">
                    <input placeholder="Slug" name="slug" id="slug" type="text"
                           value="<?php echo $category->slug(); ?>"/>
                </div>
            </div>

            <div class="control-group">
                <label for="description" class="control-label"><?php _e('category.description'); ?></label>

                <div class="controls">
                    <textarea placeholder="Description" name="description" rows="3"
                              cols="50"><?php echo $category->description; ?></textarea>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn green"><?php _e('global.update'); ?></button>
                <a class="btn red delete"
                   href="<?php echo url("admin/categories/delete/{$category->id}"); ?>"><?php _e('global.delete'); ?></a>
            </div>
        </fieldset>

    </form>
</div>