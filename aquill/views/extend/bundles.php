<?php partial('partials/header'); ?>
<div class="container one-column">
    <div class="wrap">
        <?php foreach ($bundles as $bundle) : ?>
        <div class="bundle">
            <form class="bundleform" method="post" action="<?php echo url('admin/bundles/'.$bundle->view) ; ?>">

                <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" name="site_bundle" value="<?php echo $bundle->view; ?>">

                <div class="bundle-info">
                    <h1 class="bundle-name"><?php echo $bundle->name ; ?></h1>
                    <p class="bundle-author">By <?php echo $bundle->author(); ?></p>
                    <p class="bundle-version">Version: <?php echo $bundle->version; ?></p>
                    <?php if ($bundle->description) : ?>
                    <p class="bundle-description">Description: <?php echo $bundle->description ; ?></p>
                    <?php endif; if ($bundle->tags) : ?>
                    <p class="bundle-tags">Tags: <?php echo $bundle->tags ; ?></p>
                    <?php endif; ?>
                    <p class="bundle-button"><button>Activate</button></p>
                </div>
            </form>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php partial('partials/footer'); ?>
