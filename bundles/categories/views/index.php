<?php admin_include('header'); ?>

    <div id="sidebar" class="sidebar">
        <?php admin_include('search'); ?>
        <aside id="categorylist" class="widget widget-list">
            <h3 class="widget-title">All Categories</h3>
            <ul class="list">
                <?php foreach ($categories->results as $category) : ?>
                    <li class="post" id="post-<?php echo $category->id; ?>">
                        <a <?php echo Input::get('id', 0) == $category->id ? 'class="active"' : ''; ?>
                            href="<?php echo url('admin/categories?id=' . $category->id); ?>">
                            <strong><?php echo $category->title; ?></strong>
                            <time><?php echo $category->slug; ?></time>
                            <em class="status"><?php echo $category->slug; ?></em>
                        </a>
                    </li>
                <?php endforeach; ?>
                <?php if (Category::count() > 20): ?>
                    <li class="load-more" type="categories" page-num="2"><span>Load more categories</span></li>
                <?php endif; ?>
            </ul>
            <?php //echo $categories->links(); ?>
        </aside>
    </div>

    <div id="main" class="container">
        <?php echo $messages; ?>
        <?php echo $formdata; ?>
    </div>

<?php admin_include('footer'); ?>