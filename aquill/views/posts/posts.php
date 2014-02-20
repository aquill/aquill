<?php foreach ($posts->results as $post) : ?>
    <li class="post" id="post-<?php echo $post->id(); ?>">
        <a class="<?php echo Input::get('id', 0) == $post->id() ? 'active item' : 'item'; ?>"
           href="<?php echo url('admin/posts/' . $post->id()); ?>">
            <strong><?php echo $post->title(); ?></strong>
            <time><?php echo $post->date(); ?></time>
        </a>
        <em class="status"><?php _e('post.' . $post->status); ?></em>
        <ul class="statuses">
            <li><a href="<?php echo url('admin/posts/publish/' . $post->id()); ?>"><?php _e('post.publish'); ?></a></li>
            <li><a href="<?php echo url('admin/posts/draft/' . $post->id()); ?>"><?php _e('post.draft'); ?></a></li>
            <li><a class="delete" href="<?php echo url('admin/posts/delete/' . $post->id()); ?>"><?php _e('global.delete'); ?></a></li>
        </ul>
    </li>
<?php endforeach; ?>