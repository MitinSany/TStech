<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DepositChangeValue
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $deposit_id;
    public $value;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(int $deposit_id, $value)
    {
        $this->deposit_id = $deposit_id;
        $this->value = $value;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
