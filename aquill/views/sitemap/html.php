<!DOCTYPE html>
<html>
<head>
    <title><?php echo $channel->title; ?></title>
</head>
<body>
    <h1><a href="<?php echo $channel->link; ?>"><?php echo $channel->title; ?></a></h1>
    <ul>
        <?php foreach($channel->items as $item) : ?>
        <li>
            <a href="<?php echo $item->loc; ?>"><?php echo (empty($item->title)) ? $item->loc : $item->title; ?></a>
            <small>(last updated: <?php echo $item->lastmod; ?>)</small>
        </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>