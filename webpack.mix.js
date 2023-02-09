// webpack.mix.js

const mix = require('laravel-mix');

// mix.setPublicPath('./public');
mix.setResourceRoot('./resources');

mix.options({
    fileLoaderDirs:  {
        fonts: '../resources/fonts',
        images: '../resources/images',
    }
});

mix.webpackConfig({
    externals: {
        "jquery": "jQuery",
    },
    stats: {
        children: true,
    },
});

// ADMIN
mix.js('resources/scripts/admin.js', 'js').setPublicPath('./assets/js');
mix.sass('resources/styles/admin.scss', 'css').setPublicPath('./assets/css');

// FRONTEND
mix.js('resources/scripts/frontend.js', 'js').setPublicPath('./assets/js');
mix.sass('resources/styles/frontend.scss', 'css').setPublicPath('./assets/css');