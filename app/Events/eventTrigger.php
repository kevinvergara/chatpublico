<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class eventTrigger implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $user;
    protected $message;

    public function __construct($user, $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    public function broadcastWith()
    {
        // This must always be an array. Since it will be parsed with json_encode()
        return [
            'user' => $this->user,
            'message' => $this->message,
        ];
    }

    public function broadcastAs()
    {
        return 'newMessage';
    }

    public function broadcastOn()
    {
        return new Channel('channel-chatpublico');
    }
}
