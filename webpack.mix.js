const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.styles([
    'resources/assets/web-stack/css/fonts/linecons/css/linecons.css',
    'resources/assets/web-stack/css/fonts/fontawesome/css/font-awesome.min.css',
    'resources/assets/web-stack/css/bootstrap.css',
    'resources/assets/web-stack/css/xenon-core.css',
    'resources/assets/web-stack/css/xenon-components.css',
    'resources/assets/web-stack/css/xenon-skins.css',
    'resources/assets/web-stack/css/nav.css'
], 'public/css/daoapp.css');

mix.copyDirectory('resources/assets/web-stack/css/fonts/fontawesome/fonts', 'public/fonts');
mix.copyDirectory('resources/assets/web-stack/css/fonts/linecons/font', 'public/font');
mix.copyDirectory('resources/assets/web-stack/images', 'public/img');

mix.scripts([
    'resources/assets/web-stack/js/jquery-1.11.1.min.js',
    'resources/assets/web-stack/js/bootstrap.min.js',
    'resources/assets/web-stack/js/TweenMax.min.js',
    'resources/assets/web-stack/js/resizeable.js',
    'resources/assets/web-stack/js/joinable.js',
    'resources/assets/web-stack/js/xenon-api.js',
    'resources/assets/web-stack/js/xenon-toggles.js',
    'resources/assets/web-stack/js/xenon-custom.js',
], 'public/js/daoapp.js');

// 三方库直接copy
mix.copyDirectory('resources/assets/ztree', 'public/static-third/ztree');
mix.copyDirectory('resources/assets/editormd', 'public/static-third/editormd');
mix.copyDirectory('resources/assets/layer', 'public/static-third/layer');

// wiki 资源
mix.styles([
    'resources/assets/wiki/css/app.css',
    'resources/assets/admin/wiki/css/custom.css'
], 'public/static-wiki/css/app.css');
mix.scripts([
    'resources/assets/wiki/js/ztree.config.js'
], 'public/static-wiki/js/app.js');
// Wiki 资源 - 复用部分 Wiki后台管理资源
mix.copyDirectory('resources/assets/admin/wiki/img/', 'public/static-wiki/img');
mix.copyDirectory('resources/assets/admin/wiki/img/', 'public/static-admin/wiki/img');

// 后台管理 - Wiki 资源
mix.styles([
    'resources/assets/admin/wiki/css/custom.css'
], 'public/static-admin/wiki/css/app.css');

mix.scripts([
    'resources/assets/admin/wiki/js/ztree.config.js',
    'resources/assets/admin/wiki/js/editor.md.config.js'
], 'public/static-admin/wiki/js/app.js');
// 公共资源-JS
mix.scripts([
    'resources/assets/common/js/jquery-1.11.1.min.js',
    'resources/assets/common/js/jquery.form.js',
    'resources/assets/common/js/TweenMax.min.js',
    'resources/assets/common/js/resizeable.js',
    'resources/assets/common/js/joinable.js',
    'resources/assets/common/js/bootstrap.min.js',
    // 'resources/assets/common/js/xenon-api.js',
    // 'resources/assets/common/js/xenon-toggles.js',
    // 'resources/assets/common/js/xenon-custom.js',
], 'public/static-common/js/common.js');

// 公共资源-CSS
mix.styles([
    'resources/assets/common/css/font-awesome.min.css',
    'resources/assets/common/css/linecons.css',
    'resources/assets/common/css/bootstrap.css',
    // 'resources/assets/common/css/xenon-components.css',
    'resources/assets/common/css/xenon-core.css',
    // 'resources/assets/common/css/xenon-forms.css',
    // 'resources/assets/common/css/xenon-skins.css',
    'resources/assets/common/css/common.css',
], 'public/static-common/css/common.css');
mix.version();