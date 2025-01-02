<?php

/**
 * The plugin bootstrap file
 *
 * @link              https://dgte.pro
 * @since             1.0.0
 * @package           Wp_Gauges
 *
 * @wordpress-plugin
 * Plugin Name:       WP Gauges
 * Plugin URI:        https://dgte.pro/plugins/wp-gauges/
 * Description:       Shortcodes for radian and linear gauges
 * Version:           1.0.0
 * Author:            Andy Gee
 * Author URI:        https://dgte.pro
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-gauges
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
  die;
}
define('WP_GAUGES_VERSION', '1.0.0');

// Add admin menu
add_action('admin_menu', function() {
    add_menu_page(
        'WP Gauges',
        'WP Gauges',
        'manage_options',
        'wp-gauges',
        'wp_gauges_admin_page',
        'dashicons-gauge',
        30
    );
});

// Include admin files
require_once plugin_dir_path(__FILE__) . 'admin/shortcode-generator.php';

// Enqueue admin scripts and styles
add_action('admin_enqueue_scripts', function($hook) {
    if ('toplevel_page_wp-gauges' !== $hook) {
        return;
    }

    wp_enqueue_style(
        'wp-gauges-admin',
        plugin_dir_url(__FILE__) . 'admin/css/shortcode-generator.css',
        array(),
        WP_GAUGES_VERSION
    );

    wp_enqueue_script(
        'wp-gauges-admin',
        plugin_dir_url(__FILE__) . 'admin/js/shortcode-generator.js',
        array('jquery'),
        WP_GAUGES_VERSION,
        true
    );
});

add_action('wp_enqueue_scripts', function () {
  global $post;
  $dir = plugin_dir_url(__FILE__);
  if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'gauge')) {
    wp_enqueue_style('gauge-style',  $dir . 'assets/fonts/fonts.css');
    wp_enqueue_script('gauge-script',  $dir . 'assets/js/gauge.min.js', array(), '1.0.0', false);
    wp_enqueue_script('gaugeviewport-script',  $dir . 'assets/js/viewport.js', array(), '1.0.0', true);
  }
});

add_action('init', function () {
  add_shortcode('gauge', function ($a) {
    extract(shortcode_atts(array(
      'title' => 'Title',
      'units' => 'units',
      'titletag' => 'h2',
      'titlecol' => 'black',
      'ticks' => '0 2 4 6 8 10',
      'min' => 0,
      'max' => 10,
      'initial' => 0,
      'animateto' => 5,
      'green' => '0 2',
      'yellow' => '2 4',
      'orange' => '4 6',
      'red' => '6 10',
    ), $a));
    // pre($a);
    $html = [];
    if ($a['ticks'] != '') {
      $a['ticks'] = array_values(array_map('intval', explode(' ', $a['ticks'])));
    }

    $highlights = [];
    $barColors = [
      'green' => '0,255,0,.15',
      'yellow' => '255,255,0,.15',
      'orange' => '255,127,0,.15',
      'red' => '255,0,0,.15',
      'projection' => '255,127,0,1',
    ];
    foreach ($barColors as $color => $rgba) {
      if (isset($a[$color]) && $a[$color] != '') {
        $ex = array_values(array_map('trim', explode(' ', $a[$color])));
        if (count($ex) == 2) {
          $highlights[] = array('from' => $ex[0], 'to' => $ex[1], 'color' => 'rgba(' . $rgba . ')');
        }
      }
    }
    $gid = uniqid();


    $a['titletag'] = isset($a['titletag']) ? $a['titletag'] : 'h2';
    $a['titlecol'] = isset($a['titlecol']) ? $a['titlecol'] : '#000';

    $html[] = '
		<div class="text-center">
			<' . $a['titletag'] . ' style="color:' . $a['titlecol'] . '">' . $a['title'] . '</' . $a['titletag'] . '>
			<canvas id="g' . $gid . '" class="w100 ' . ($a['animateto'] != '' ? 'animation' : '') . '" data-animateto="' . $a['animateto'] . '"></canvas>
		</div>
		<script>
		wpgauges["g' . $gid . '"] = new RadialGauge({
			renderTo: "g' . $gid . '",
			minValue: ' . $a['min'] . ',
			maxValue: ' . $a['max'] . ',
			value: ' . $a['min'] . ',
			units: "' . $a['units'] . '",
			majorTicks: ' . json_encode($a['ticks']) . ',
			animationRule: "bounce",
			animationDuration: 750,
			animatedValue: true,
			colorBarProgress: "rgba(50,200,50,.75)",
			highlights: ' . json_encode($highlights) . ',
		}).draw();
		</script>';
    return (implode('', $html));
  });
});
