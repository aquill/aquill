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
                
                <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" name="post_id" value="<?php echo post_id(); ?>">

                <p class="comment-author-name">
                    <label for="">Name</label>
                    <input type="text" name="name">
                </p>

                <p class="comment-author-email">
                    <label for="">Email</label>
                    <input type="text" name="email">
                </p>

                <p class="comment-author-url">
                    <label for="">Homepage</label>
                    <input type="text" name="url">
                </p>

                <p class="comment-author-content">
                    <label for="">Comment</label>
                    <textarea name="content" id="content" cols="30" rows="10"></textarea>
                </p>

                <p class="actions">
                    <button type="submit">Submit</button>
                </p>
            </form>
        </div>
    <?php endif; ?>

</div>
