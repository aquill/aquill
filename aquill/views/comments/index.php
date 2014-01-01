<?php admin_include('header'); ?>

    <div id="sidebar" class="sidebar">
        <?php admin_include('search'); ?>
        <aside id="commentlist" class="widget widget-list">
            <h3 class="widget-title">All Comments</h3>
            <ul class="list">
                <?php foreach ($comments->results as $comment) : ?>
                    <li class="post" id="post-<?php echo $comment->id; ?>">
                        <a <?php echo Input::get('id', 0) == $comment->id ? 'class="active"' : ''; ?>
                            href="<?php echo url('admin/comments?id=' . $comment->id); ?>">
                            <strong><?php echo $comment->name; ?></strong>
                            <time><?php echo $comment->date(); ?></time>
                        </a>
                        <em class="status"><?php echo $comment->status; ?></em>
                        <ul class="statuses">
                            <li>Approved</li>
                            <li>Pending</li>
                            <li>Spam</li>
                            <li><a class="delete" href="<?php echo url('admin/comment/' . $comment->id); ?>">Delete</a>
                            </li>
                        </ul>
                    </li>
                <?php endforeach; ?>
                <li class="load-more" type="comments" page-num="2"><span>Load more comments</span></li>
            </ul>

            <?php //echo $comments->links(); ?>
        </aside>
    </div>

    <div id="main" class="container">
        <?php echo $messages; ?>
        <?php echo $formdata; ?>
    </div>

<?php admin_include('footer'); ?>