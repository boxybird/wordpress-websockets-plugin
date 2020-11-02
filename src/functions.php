<?php

use BoxyBird\WebSockets\WebSockets;

if (!function_exists('bb_ws_channel_info')) {
    function bb_ws_channel_info(string $channel)
    {
        return (new WebSockets)->getChannelInfo($channel);
    }
}

if (!function_exists('bb_ws_trigger_event')) {
    /**
     * @param $channel array|string
     */
    function bb_ws_trigger_event(
        $channel,
        string $event,
        array $data = [],
        $socket_id = null,
        $debug = false,
        $already_encoded = false
        ) {
        return (new WebSockets)->trigger(
            $channel,
            $event,
            $data,
            $socket_id,
            $debug,
            $already_encoded
        );
    }
}
