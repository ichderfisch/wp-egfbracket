<?php
/*
  Plugin Name: EGF Bracket
  Plugin URI: https://github.com/ichderfisch/wp-egfbracket
  Description: Plugin that adds a shortcode to display tournament brackets by the European Go Federation visible
  Version: 0.0.2
  Author: Dennis Fischer
  Author URI: http://www.ichderfisch.de
*/

// Prevent direct file access.
if (!defined ('ABSPATH')) exit;

/**
 * Add CSS & JS
 */
function register_egfbracket_css_js() {
  
  // Register CSS
  wp_register_style( 'egfbracket-css', plugins_url( 'wp-egfbracket/css/style.css' ) );
  
  // Register JS
  wp_register_script( 'egfbracket-raphael', plugins_url( 'wp-egfbracket/js/raphael.js' ) );
  wp_register_script( 'egfbracket-treant', plugins_url( 'wp-egfbracket/js/Treant_Round_Titles.js' ) );  
  
  // Enqueue them all
  wp_enqueue_style( 'egfbracket-css' );
  wp_enqueue_script( 'egfbracket-raphael' );
  wp_enqueue_script( 'egfbracket-treant' );
}

add_action( 'wp_enqueue_scripts', 'register_egfbracket_css_js' );



// Add Shortcode
function show_egfbrackets_results( $atts ) {

  // Attributes
  $atts = shortcode_atts(array(
      'id' => '1',
    ), $atts
  );
  
  $bracketIdCssUrl = 'http://www.eurogofed.org/newick/tournament.css?id=' . $atts['id'];
  $bracketIdJsUrl = 'http://www.eurogofed.org/newick/script.js?id=' . $atts['id'];
  
  $output = ' 
              <link rel="stylesheet" href="'. $bracketIdCssUrl . '">
              <script src="' . $bracketIdJsUrl . '"></script>
              
              <div class="chart' . $atts['id'] . ' alignCenter" id="tournament' . $atts['id']. '"></div> 
              <script> new Treant(tournament' . $atts['id'] .'); </script>';
  
  return $output;

}

add_shortcode( 'egf-bracket', 'show_egfbrackets_results' );

?>