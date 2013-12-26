$(function () {

    $('input[name="created"]').appendDtpicker();

    $('textarea[name=html]').autosize();

    $("select").selecter();

    $('.load-more').on('click', function (e) {
        $this = $(this);
        var page = $this.attr('page-num');
        var type = $this.attr('type');
        //alert(page);
        $.post(base+type, { page: page}, function(data) {
            //$(data).insertBefore('.load-more');
            if (data == '' ) $this.remove();
            $this.before(data);
            $this.attr('page-num',1*page+1 );
        });
        return false
    });
    /*
    $(document).on('click','.item',function(){
        $this = $(this);
        var url = $this.attr('href');

        $form = $('.postform')

        $.post(url, function(data) {
            $('.container').prepend(data);
            $('textarea[name=html]').autosize();
            $form.remove();
        });

        return false;
    });
*/
    $(document).on('click','.status',function(){
        $('.statuses').hide();
        $(this).next('.statuses').show();
    });

    $('.statuses').mouseout(function(){
        //$(this).hide();
    });
    //$object.css('margin-top','-'+$object.outerHeight()+'px');
    //alert($object.outerHeight());
    //$object.show();

    $(document).on('click','.toggle',function(){
        $('.meta').slideToggle();
        //$object.show();
        //$object.blindUpToggle('slow');
        return false;
    });

    /*$object.on('click', function (e) {
        e.stopPropagation();
    });*/
    $(document).on('click','.header, .editor',function(){
        $('.meta').slideUp();
        //$object.blindUpOut('slow');
    });

    $('.delete').on('click', function () {
        return confirm('Confirm Delete?');
    });

});