<?php

namespace Tenant\Events\Response;

use Tenant\Models\Response;
use TrivYeah\Support\Fluent;
use Illuminate\Support\Collection;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class EndResponseProcessing
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $answers;

    public $response;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Collection $answers, Response $response)
    {
        $this->answers = $answers;
        $this->response = $response;
    }
}
