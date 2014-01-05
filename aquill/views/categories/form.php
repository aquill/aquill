<form class="categoryform" method="POST"
      action="<?php echo $category->id ? url("admin/categories/edit/{$category->id}") : url("admin/categories/new"); ?>"
      accept-charset="UTF-8">

    <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
    <input type="hidden" name="id" value="<?php echo $category->id; ?>">

    <fieldset class="header">
        <div class="wrap">
            <h1><?php echo $category->id ? __('category.edit', array('name' => $category->name)) : __('category.add'); ?></h1>
            <aside class="form-actions buttons">
                <button type="submit" class="btn green">
                    <span class="icon-save"></span>
                    <?php //_e('global.update'); ?></button>
                <a class="button delete red"
                   href="<?php echo url('admin/categories/delete/' . $category->id); ?>">
                   <span class="icon-delete"></span>
                   <?php //_e('global.delete'); ?></a>
            </aside>
        </div>
    </fieldset>

    <?php echo $messages; ?>

    <fieldset class="split">
        <div class="wrap">
            <div class="control-group">
                <label class="control-label" for="name"><?php _e('category.name'); ?></label>

                <div class="controls">
                    <input placeholder="<?php _e('category.name'); ?>" name="name" id="name" type="text"
                           value="<?php echo $category->name; ?>"/>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="slug"><?php _e('category.slug'); ?></label>

                <div class="controls">
                    <input placeholder="<?php _e('category.slug'); ?>" name="slug" id="slug" type="text"
                           value="<?php echo $category->slug(); ?>"/>
                </div>
            </div>

            <div class="control-group">
                <label for="description" class="control-label"><?php _e('category.description'); ?></label>

                <div class="controls">
                    <textarea placeholder="<?php _e('category.description'); ?>" name="description" rows="3"
                              cols="50"><?php echo $category->description; ?></textarea>
                </div>
            </div>
        </div>
    </fieldset>

</form>
