<?php

class DeactivationSurvey {
  var $plugin_url;
  public function init() {

    $this->plugin_url   = untrailingslashit( plugins_url( '/', __FILE__ ) ) .'/';
    add_action('admin_print_scripts', array($this, 'js'), 20);
    add_action('admin_print_scripts', array($this, 'css'));
    add_action('admin_footer', array($this, 'modal'));
  }

  private function shouldShow() {
    if(!function_exists('get_current_screen')) {
      return false;
    }
    $screen = get_current_screen();
    if(!is_object($screen)) {
      return false;
    }
    return (in_array(get_current_screen()->id, array('plugins', 'plugins-network'), true));
  }

   public function js() {
    if(!$this->shouldShow()) {
       return;
     }
    wp_register_script( 'survey_js', $this->plugin_url.'../deactivationSurvey/js.js');
    wp_enqueue_script( 'survey_js' );
   }


   public function css() {
     if(!$this->shouldShow()) {
       return;
     }
     wp_register_style( 'survey_css', $this->plugin_url.'../deactivationSurvey/css.css');
     wp_enqueue_style( 'survey_css' );
   }

   public function modal() {
     if(!$this->shouldShow()) {
       return;
     }
     include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'index.html'); 
   }
}
