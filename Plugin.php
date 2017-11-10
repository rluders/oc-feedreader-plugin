<?php

namespace RLuders\FeedReader;

use System\Classes\PluginBase;
use Config;


/**
 * FeedReader Plugin Information File.
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'rluders.feedreader::lang.plugin.name',
            'description' => 'rluders.feedreader::lang.plugin.description',
            'author'      => 'Ricardo Lüders',
            'icon'        => 'icon-rss',
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->register(\Tymon\JWTAuth\Providers\JWTAuthServiceProvider::class);
    }

    /**
     * Register plugin components
     *
     * @return void
     */
    public function registerComponents()
    {
        return [
            'RLuders\FeedReader\Components\FeedList' => 'feedList'
        ];
    }
}
