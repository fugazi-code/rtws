<?php

namespace App\PubNub;

use PubNub\PubNub;
use PubNub\PNConfiguration;

class PubNubConnect
{
    public $pnconf;

    public $pubnub;

    public function __construct()
    {
        $this->pnconf = new PNConfiguration();
        $this->pubnub = new PubNub($this->pnconf);
        $this->initialize();
    }

    public function initialize()
    {
        $this->pnconf
            ->setSubscribeKey(env('PUB_NUB_SUBSCRIBE_KEY'))
            ->setPublishKey(env('PUB_NUB_PUBLISH_KEY'));

        return $this;
    }

    public function setListener($method)
    {
        $this->pubnub->addListener($method);
    }

    public function message($message)
    {
        $this->pubnub
            ->publish()
            ->channel(env('PUB_NUB_CHANNEL'))
            ->message([
                "message" => $message,
            ])
            ->sync();
    }

    public function execute()
    {
        $this->pubnub->subscribe()
                     ->channel([$this->channel])
                     ->withPresence()
                     ->execute();
    }
}
