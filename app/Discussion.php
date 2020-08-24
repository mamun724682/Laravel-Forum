<?php

namespace App;

use App\User;
use App\Reply;
use App\Channel;
use App\Events\DiscussionCreated;
use App\Events\DiscussionDeleted;
use App\Events\DiscussionUpdated;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\MarkBestReplyNotification;

class Discussion extends Model
{
    protected $fillable = ['title', 'content', 'channel_id', 'slug', 'reply_id'];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => DiscussionCreated::class,
        'updated' => DiscussionUpdated::class,
        'deleted' => DiscussionDeleted::class,
    ];

    public function author()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function replies()
    {
    	return $this->hasMany(Reply::class);
    }

    public function getRouteKeyName()
    {
    	return 'slug';
    }

    public function markAsBestReply(Reply $reply)
    {
        $this->update([
            'reply_id' => $reply->id
        ]);

        if (auth()->user()->id == $this->author->id) {
            return;
        }

        $reply->owner->notify(new MarkBestReplyNotification($reply->discussion));
    }

    public function getBestReply()
    {
        return $this->belongsTo(Reply::class, 'reply_id');
    }

    public function scopeFilterByChannels($builder)
    {
        if (request()->query('channel')) {
            $channel = Channel::where('slug', request()->query('channel'))->first();
            if ($channel) {
                return $builder->where('channel_id', $channel->id);
            }
            return $builder;
        }

        return $builder;
    }
}
