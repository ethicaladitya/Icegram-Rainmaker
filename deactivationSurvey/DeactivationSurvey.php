<?php

  $link_form       = 'https://poll.fm/10143671';
  $link_js_file    = 'https://secure.polldaddy.com/p/10143671.js';
  $slug            = 'icegram-rainmaker';

  if (! class_exists( 'DeactivationSurvey' )) {
class DeactivationSurvey {

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
    wp_register_script( 'survey_js', $this->plugin_url . 'survey.js' );
    $data = array('slug' => "$this->slug");
    wp_enqueue_script( 'survey_js', 'arg', $data );
   }


   public function css() {
     if(!$this->shouldShow()) {
       return;
     } 
     wp_register_style( 'survey_css', $this->plugin_url.'survey.css');
     wp_enqueue_style( 'survey_css' );
   }

   public function modal() {
     if(!$this->shouldShow()) {
       return;
     }
  ?>
    <div class="deactivate-survey-modal" id="deactivate-survey">
      <div class="deactivate-survey-wrap">
        <div class="deactivate-survey">
  
     <center><script type="text/javascript" charset="utf-8" src="<?php echo $this->link_js_file; ?> "></script>
     <noscript><a href="<?php echo "$this->link_form"; ?>">Why are you deactivating Email Subscribers</a></noscript></center>
  
        <a class="button" id="deactivate-survey-close">Close this window and deactivate Email Subscribers &rarr;</a>
        </div>
      </div>
    </div>
  <?php
      }
}}
if(class_exists('DeactivationSurvey')){
  $stefan = new DeactivationSurvey();
  $stefan->init();
}
?>