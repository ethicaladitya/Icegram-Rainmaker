<?php

class DeactivationSurvey {

  function __construct($script, $link_form, $link_form_js, $slug, $plugin_name) {
    global $ig_deactivation_data;
    $this->script              = $script;
	$this->link_form     	   = $link_form;
    $this->link_js_file        = $link_form_js;
    $this->slug                = $slug;
    $this->plugin_name         = $plugin_name;
    $ig_deactivation_data[$slug] = array(
                                          'link_form' => $link_form,
                                          'link_form_js' => $link_form_js,
                                          );
    $this->init();
		}

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
    global $ig_deactivation_data;
    if(!$this->shouldShow()) {
       return;
     }
    wp_register_script( 'survey_js', $this->plugin_url . 'survey.js' );
    wp_enqueue_script( 'survey_js');
    wp_localize_script( 'survey_js',  'ig_deactivation_data', $slug);
   }


   public function css() {
     if(!$this->shouldShow()) {
       return;
     } 
     wp_register_style( 'survey_css', $this->plugin_url.'survey.css');
     wp_enqueue_style( 'survey_css' );
   }

    public function modal() {
     global $ig_deactivation_data;
     if(!$this->shouldShow()) {
       return;
     }
     
        ?>
          <div class="deactivate-survey-modal" id="deactivate-survey">
            <div class="deactivate-survey-wrap">
              <div class="deactivate-survey">
        
           <center><?php echo $this->script; ?></center>
        
              <a class="button" id="deactivate-survey-close">Close this window and deactivate <?php echo $this->plugin_name; ?> &rarr;</a>
              </div>
            </div>
          </div>
        <?php
        
    }
}
?>