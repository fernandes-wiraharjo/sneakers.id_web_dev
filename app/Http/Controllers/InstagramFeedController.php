<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class InstagramFeedController extends Controller
{
    /**
     * Display cached Instagram feed
     * Cache for 24 hours to limit API usage
     */
    public function show()
    {
        $cachedFeed = Cache::remember('instagram_feed_html', 86400, function () {
            // This will be the rendered HTML
            return view('instagram.feed-embed')->render();
        });

        return response($cachedFeed)
            ->header('Content-Type', 'text/html')
            ->header('Cache-Control', 'public, max-age=86400');
    }

    /**
     * Force refresh cache (can be called by cron job)
     */
    public function refresh()
    {
        Cache::forget('instagram_feed_html');
        return $this->show();
    }
}

