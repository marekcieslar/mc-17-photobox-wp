<?php
/*
 * Plugin Name: MC 2017 photobox
 * Plugin URI: http://marekcieslar.pl
 * Author: Marek Cieślar
 * Description: opening on fullscreen image with close, prev, next buttons on gallery
 * Author URI: http://marekcieslar.pl
 * Version: 0.0.1
 * License: GPLv2
 */

require_once ( plugin_dir_path ( __FILE__ ) . 'mc-17-photobox-work.php');

function mc_17_scripts () {
    wp_enqueue_style ( 'mc-17-style', plugin_dir_url ( __FILE__ ) . 'mc-17-photobox-style.css');
    wp_enqueue_script ( 'mc-17-script', plugin_dir_url ( __FILE__) . 'mc-17-photobox-app.js', $deps = array(), $ver = false, $in_footer = true);
}
add_action( 'wp_enqueue_scripts', 'mc_17_scripts' );