<?php foreach ($comments->results as $comment) : ?>
    <li class="post" id="post-<?php echo $comment->id; ?>">
        <a <?php echo Input::get('id', 0) == $comment->id ? 'class="active"' : ''; ?>
            href="<?php echo url('admin/comments?id=' . $comment->id); ?>">
            <strong><?php echo $comment->name; ?></strong>
            <time><?php echo $comment->date(); ?></time>
        </a>
        <em class="status"><?php echo __('comment.' . $comment->status); ?></em>
        <ul class="statuses">
            <li><?php echo __('comment.approved'); ?></li>
            <li><?php echo __('comment.pending'); ?></li>
            <li><?php echo __('comment.spam'); ?></li>
            <li>
                <a class="delete" href="<?php echo url('admin/comment/' . $comment->id); ?>"><?php echo __('comment.delete'); ?></a>
            </li>
        </ul>
    </li>
<?php endforeach; ?>