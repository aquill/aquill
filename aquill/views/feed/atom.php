<?php echo '<?xml version="1.0" encoding="UTF-8" ?>'."\n"; ?>
<rss xmlns:atom="http://www.w3.org/2005/Atom" version="2.0">
    <channel>
        <title><![CDATA[<?php echo $channel->title; ?>]]></title>
        <link><?php echo $channel->link; ?></link>
        <description><![CDATA[<?php echo $channel->description; ?>]]></description>
        <atom:link href="<?php echo $channel->link; ?>" rel="self"></atom:link>
        <language><?php echo $channel->lang; ?></language>
        <lastBuildDate><?php echo date('D, d M Y H:i:s O', strtotime($channel->pubdate)); ?></lastBuildDate>
        <?php foreach($channel->items as $item) : ?>
        <item>
            <title><![CDATA[<?php echo $item->title; ?>]]></title>
            <link><?php echo $item->link; ?></link>
            <guid isPermaLink="true"><?php echo $item->link; ?></guid>
            <description><![CDATA[<?php echo $item->description; ?>]]></description>
            <dc:creator xmlns:dc="http://purl.org/dc/elements/1.1/"><?php echo $item->author; ?></dc:creator>
            <pubDate><?php echo date('D, d M Y H:i:s O', strtotime($item->pubdate)); ?></pubDate>
        </item>
        <?php endforeach; ?>
    </channel>
</rss>