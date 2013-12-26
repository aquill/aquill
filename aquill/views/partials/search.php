<aside id="search" class="widget widget-search">
    <h3 class="widget-title">Search Posts:</h3>
    <?php echo Form::open('admin/search/comment', 'POST', array('class' => 'searchform')); ?>
    <input placeholder="To search, type and hit enter…" type="text" name="title">
    <button class="btn green" type="submit">Search</button>
    <?php echo Form::close(); ?>
</aside>