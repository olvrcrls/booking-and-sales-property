const elixir = require('laravel-elixir');
require('laravel-elixir-vue-2');

elixir(mix => {
    mix.webpack('app.js');
});

elixir( mix => {
	mix.copy('node_modules/datatables.net/js/jquery.dataTables.js', 'public/js/dataTables.js')
		.copy('node_modules/datatables.net-bs/css/dataTables.bootstrap.css', 'public/css/dataTables.css')
		.copy('node_modules/datatables.net-bs/js/dataTables.bootstrap.js', 'public/js/dataTables-bs.js')
		.copy('node_modules/jquery/dist/jquery.min.js', 'public/js/jquery.min.js')
		;
})

elixir( mix => {
	mix.browserSync({
		proxy: '127.0.0.1:8000'
	});
});
