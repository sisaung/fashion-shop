<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderPlaced implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $order;

    /**
     * Create a new event instance.
     */
    public function __construct(Order $order)
    {
        //
        $this->order = $order;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('admin.orders'),
        ];
    }



    public function broadcastAs() {
        return 'order.placed';
    }

    public function broadcastWith() {
        return [
            'order_id' => $this->order->id,
            'markAsRead' => false,
            'order_number' => $this->order->order_number,
            'customer_name' => $this->order->customer_name,
            'customer' => [
                'profile_image' => $this->order->customer->profile_image,
            ],
            'net_total' => $this->order->net_total,
            'order_status' => $this->order->order_status,
            'order_items' => $this->order->orderItems, // assuming relation is correct
            'created_at' => $this->order->created_at->toDateTimeString(),
        ];
    }
}
