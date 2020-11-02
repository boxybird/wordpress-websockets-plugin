<?php

namespace BoxyBird\WebSockets;

use Exception;
use Pusher\Pusher;

class WebSockets
{
    protected $pusher;

    public function __construct()
    {
        $this->setPusher();
    }

    public function __call($name, $args)
    {
        return $this->pusher->$name(...$args);
    }

    public function getChannelInfo(string $channel)
    {
        if (!$info = @$this->pusher->get_channel_info($channel)) {
            return false;
        }

        return $info;
    }

    protected function setPusher(): void
    {
        if (!$settings = get_option('bb_ws_settings', null)) {
            throw new Exception(
                'BoxyBird WebSockets admin settings missing.'
            );
        }

        $encrypted = isset($settings['bb_ws_encrypted']) 
            ? (bool) $settings['bb_ws_encrypted'] 
            : false;

        $this->pusher = new Pusher(
            $settings['bb_ws_app_key'],
            $settings['bb_ws_app_secret'],
            $settings['bb_ws_app_id'],
            [
                // 'debug'     => true,
                'encrypted' => $encrypted,
                'cluster'   => $settings['bb_ws_app_cluster'],
                'scheme'    => $settings['bb_ws_app_host_scheme'],
            ],
            $settings['bb_ws_app_host'],
            $settings['bb_ws_app_host_port']
        );
    }
}
