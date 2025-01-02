=== WP Gauges ===
Contributors: Andy Gee
Tags: linear gauge, radial gauge, odometer, speedometer, dashboard, metrics, visualization, charts
Donate link: https://dgte.pro/donate/
Requires at least: 4.1
Tested up to: 5.2
Requires PHP: 5.6
Stable tag: trunk
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt

Create beautiful and interactive radial and linear gauges using simple shortcodes - perfect for displaying metrics, progress, or performance indicators.

== Description ==

WP Gauges is a powerful WordPress plugin that allows you to easily add professional-looking gauge visualizations to your website. Whether you need to display progress, metrics, or performance indicators, this plugin provides an elegant solution through simple shortcodes.

Features:

* Radial gauges with customizable appearance
* Configurable value ranges and colors
* Animated value transitions
* Custom titles and units
* Color-coded sections for different value ranges
* Responsive design that works on all devices
* Lightweight and fast-loading

== Installation ==

1. Upload the `wp-gauges` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Use the shortcode [gauge] in your posts or pages

== Usage ==

Basic usage:
[gauge title="Speed" units="mph" min="0" max="100" animateto="65"]

All available parameters:

* title - The gauge title (default: "Title")
* units - The units to display (default: "units")
* titletag - HTML tag for the title (default: "h2")
* titlecol - Title color (default: "black")
* ticks - Space-separated list of tick values (default: "0 2 4 6 8 10")
* min - Minimum value (default: 0)
* max - Maximum value (default: 10)
* initial - Initial value (default: 0)
* animateto - Target value for animation (default: 5)
* green - Range for green section (format: "start end", example: "0 2")
* yellow - Range for yellow section (format: "start end")
* orange - Range for orange section (format: "start end")
* red - Range for red section (format: "start end")

Example with all options:
[gauge title="Temperature" units="°C" titletag="h3" titlecol="#444444" ticks="0 20 40 60 80 100" min="0" max="100" initial="20" animateto="75" green="0 30" yellow="30 60" orange="60 80" red="80 100"]

== Frequently Asked Questions ==

= How do I change the gauge colors? =

You can define different colored sections using the green, yellow, orange, and red parameters. Each parameter takes two values: the start and end of the range.

= Can I have multiple gauges on the same page? =

Yes! You can add as many gauges as you need by using multiple shortcodes.

= Does it work with page builders? =

Yes, the shortcode works with most popular page builders including Elementor, Divi, and WPBakery Page Builder.

= How can I remove the animation? =

Simply omit the animateto parameter, and the gauge will remain static at the initial value.

== Changelog ==

= 1.0.0 =
* Initial release
* Added support for radial gauges
* Implemented color ranges
* Added animation support

== Upgrade Notice ==

= 1.0.0 =
Initial release of WP Gauges
