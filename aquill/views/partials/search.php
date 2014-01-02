<aside id="search" class="widget widget-search">
    <h3 class="widget-title">Search Posts:</h3>
    <form class="searchform" method="POST" action="<?php echo url('admin/search/'.$type); ?>" accept-charset="UTF-8">
        <input placeholder="<?php _e($type.'.search_placeholder'); ?>" type="text" name="search">
        <button class="btn" type="submit"><span class="icon-search"></span></button>
    </form>
</aside>

<aside id="tags" class="widget widget-tags">
    <h3>All Categories</h3>
</aside>