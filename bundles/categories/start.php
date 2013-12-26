<?php

function test() {return 'test';}

Autoloader::map(array(
    'Category' => Bundle::path('categories') . 'category.php',
));
