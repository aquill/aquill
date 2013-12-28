<?php

class Sitemap
{

    public $items = array();
    public $title;
    public $link;


    /**
     * Add new sitemap item to $items array
     *
     * @param string $loc
     * @param string $lastmod
     * @param string $priority
     * @param string $freq
     * @param string $title
     *
     * @return void
     */
    public function add($loc, $lastmod = null, $priority = '0.6', $freq = 'weekly', $title = null)
    {
        $item = new Item;

        $item->loc = $loc;
        $item->lastmod = $lastmod;
        $item->freq = $freq;
        $item->priority = $priority;
        $item->title = $title;

        $this->items[] = $item;
    }


    /**
     * Returns document with all sitemap items from $items array
     *
     * @param string $format (options: xml, html, txt, ror-rss, ror-rdf)
     *
     * @return View
     */
    public function render($format = 'xml')
    {
        if (empty($this->link)) $this->link = Config::get('app.url');
        if (empty($this->title)) $this->title = 'Sitemap for ' . $this->link;

        $channel = new Item;

        $channel->title = $this->title;
        $channel->link = $this->link;
        $channel->items = $this->items;

        switch ($format)
        {
            case 'ror.rss':
                return Response::make(View::make('sitemap/ror-rss', array('channel' => $channel)), 200, array('Content-Type' => 'application/xml; charset=utf-8'));
                break;
            case 'ror.rdf':
                return Response::make(View::make('sitemap/ror-rdf', array('channel' => $channel)), 200, array('Content-Type' => 'text/xml; charset=utf-8'));
                break;
            case 'html':
                return Response::make(View::make('sitemap/html', array('channel' => $channel)), 200, array('Content-Type' => 'text/html'));
                break;
            case 'txt':
                return Response::make(View::make('sitemap/txt', array('items' => $this->items)), 200, array('Content-Type' => 'text/plain'));
                break;
            case 'xml':
                return Response::make(View::make('sitemap/xml', array('items' => $this->items)), 200, array('Content-Type' => 'text/xml'));
        }
    }

    /**
     * Generate sitemap and store it to a file
     *
     * @param string $format (options: xml, html, txt, ror-rss, ror-rdf)
     * @param string $filename (without file extension, may be a path like 'sitemaps/sitemap1' but must exist)
     *
     * @return void
     */
    public function store($format = 'xml', $filename = 'sitemap')
    {
        $content = $this->render($format);

        if ($format == 'ror-rss' || $format == 'ror-rdf') $format = 'xml';

        $file = path('public') . $filename . '.' .$format;

        File::put($file, $content);
    }

}