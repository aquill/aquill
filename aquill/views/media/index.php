<?php partial('partials/header'); ?>

    <script src="<?php echo asset('assets/js/jquery.collagePlus.js'); ?>"></script>
    <script src="<?php echo asset('assets/js/extras/jquery.removeWhitespace.js'); ?>"></script>
    <script src="<?php echo asset('assets/js/extras/jquery.collageCaption.js'); ?>"></script>
    <script src="<?php echo asset('assets/js/multiupload.js'); ?>"></script>

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
        //collage();
        //$('.media').collageCaption();
    });

    var config = {
        support : "image/jpg,image/png,image/bmp,image/jpeg,image/gif",     // Valid file formats
        form: "demoFiler",                  // Form ID
        dragArea: "dragAndDropFiles",       // Upload Area ID
        uploadUrl: "<?php echo url('admin/media/upload'); ?>",             // Server side upload url
    }

    $(document).ready(function(){
        initMultiUploader(config);

        $('.openfile').on('click', function() {
            $('#multiUpload').click();
        });

        //alert($('input[name=csrf_token]').val());
    });

    </script>

<div class="container one-column">
    <form name="demoFiler" id="demoFiler" enctype="multipart/form-data">
        <div id="dragAndDropFiles" class="media">
            
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
    </form>
</div>

<?php partial('partials/footer'); ?>