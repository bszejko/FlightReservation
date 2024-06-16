(async () => {
    const mix = (await import('laravel-mix')).default;
    const tailwindcss = (await import('tailwindcss')).default;
    const BrowserSyncPlugin = (await import('browser-sync-webpack-plugin')).default;
  
    mix.js('resources/js/app.js', 'public/build/js')
       .postCss('resources/css/app.css', 'public/build/css', [
           tailwindcss,
       ])
       .setPublicPath('public'); // Set public path to public for manifest.json
  
    if (mix.inProduction()) {
        mix.version();
    }
  
    mix.webpackConfig({
        plugins: [
            new BrowserSyncPlugin({
                host: 'localhost',
                port: 3001,
                open: true,
                proxy: 'http://localhost:8000', // Twoja lokalna aplikacja Laravel
                files: [
                    'app/**/*.php',
                    'resources/views/**/*.php',
                    'resources/lang/**/*.php',
                    'routes/**/*.php',
                    'public/build/js/**/*.js',
                    'public/build/css/**/*.css'
                ]
            })
        ]
    });
  })();
  