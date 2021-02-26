const mix = require("laravel-mix");

mix.webpackConfig({
    module: {
        rules: [
            {
                test: /\.pug$/,
                oneOf: [
                    {
                        resourceQuery: /^\?vue/,
                        use: ["pug-plain-loader"]
                    },
                    {
                        use: ["raw-loader", "pug-plain-loader"]
                    }
                ]
            }
        ]
    }
});

mix.disableNotifications(); //for no notifications
mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .browserSync({
        proxy: "127.0.0.1:8000"
    });
