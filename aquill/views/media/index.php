<?php partial('partials/header'); ?>

    <script src="<?php echo asset('assets/js/jquery.collagePlus.js'); ?>"></script>
    <script src="<?php echo asset('assets/js/extras/jquery.removeWhitespace.js'); ?>"></script>
    <script src="<?php echo asset('assets/js/extras/jquery.collageCaption.js'); ?>"></script>
  
    <script type="text/javascript">

    // All images need to be loaded for this plugin to work so
    // we end up waiting for the whole window to load in this example
    $(window).load(function () {
        $(document).ready(function(){
            collage();
            $('.media').collageCaption();
        });
    });


    // Here we apply the actual CollagePlus plugin
    function collage() {
        $('.media').removeWhitespace().collagePlus(
            {
                'fadeSpeed'     : 100,
                'targetHeight'  : 300,
                //'effect'        : 'effect-3',
                //'direction'     : 'vertical'
            }
        );
    };

    // This is just for the case that the browser window is resized
    var resizeTimer = null;
    $(window).bind('resize', function() {
        // hide all the images until we resize them
        $('.attachment').css("opacity", 0);
        // set a timer to re-apply the plugin
        if (resizeTimer) clearTimeout(resizeTimer);
        resizeTimer = setTimeout(collage, 200);
    });

    </script>

<div class="container one-column">
    <div class="media">
            <?php foreach ($media->results as $media) : ?>
            <div class="attachment" data-caption="<?php echo $media->title; ?>">
                <a>
                    <?php echo $media->image(); ?>
                </a>
            </div>
            <?php endforeach; ?>
    </div>
</div>

<?php partial('partials/footer'); ?>