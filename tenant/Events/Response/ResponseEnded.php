<?php

namespace Tenant\Events\Response;

use Tenant\Models\Response;
use Illuminate\Support\Collection;
use Illuminate\Broadcasting\Channel;
use TrivYeah\Abstracts\HookableEvent;
use Illuminate\Queue\SerializesModels;
use Tenant\Http\Resources\FormResource;
use Illuminate\Broadcasting\PrivateChannel;
use Tenant\Http\Resources\ResponseResource;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ResponseEnded implements HookableEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $response;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public static function name(): string
    {
        return "response_ended";
    }

    public function load(): array
    {
        $form = $this->form();
        
        $formResource = new FormResource($form);
        $responseResource = new ResponseResource($this->response);

        $load['form'] = $formResource->toArray();
        $load['response'] = $responseResource->toArray();

        return $load;
    }

    public function form()
    {
        return $this->form ?: $this->form = $this->response->form;
    }

    public function hooks(): Collection
    {
        return $this->form()->hooks()
            ->where('event', static::name())->get();
    }
}
