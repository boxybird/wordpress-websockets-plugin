import Echo from 'laravel-echo'

window.Pusher = require('pusher-js')

window.Echo = new Echo({
	broadcaster: 'pusher',
	namespace: '',
	key: BB_WS.settings.bb_ws_app_key,
	wsHost: BB_WS.settings.bb_ws_app_host,
	wsPort: parseInt(BB_WS.settings.bb_ws_app_host_port),
	wssPort: parseInt(BB_WS.settings.bb_ws_app_host_port),
	cluster: BB_WS.settings.bb_ws_app_cluster,
	encrypted: BB_WS.settings.bb_ws_encrypted ? true : false,
	disableStats: true,
	enabledTransports: ['ws', 'wss'],
	authEndpoint: `/wp-json/boxybird/pusher/v1/auth?_wpnonce=${BB_WS.nonce}`
})
