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

add_action( 'plugins_loaded', 'rm_setupDeactivationSurvey' );

function rm_setupDeactivationSurvey() {
    $plugin_dir_path = dirname(__FILE__);
	if ( ! class_exists( 'deactivationSurvey' ) ) {
        require_once $plugin_dir_path.'/deactivationSurvey/DeactivationSurvey.php';
	}

    $link_form       = 'https://poll.fm/10178602';
    $link_js_file    = 'https://secure.polldaddy.com/p/10178602.js';
    $slug            = 'icegram-rainmaker';
	$script			 = '<script type="text/javascript" charset="utf-8" src="https://secure.polldaddy.com/p/10178602.js"></script><noscript><a href="https://poll.fm/10178602">Why are you deactivating Rainmaker </a></noscript>'

    new deactivationSurvey($script, $link_form, $link_form_js, $slug, $plugin_name);
}