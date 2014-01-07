<?php partial('partials/header'); ?>
<script>
$(document).ready(function(){

    $("form").submit(function(e){
        $.post('test', function(data) {
            $('body').append(data.name);
        },'json');

        return false;
    });
});
</script>

<div class="container one-column">
    <form action="test" method="post" enctype="multipart/form-data">
        <label for="file">Filename:</label>
        <input type="file" name="test" id="test" /> 
        <br />
        <input type="submit" name="submit" value="Submit" />
    </form>
</div>

<?php partial('partials/footer'); ?>
