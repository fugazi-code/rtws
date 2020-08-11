<?php

namespace App\Callbacks;

use PubNub\PubNub;
use PubNub\Callbacks\SubscribeCallback;
use PubNub\Models\ResponseHelpers\PNStatus;

class DeliveryCallback extends SubscribeCallback
{
    /**
     * @inheritDoc
     */
    function status($pubnub, $status)
    {
        // TODO: Implement status() method.
    }

    function message($pubnub, $message)
    {
        // TODO: Implement message() method.
    }

    function presence($pubnub, $presence)
    {
        // TODO: Implement presence() method.
    }
}
