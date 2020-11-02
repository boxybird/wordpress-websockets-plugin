<?php

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('bb-ws', plugin_dir_url(__DIR__) . 'assets/js/bb-ws.js', ['jquery'], null, true);

    $settings = get_option('bb_ws_settings', null);

    if (!empty($settings)) {
        wp_localize_script('bb-ws', 'BB_WS', [
            'settings' => $settings,
            'nonce'    => wp_create_nonce('wp_rest'),
        ]);
    }
});
