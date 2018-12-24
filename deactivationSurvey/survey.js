jQuery(function(){

    var deactivateLinkTr = jQuery('#the-list').find('tr');
    jQuery.each(deactivateLinkTr, function(){
        var data_slug = jQuery(this).data("slug");
        if(data_slug in ig_deactivation_data ) {
          var deactivateLink = jQuery(this).find('span.deactivate a');
          // var deactivateLink = jQuery('#the-list').find('[data-slug="'+data+'"] span.deactivate a');
          if(deactivateLink.length > 0){
            var overlay = jQuery('#deactivate-survey');
            var closeButton = jQuery('#deactivate-survey-close');
            var formOpen = false;

            jQuery(deactivateLink).on('click', function(event) {
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
          }
        }

    });

});

