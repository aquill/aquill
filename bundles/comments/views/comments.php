<?php foreach ($comments->results as $comment) : ?>
    <li class="post" id="post-<?php echo $comment->id; ?>">
        <a <?php echo Input::get('id', 0) == $comment->id ? 'class="active"' : ''; ?>
            href="<?php echo url('admin/comments?id=' . $comment->id); ?>">
            <strong><?php echo $comment->text; ?></strong>
            <time><?php echo $comment->date; ?></time>
        </a>
        <em class="status"><?php echo $comment->status; ?></em>
        <ul class="statuses">
            <li>Approved</li>
            <li>Pending</li>
            <li>Spam</li>
            <li><a class="delete" href="<?php echo url('admin/comment/' . $comment->id); ?>">Delete</a></li>
        </ul>
    </li>
<?php endforeach;
die(); ?>