<?php foreach ($posts->results as $post) : ?>
    <li class="post" id="post-<?php echo $post->id(); ?>">
        <a class="<?php echo Input::get('id', 0) == $post->id() ? 'active item' : 'item'; ?>"
           href="<?php echo url('admin/posts/' . $post->id()); ?>">
            <strong><?php echo $post->title(); ?></strong>
            <time><?php echo $post->date(); ?></time>
        </a>
        <em class="status"><?php echo __('post.' . $post->status); ?></em>
        <ul class="statuses">
            <li><?php echo __('post.publish'); ?></li>
            <li><?php echo __('post.draft'); ?></li>
            <li><a class="delete"
                   href="<?php echo url('admin/post/' . $post->id()); ?>"><?php echo __('global.delete'); ?></a></li>
        </ul>
    </li>
<?php endforeach; ?>