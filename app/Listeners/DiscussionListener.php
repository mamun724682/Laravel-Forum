<?php

namespace App\Listeners;

use App\Discussion;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DiscussionListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        cache()->forget('discussions');
        
        $discussions = Discussion::with('author')->filterByChannels()->paginate(100);
        
        cache()->forever('discussions', $discussions);
    }
}
