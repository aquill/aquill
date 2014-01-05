$(function () {

    $('.datetime').appendDtpicker();

    $('textarea').autosize();

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
    var $list = $('.widget-list');
    var top = $list.offset().top;
    var window_height = $(window).height();

    $list.height(window_height-top);

    function resize() {
        var top = $list.offset().top;
        var window_height = $(window).height();
        $list.height(window_height-top);
    }

    $('input[name=title]').on('keydown', function(e) {
        if(e.keyCode == 13) {
            $('textarea[name=content]').focus();
            return false;
        }
    });

    $(window).resize(function() {
        window_height = $(window).height();
        $list.height(window_height-top);
    });

    $(document).on('click','.status',function(){
        $('.statuses').hide();
        $(this).next('.statuses').show();
    });

    var up = true;
    $('.widget-statuses h3').on('click', function() {
        $this = $(this);
        h = $this.next().height();
        $this.next().slideToggle();
        if (up) {
            up = false;
            $list.animate({height:'-='+h+'px'});
        } else {
            up = true;
            $list.animate({height:'+='+h+'px'});
        }
    });

    $('.statuses').mouseout(function(){
        //$(this).hide();
    });

    $(document).on('click','.toggle',function(){
        var object = $(this).attr('toggle-object');
        $('.'+object).slideToggle();
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