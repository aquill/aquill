<?php partial('partials/header'); ?>
    
    <link rel="stylesheet" href="<?php echo asset('assets/css/dropbox.css'); ?>">
    
    <script src="<?php echo asset('assets/js/jquery.collagePlus.js'); ?>"></script>
    <script src="<?php echo asset('assets/js/extras/jquery.removeWhitespace.js'); ?>"></script>
    <script src="<?php echo asset('assets/js/extras/jquery.collageCaption.js'); ?>"></script>

    <script type="text/javascript">

        // All images need to be loaded for this plugin to work so
        // we end up waiting for the whole window to load in this example
        $(window).load(function () {
            $(document).ready(function(){
                collage();
                $('#dropbox').collageCaption();
            });
        });

        // Here we apply the actual CollagePlus plugin
        function collage() {
            $('#dropbox').removeWhitespace().collagePlus(
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
            //collage();
            //$('.media').collageCaption();
        });

        var upload_url = '<?php echo url("admin/media/upload") ?>';
        var csrf_token = '<?php echo csrf_token(); ?>';

    </script>

    <div class="container one-column">
        <form name="demoFiler" id="demoFiler" enctype="multipart/form-data">
            <div class="media">
                <div id="dropbox">
                <?php foreach ($media->results as $media) : ?>
                <div class="attachment" data-caption="<?php echo $media->date(); ?>">
                    <?php echo $media->image(); ?>        
                </div>
                <?php endforeach; ?>
                </div>
                <div class="upload">
                    <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
                    <input type="file" name="multiUpload" id="multiUpload" multiple />
                    <button class="openfile" type="button">File</button>
                    <button type="submit">Upload</button>
                </div>
            </div>
        </form>
    </div>

    <script src="http://chen.local/aquill/aq/assets/js/jquery.filedrop.js"></script>
    <script src="http://chen.local/aquill/aq/assets/js/script.js"></script>

<?php partial('partials/footer'); ?>