<aside id="search" class="widget widget-search">
    <h3 class="widget-title">Search Posts:</h3>
    <form class="searchform" method="POST" action="<?php echo url('admin/search/'.$type); ?>" accept-charset="UTF-8">
        <input placeholder="<?php _e($type.'.search_placeholder'); ?>" type="text" name="search">
        <button class="btn" type="submit"><span class="icon-search"></span></button>
    </form>
</aside>

<aside id="statuses" class="widget widget-statuses">
    <h3 class="icon-select"><?php _e($type.'.menu_title'); ?></h3>
</aside>