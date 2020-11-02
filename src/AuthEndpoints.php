<?php

namespace BoxyBird\WebSockets;

use WP_REST_Request;
use Illuminate\Support\Str;

class AuthEndpoints
{
    protected static $user;

    protected static $websockets;

    public static function init(): void
    {
        add_action('init', [AuthEndpoints::class, 'setProperties']);
        add_action('rest_api_init', [AuthEndpoints::class, 'auth']);
    }

    public static function setProperties(): void
    {
        self::$websockets   = new WebSockets;
        self::$user         = wp_get_current_user();
    }

    public static function auth(): void
    {
        register_rest_route('boxybird/pusher/v1', '/auth', [
            'methods'             => 'POST',
            'callback'            => [AuthEndpoints::class, 'authCallback'],
            'permission_callback' => function () {
                return is_user_logged_in();
            },
        ]);
    }

    public static function authCallback(WP_REST_Request $request)
    {
        $params = self::handleRequestParams($request);

        $data = [
            'id'   => self::$user->ID,
            'name' => self::$user->user_nicename,
        ];

        if ($params['channel_type'] === 'presence') {
            echo self::$websockets->presence_auth(
                $params['channel_name'],
                $params['socket_id'],
                self::$user->ID,
                $data
            );

            exit;
        }

        echo self::$websockets->socket_auth(
            $params['channel_name'],
            $params['socket_id']
        );

        exit;
    }

    protected function handleRequestParams(WP_REST_Request $request): array
    {
        $channel_name   = $request->get_param('channel_name');
        $socket_id      = $request->get_param('socket_id');

        $channel_type = Str::startsWith($channel_name, 'private-')
            ? 'private'
            : 'presence';

        return [
            'socket_id'    => $socket_id,
            'channel_type' => $channel_type,
            'channel_name' => $channel_name,
        ];
    }
}
