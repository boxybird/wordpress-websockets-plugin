let mix = require('laravel-mix')

mix.setPublicPath('./')

mix.js('resources/src/js/bb-ws.js', 'assets/js')

if (mix.inProduction()) {
	mix.version()
}
