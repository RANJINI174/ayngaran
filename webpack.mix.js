const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

 mix.js('resources/assets/js/advancedform.js', 'public/assets/js')
 mix.js('resources/assets/js/apexcharts.js', 'public/assets/js')
 mix.js('resources/assets/js/chart.js', 'public/assets/js')
 mix.js('resources/assets/js/charts.js', 'public/assets/js')
 mix.js('resources/assets/js/chat.js', 'public/assets/js')
 mix.js('resources/assets/js/color-change.js', 'public/assets/js')
 mix.js('resources/assets/js/construction.js', 'public/assets/js')
 mix.js('resources/assets/js/custom.js', 'public/assets/js')
 mix.js('resources/assets/js/datatable.js', 'public/assets/js')
 mix.js('resources/assets/js/echarts.js', 'public/assets/js')
 mix.js('resources/assets/js/flot.js', 'public/assets/js')
 mix.js('resources/assets/js/formeditor.js', 'public/assets/js')
 mix.js('resources/assets/js/form-editor2.js', 'public/assets/js')
 mix.js('resources/assets/js/formelementadvnced.js', 'public/assets/js')
 mix.js('resources/assets/js/form-elements.js', 'public/assets/js')
 mix.js('resources/assets/js/form-validation.js', 'public/assets/js')
 mix.js('resources/assets/js/form-wizard.js', 'public/assets/js')
 mix.js('resources/assets/js/form-wizard-rtl.js', 'public/assets/js')
 mix.js('resources/assets/js/fullcalendar.js', 'public/assets/js')
 mix.js('resources/assets/js/index.js', 'public/assets/js')
 mix.js('resources/assets/js/index1.js', 'public/assets/js')
 mix.js('resources/assets/js/jquery.sparkline.min.js', 'public/assets/js')
 mix.js('resources/assets/js/jvectormap.js', 'public/assets/js')
 mix.js('resources/assets/js/left-menu.js', 'public/assets/js')
 mix.js('resources/assets/js/mapelmaps.js', 'public/assets/js')
 mix.js('resources/assets/js/map-leafleft.js', 'public/assets/js')
 mix.js('resources/assets/js/modal.js', 'public/assets/js')
 mix.js('resources/assets/js/morris.js', 'public/assets/js')
 mix.js('resources/assets/js/nvd3.js', 'public/assets/js')
 mix.js('resources/assets/js/range.js', 'public/assets/js')
 mix.js('resources/assets/js/rangeslider.js', 'public/assets/js')
 mix.js('resources/assets/js/select2.js', 'public/assets/js')
 mix.js('resources/assets/js/sticky.js', 'public/assets/js')
 mix.js('resources/assets/js/stiky.js', 'public/assets/js')
 mix.js('resources/assets/js/summernote.js', 'public/assets/js')
 mix.js('resources/assets/js/sweet-alert.js', 'public/assets/js')
 mix.js('resources/assets/js/table-data.js', 'public/assets/js')
 mix.js('resources/assets/js/timline.js', 'public/assets/js')
 mix.js('resources/assets/js/tooltip&popover.js', 'public/assets/js')
 mix.js('resources/assets/js/widget.js', 'public/assets/js')
 mix.sass('resources/assets/scss/style.scss', 'public/assets/css')
 mix.sass('resources/assets/css/skin-modes.scss', 'public/assets/css')
 mix.sass('resources/assets/css/sidemenu.scss', 'public/assets/css')
 mix.sass('resources/assets/css/sidemenu-icon.scss', 'public/assets/css')
 mix.sass('resources/assets/css/sidemenu-icontext.scss', 'public/assets/css')
 mix.sass('resources/assets/css/dark-style.scss', 'public/assets/css')
 mix.postCss('resources/assets/css/animated.css', 'public/assets/css')
 mix.sass('resources/assets/colors/color1.scss', 'public/assets/colors')
 mix.copyDirectory('resources/assets/images', 'public/assets/images')
 mix.copyDirectory('resources/assets/plugins', 'public/assets/plugins')
 mix.copyDirectory('resources/assets/iconfonts', 'public/assets/iconfonts')
 
 mix.options({
     processCssUrls: false
 });

 mix.browserSync('http://127.0.0.1:8000');


