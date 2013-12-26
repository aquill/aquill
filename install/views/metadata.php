<?php install_include('header'); ?>

<section class="content">
    <article>
        <h1>Site metadata</h1>

        <p>In order to personalise your Anchor blog, it's recommended you add some metadata about your site. This can
            all be changed at any time, though.</p>
    </article>

    <form method="post" action="<?php echo URL::to('metadata'); ?>" autocomplete="off">
        <?php echo $messages; ?>

        <?php echo Form::token(); ?>

        <fieldset>
            <p>
                <label for="title">Site Name</label>
                <i>What’s your blog called?.</i>

                <input id="title" name="title" value="<?php echo $title; ?>">
            </p>

            <p>
                <label for="description">Site Description</label>
                <i>A little bit about you or your blog.</i>

                <textarea id="description" name="description"><?php echo $description; ?></textarea>
            </p>

            <p>
                <label for="url">Site URL</label>
                <i>Anchor’s folder. Change if this is wrong.</i>
                <input id="url" name="url" value="<?php echo $url; ?>">
            </p>

            <p>
                <label for="index">Site Index</label>
                <i>Anchor’s folder. Change if this is wrong.</i>
                <input id="index" name="index" value="<?php echo $index; ?>">
            </p>

        </fieldset>

        <section class="options">
            <a href="<?php echo URL::to('database'); ?>" class="btn quiet">&laquo; Back</a>
            <button type="submit" class="btn">Next Step &raquo;</button>
        </section>
    </form>
</section>

<?php install_include('footer'); ?>
