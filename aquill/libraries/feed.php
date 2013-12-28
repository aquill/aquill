<?php

class Feed
{

    public $items = array();
    public $title = 'My feed title';
    public $description = 'My feed description';
    public $link;
    public $pubdate;
    public $lang;
    public $charset = 'utf-8';
    public $ctype = 'application/xml';

    /**
     * Add new item to $items array
     *
     * @param string $title
     * @param string $author
     * @param string $link
     * @param string $pubdate
     * @param string $description
     *
     * @return void
     */
    public function add($title, $author, $link, $pubdate, $description, $content)
    {
        $item = new Item;

        $item->title = $title;
        $item->author = $author;
        $item->link = $link;
        $item->pubdate = $pubdate;
        $item->description = $description;
        $item->content = $content;

        $this->items[] = $item;
    }

    /**
     * Returns aggregated feed with all items from $items array
     *
     * @param string $format (options: 'atom', 'rss')
     *
     * @return view
     */
    public function render($format = 'atom')
    {
        if (empty($this->lang)) $this->lang = Config::get('application.language');
        if (empty($this->link)) $this->link = Config::get('application.url');
        if (empty($this->pubdate)) $this->pubdate = date('D, d M Y H:i:s O');
        if ($format == 'rss') $this->ctype = 'application/xml';
        if ($format == 'feed') $format = 'rss';

        $channel = new Item;
        
        $channel->title = $this->title;
        $channel->description = $this->description;
        $channel->link = $this->link;
        $channel->pubdate = $this->pubdate;
        $channel->lang = $this->lang;
        $channel->items = $this->items;

        return Response::make(View::make('feed/'.$format, array('channel' => $channel) ), 200, array('Content-Type' => $this->ctype));
    }

}