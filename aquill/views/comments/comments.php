<?php foreach ($comments->results as $comment) : ?>
    <li class="post" id="post-<?php echo $comment->id; ?>">
        <a <?php echo Input::get('id', 0) == $comment->id ? 'class="active"' : ''; ?>
            href="<?php echo url('admin/comments?id=' . $comment->id); ?>">
            <strong><?php echo $comment->name; ?></strong>
            <time><?php echo $comment->date(); ?></time>
        </a>
        <em class="status"><?php _e('comment.' . $comment->status); ?></em>
        <ul class="statuses">
            <li><?php _e('comment.approved'); ?></li>
            <li><?php _e('comment.pending'); ?></li>
            <li><?php _e('comment.spam'); ?></li>
            <li>
                <a class="delete" href="<?php echo url('admin/comment/' . $comment->id); ?>"><?php _e('comment.delete'); ?></a>
            </li>
        </ul>
    </li>
<?php endforeach; ?>