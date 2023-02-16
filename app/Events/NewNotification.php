<?php

namespace App\Events;

use App\Models\Comment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

// use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class NewNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $user_id;
    public $user;
    public $comment;
    public $post_id;
    public $date;

    public function __construct($data)
    {
        // $user = User::where('id' , $data['user_id'])->first()->name;
        $user = Auth::user()->name;

        $this->user_id = $data['user_id'];
        $this->user = $user;
        $this->comment = $data['comment'];
        $this->post_id = $data['post_id'];
        $this->date = date('d m Y | h:i A' , strtotime(now()));
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('new-notification');
    }
}
