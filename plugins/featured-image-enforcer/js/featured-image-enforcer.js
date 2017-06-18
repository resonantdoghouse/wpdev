jQuery(document).ready(function($){

  $('#publish').on('click', function(event){
    if( $('#set-post-thumbnail img').length == 0 ){
      event.preventDefault();
      alert('Please select a featured image');
    }
  });
  
});
