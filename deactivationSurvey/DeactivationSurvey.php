<?php

class DeactivationSurvey {

<<<<<<< HEAD
  function __construct( $link_form, $link_form_js, $slug, $pluginname ) {	
    $data = array  
    (
      array($slug,$link_form,$link_form_js,$pluginname)
=======
  function __construct( $link_form, $link_form_js, $slug ) {	
    $data = array  
    (
      array($slug,$link_form,$link_form_js)
>>>>>>> 2a00ef72f077d9a2c175c577012949211c1df2fa
    );		
	//	$this->link_form              = $link_form;
	//	$this->link_js_file           = $link_form_js;
  // $this->slug                   = $slug;
  //  $ig_deactivation_slugs[$slug] = $slug;
    $this->plugin_url             = untrailingslashit( plugins_url( '/', __FILE__ ) ) .'/';
    $this->init();
		}

  public function init() {
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
    global $data;
    if(!$this->shouldShow()) {
       return;
     }
    wp_register_script( 'survey_js', $this->plugin_url . 'survey.js' );
    wp_enqueue_script( 'survey_js');
    wp_localize_script( 'survey_js', 'data', $data );
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
     echo ": In stock: ".$data[0][1].", sold: ".$data[0][2].".<br>";
  ?>
    <div class="deactivate-survey-modal" id="deactivate-survey">
      <div class="deactivate-survey-wrap">
        <div class="deactivate-survey">
  
     <center><script type="text/javascript" charset="utf-8" src="<?php echo $data[2][0]; ?> "></script>
     <noscript><a href="<?php echo "$data[1][0]"; ?>">Why are you deactivating <?php echo $data[3][0] ?></a></noscript></center>
  
        <a class="button" id="deactivate-survey-close">Close this window and deactivate &rarr;</a>
        </div>
      </div>
    </div>
  <?php
      }
}
?>