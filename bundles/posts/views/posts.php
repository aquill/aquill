<?php foreach ($posts->results as $post) : ?>
    <li class="post" id="post-<?php echo $post->id; ?>">
        <a <?php echo Input::get('id', 0) == $post->id ? 'class="active"' : ''; ?>
            href="<?php echo url('admin/posts/' . $post->id); ?>">
            <strong><?php echo $post->title; ?></strong>
            <time><?php echo $post->created; ?></time>
        </a>
        <em class="status"><?php echo $post->status; ?></em>
        <ul class="statuses">
            <li>published</li>
            <li>Draft</li>
            <li><a class="delete" href="<?php echo url('admin/post/' . $post->id); ?>">Delete</a></li>
        </ul>
    </li>
<?php endforeach; die(); ?>