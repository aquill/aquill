<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<?php echo '<?xml-stylesheet type="text/xsl" href="'.asset('aquill/views/sitemap/sitemap.xsl').'"?>'; ?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<?php foreach($items as $item) : ?>
    <url>
        <loc><?php echo $item->loc; ?></loc>
        <lastmod><?php echo $item->lastmod; ?></lastmod>
        <changefreq><?php echo $item->freq; ?></changefreq>
        <priority><?php echo $item->priority; ?></priority>
    </url>
<?php endforeach; ?>
</urlset>