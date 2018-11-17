<?php
/*
 * Plugin Name: Rainmaker - The Best Readymade WP Forms Plugin
 * Plugin URI: http://www.icegram.com/addons/icegram-rainmaker/
 * Description: The complete solution to create simple forms and collect leads
 * Version: 0.35
 * Author: icegram
 * Author URI: http://www.icegram.com/
 *
 * Copyright (c) 2016 Icegram
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 * Text Domain: icegram-rainmaker
 * Domain Path: /lang/
*/

function initialize_icegram_rainmaker() {
    // i18n / l10n - load translations
    load_plugin_textdomain( 'icegram-rainmaker', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' ); 
    include_once 'classes/class-icegram-rainmaker.php'; 
    new Rainmaker();
}

function install_icegram_rainmaker(){
	    // Redirect to welcome screen 
        delete_option( '_icegram_rm_activation_redirect' );      
        add_option( '_icegram_rm_activation_redirect', 'pending' );
}

add_action( 'plugins_loaded', 'initialize_icegram_rainmaker' );
register_activation_hook( __FILE__,  'install_icegram_rainmaker');

$plugin_dir_path = dirname(__FILE__);
require_once $plugin_dir_path.'../deactivationSurvey/DeactivationSurvey.php'; 

load_plugin_textdomain( 'icegram-rainmaker', false, dirname( plugin_basename( __FILE__ ) ) . '/deactivationSurvey/' ); 
add_action( 'plugins_loaded', 'setupDeactivationSurvey' );

function setupDeactivationSurvey() {

	if ( ! class_exists( 'deactivationSurvey' ) ) {
			require_once 'deactivationSurvey/DeactivationSurvey.php';
	}

	$slug               = 'icegram-rainmaker';
    $link_js_file       = 'https://secure.polldaddy.com/p/10143671.js';
    $link_form          = 'https://poll.fm/10143671'

    $survey = new deactivationSurvey( $slug, $link_js_file, $link_form );
    $survey->init();
}