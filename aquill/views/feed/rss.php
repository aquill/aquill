<?php echo '<?xml version="1.0" encoding="UTF-8" ?>'."\n"; ?>
<rss xmlns:content="http://purl.org/rss/1.0/modules/content/" version="2.0">
    <channel>
        <title><![CDATA[<?php echo $channel->title; ?>]]></title>
        <link><?php echo $channel->link; ?></link>
        <description><![CDATA[<?php echo $channel->description; ?>]]></description>
        <pubDate><?php echo $channel->pubdate; ?></pubDate>
        <generator>aquill</generator>
        <?php foreach($channel->items as $item) : ?>
        <item>
            <title><![CDATA[<?php echo $item->title; ?>]]></title>
            <author><?php echo $item->author; ?></author>
            <link><?php echo $item->link; ?></link>
            <guid><?php echo $item->link; ?></guid>
            <description><![CDATA[<?php echo $item->description; ?>]]></description>
            <content:encoded><![CDATA[<?php echo $item->content; ?>]]></content:encoded>
            <pubDate><?php echo $item->pubdate; ?></pubDate>
        </item>
        <?php endforeach; ?>
    </channel>
</rss>