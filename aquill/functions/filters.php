<?php

add_filter( 'post_content', 'autop', 10, 3 );
add_filter( 'page_content', 'autop', 10, 3 );
add_filter( 'comment_content', 'autop', 10, 3 );

require PATH . 'themes/default/functions.php';
