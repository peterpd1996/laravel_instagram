<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotifiLikeAndComment implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    private $image;
    private $fromUser;
    private $type;
    private $postId;
    private $toUser;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($image, $username, $type, $postId, $toUser)
    {
        $this->image = $image;
        $this->fromUser = $username;
        $this->type = $type;
        $this->postId = $postId;
        $this->toUser = $toUser;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */

    public function broadcastOn()
    {
         return new Channel('notification');
    }
    public function broadcastAs()
    {
        return 'newNotification';
    }
    public function broadcastWith()
    {
        return [
            'image' => $this->image,
            'fromUser' => $this->fromUser,
            'type' => $this->type,
            'postId' => $this->postId,
            'toUser' => $this->toUser,
        ];
    }
}
