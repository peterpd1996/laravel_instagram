<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewComment implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $comment;
    public $post_id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($comment,$post_id)
    {
        $this->comment = $comment;
        $this->post_id = $post_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('posts');
    }
    public function broadcastAs()
    {
        return 'newcomment';
    }
    public function broadcastWith()
    {
        return [
            'comment' => $this->comment,
            'post_id' => $this->post_id
        ];
    }
}
