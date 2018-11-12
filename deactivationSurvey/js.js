console.log('in js');
jQuery(function(){
console.log('in js12');
  var deactivateLink = jQuery('#the-list').find('[data-slug="icegram-rainmaker"] span.deactivate a');
  var overlay = jQuery('#rm-deactivate-survey');
  var closeButton = jQuery('#rm-deactivate-survey-close');
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

