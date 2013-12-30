<?php foreach ($categories->results as $category) : ?>
    <li class="post" id="post-<?php echo $category->id; ?>">
        <a <?php echo Input::get('id', 0) == $category->id ? 'class="active"' : ''; ?>
            href="<?php echo url('admin/categories?id=' . $category->id); ?>">
            <strong><?php echo $category->name; ?></strong>
            <time><?php echo $category->slug; ?></time>
            <em class="status"><?php echo $category->slug; ?></em>
        </a>
    </li>
<?php endforeach; die(); ?>