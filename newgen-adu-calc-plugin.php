<?php
/*
** Plugin Name: ADU Calculator Shortcode
** Author: Keokee
** Author URI: http://keokee.com
** Version: 1.0
** Description: A shortcode to display the ADU calculator
** 
*/

if ( ! defined( 'ABSPATH' ) ) exit;

// Register shortcode JS
wp_register_script('adu-calculator-script', plugins_url('/js/adu-calculator.js', __FILE__), [], '1.0', true);


function add_calculator_shortcode() {
  // exit if not page
  if (!is_page()) return;

  // parse page for shortcode
  $page_content = get_the_content();
  $has_shortcode = has_shortcode($page_content, 'adu-calculator');

  // exit if page does not have shortcode
  if(!$has_shortcode) return;

  // enqueue script
  wp_enqueue_script('adu-calculator-script');

  ob_start();
  // import template
  include(plugin_dir_path(__FILE__) . 'templates/adu-calculator.php');

  $output = ob_get_clean();

  // return output html
  return $output;
  
}
add_shortcode('adu-calculator', 'add_calculator_shortcode');