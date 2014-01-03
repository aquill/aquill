        <div id="footer">
            <p>
                Powered by <a href="http://aquill.org">Aquill</a> |
                <a href="<?php echo url('sitemap.xml'); ?>">sitemap.xml</a> |
                <a href="<?php echo url('feed'); ?>">RSS</a>
                <br>
                <?php echo exec_time(); echo memory_usage(); ?>    
            </p>
        </div>
    </div>
    <?php echo theme_scripts(); ?>
</body>
</html>