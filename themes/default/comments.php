<div class="comments">

    <?php if (has_comments()) : ?>

        <h3 class="comments-title"></h3>

        <ul class="comment-list">

            <?php while (get_comments()) : the_comment(); ?>

                <li class="li-comment">
                    <article>
                        <h3><?php echo comment_author(); ?></h3>
                        <div class="comment-content">
                            <?php echo comment_content(); ?>
                        </div>
                    </article>
                </li>

            <?php endwhile; ?>

        </ul>

        <?php echo comment_paging(); ?>

    <?php endif; ?>

    <?php if (comments_open()) : ?>
        <div class="response">
            <form method="post" action="<?php echo url('comment') ?>" class="response">

                <?php echo comment_message(); ?>
                <?php echo comment_post_input(); ?>
                <?php echo csrf_token_input(); ?>

                <p class="comment-author-name">
                    <label for="">Name</label>
                    <?php echo comment_name_input('Name'); ?>
                </p>

                <p class="comment-author-email">
                    <label for="">Email</label>
                    <?php echo comment_email_input('Email'); ?>
                </p>

                <p class="comment-author-url">
                    <label for="">Homepage</label>
                    <?php echo comment_url_input('Homepage'); ?>
                </p>

                <p class="comment-author-content">
                    <label for="">Comment</label>
                    <?php echo comment_content_input('Comment'); ?>
                </p>

                <p class="actions">
                    <button type="submit">Submit</button>
                </p>
            </form>
        </div>
    <?php endif; ?>

</div>
