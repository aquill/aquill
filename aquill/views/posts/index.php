<?php admin_include('header'); ?>

    <div id="sidebar" class="sidebar">
        <?php admin_include('search'); ?>
        <aside id="postlist" class="widget widget-list">
            <h3 class="widget-title">All posts</h3>
            <ul class="list">
                <?php foreach ($posts->results as $post) : ?>
                    <li class="post" id="post-<?php echo $post->id; ?>">
                        <a class="<?php echo Input::get('id', 0) == $post->id ? 'active item' : 'item'; ?>"
                            href="<?php echo url('admin/posts/' . $post->id); ?>">
                            <strong><?php echo $post->title; ?></strong>
                            <time><?php echo $post->created; ?></time>
                        </a>
                        <em class="status"><?php echo $post->status; ?></em>
                        <ul class="statuses">
                            <li>published</li>
                            <li>Draft</li>
                            <li><a class="delete" href="<?php echo url('admin/post/'. $post->id); ?>">Delete</a></li>
                        </ul>
                    </li>
                <?php endforeach; ?>

                <?php if (Post::count() > 10): ?>
                    <li class="load-more" type="posts" page-num="2"><span>Load more posts</span></li>
                <?php endif; ?>
            </ul>
            <?php //echo $posts->links(); ?>
        </aside>
    </div>

    <div id="main" class="container">
        <?php echo $messages; ?>
        <?php echo $formdata; ?>
    </div>

<?php admin_include('footer'); ?>