<?php

namespace RLuders\FeedReader\Components;

use Cache;
use Illuminate\Support\Carbon;
use Cms\Classes\ComponentBase;
use PicoFeed\Reader\Reader as FeedReader;

class FeedList extends ComponentBase
{
    /**
     * Cache the feed at the component instance
     *
     * @var null|\PicoFeed\Parser\Feed
     */
    protected $loadedFeed = null;

    /**
     * Executes when the component runs
     *
     * @return void
     */
    public function onRun()
    {
        $url = $this->property('feedURL');
        $this->loadedFeed = $this->loadFeed($url);
    }

    /**
     * Component details
     *
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name' => 'Feed List',
            'description' => 'Displays a collection of feed items.'
        ];
    }

    /**
     * Component properties
     *
     * @return array
     */
    public function defineProperties()
    {
        return [
            'feedURL' => [
                'title'             => 'Feed URL',
                'description'       => 'The feed URL to be readed.',
                'default'           => 'http://rss.nytimes.com/services/xml/rss/nyt/World.xml',
                'type'              => 'string',
                'validationPattern' => '^(?:https?://)?(?:[a-z0-9-]+\.)*((?:[a-z0-9-]+\.)[a-z]+)',
                'validationMessage' => 'The feed URL must be an valid URL address.'
            ],
            'expireAt' => [
                'title'             => 'Expire cache in (minutes)',
                'description'       => 'It will keep the feed in cache for how much time you want.',
                'default'           => 10,
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'The expiration time property can contain only numbers'
            ]
        ];
    }

    /**
     * Load feeds from given URL
     *
     * @param string $url
     * @return void
     */
    protected function loadFeed(string $url)
    {
        try {

            // Generate the cache key from URL
            $cacheKey = md5($url);

            if (Cache::has($cacheKey)) {
                return json_decode(Cache::get($cacheKey));
            }

            $reader = new FeedReader;
            $resource = $reader->download($url);

            $parser = $reader->getParser(
                $resource->getUrl(),
                $resource->getContent(),
                $resource->getEncoding()
            );

            // Get the feed!
            $feed = $parser->execute();

            // Storage the feed into the cache
            Cache::put(
                $cacheKey,
                json_encode($feed),
                Carbon::now()->addMinutes($this->property('expireAt'))
            );

            return $feed;

        } catch (Exception $e) {
            // Do nothing
        }

        return null;
    }

    /**
     * Get the Feed information
     *
     * @return void
     */
    public function feed()
    {
        return $this->loadedFeed;
    }

    /**
     * This will be the {{ feedList.items }}
     *
     * @return null|\PicoFeed\Parser\Item
     */
    public function items()
    {
        return $this->loadedFeed->items;
    }
}