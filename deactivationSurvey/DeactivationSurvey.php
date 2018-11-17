<?php

class DeactivationSurvey {
  function __construct( $slug, $link_js_file, $link_form ) {
    
    $this->link_js_file        = $link_js_file;
    $this->link_form           = $link_form;
    $this->slug                = $slug;
  }
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
     <script>
     console.log('in js');
     jQuery(function(){
     console.log('in js12');
       var deactivateLink = jQuery('#the-list').find('[data-slug="<?php echo $slug?>"] span.deactivate a');
       var overlay = jQuery('#deactivate-survey');
       var closeButton = jQuery('#deactivate-survey-close');
       var formOpen = false;
     
       deactivateLink.on('click', function(event) {
         console.log('in click here');
         event.preventDefault();
         overlay.css('display', 'table');
         formOpen = true;
       });
     
       closeButton.on('click', function(event) {
         event.preventDefault();
         overlay.css('display', 'none');
         formOpen = false;
         location.href = deactivateLink.attr('href');
       });
     
       jQuery(document).keyup(function(event) {
         if ((event.keyCode === 27) && formOpen) {
           location.href = deactivateLink.attr('href');
         }
       });
     });
     
     </script>
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
     <html>
     <div class="deactivate-survey-modal" id="deactivate-survey">
  <div class="deactivate-survey-wrap">
    <div class="deactivate-survey">

<center><script type="text/javascript" charset="utf-8" src="<?php echo "$link_js_file" ?>"></script> 
<noscript><a href="<?php echo $link_form?>">Why are you deactivating Email Subscribers</a></noscript></center>

      <a class="button" id="deactivate-survey-close">Close this window and deactivate Email Subscribers &rarr;</a>
    </div>
  </div>
</div></html>
   }
}
