<?php
/*
** Plugin Name: ADU Calculator Shortcode
** Author: Keokee
** Author URI: http://keokee.com
** Version: 1.1
** Description: A shortcode to display the ADU calculator
** 
*/

if ( ! defined( 'ABSPATH' ) ) exit;

// Register shortcode JS
function adu_calc_shortcode_js() {
  wp_register_script('adu-calculator-script', plugins_url('/js/adu-calculator.js', __FILE__), [], '1.0', true);
}
add_action('wp_enqueue_scripts', 'adu_calc_shortcode_js');


function add_calculator_shortcode() {
  
  // parse page for shortcode
  $page_content = get_the_content();
  $has_shortcode = has_shortcode($page_content, 'adu-calculator');

  // exit if page does not have shortcode
  if(!$has_shortcode) return;

  // enqueue script
  wp_enqueue_script('adu-calculator-script');

  // import template
  // include(plugin_dir_path(__FILE__) . 'templates/template.html');
  
  ob_start();
  ?>
  <div id="adu-calculator">

    <div class="calc-selectors">
      <div class="calc-selector" data-key="attached">Attached ADU</div>
      <div class="calc-selector" data-key="detached">Detached ADU</div>
      <div class="calc-selector" data-key="garage">Garage ADU</div>
    </div>

    <div class="field-group">
      <label for="attached-sqft">Attached ADU Sqft</label>
      <input name="attached-sqft" data-key="attached" type="range" step="10" max="1100">
      <input type="number" step="10" min="350" max="1100">
    </div>

    <div class="output">
      <h3>Estimated Cost</h3>
      <h2>$0</h2>
    </div>

  </div>
<?php

  $output = ob_get_clean();

  // return output html
  return $output;
  
}
add_shortcode('adu-calculator', 'add_calculator_shortcode');