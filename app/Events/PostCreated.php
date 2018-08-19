<?php

namespace App\Events;

// we did this
use App\Post;
use App\User;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
// We should add this to class line
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PostCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $post;
    public $user;

    public function __construct(Post $post, User $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    /*
    The broadcastOn method should return a channel or array of channels that the event should broadcast on. The channels should be instances of Channel, PrivateChannel, or PresenceChannel
    */
    public function broadcastOn()
    {
        return [
            new PrivateChannel('new-post'),
            new PrivateChannel('App.User.' . $this->post->user->id),
        ];
    }

    // This method should return the array of data 
    // that you wish to broadcast as the event payload
    public function broadcastWith()
    {
        return [
            'post' => array_merge($this->post->toArray(), [
                'user' => $this->post->user,
            ]),
            'user' => $this->user,
        ];
    }
}
