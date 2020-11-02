<?php

/**
 * Plugin Name: BoxyBird WebSockets
 * Description: A WordPress integration plugin for Laravel Echo (https://github.com/laravel/echo) and Laravel WebSockets (https://github.com/beyondcode/laravel-websockets)
 * Version: 0.1.0
 * Author: Andrew Rhyand
 * Author URI: andrewrhyand.com
 * License: MIT
 * License URI: https://opensource.org/licenses/MIT
 */

if (!defined('ABSPATH')) {
    die('BoxyBird WebSockets does not allow direct access.');
}

if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
    die('BoxyBird WebSockets requires you run composer install and npm install.');
}

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/setup.php';
require_once __DIR__ . '/src/functions.php';
require_once __DIR__ . '/src/admin-settings.php';

BoxyBird\WebSockets\AuthEndpoints::init();
