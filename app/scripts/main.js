$(document).ready(function(){
  $('.owl-carousel').owlCarousel({
      items: 1,
  	  autoplay: true,
  	  navigation : true, // Show next and prev buttons
      paginationSpeed : 400,
      singleItem:true,
      center: true,
      autoWidth:true,
      loop:true
      // "singleItem:true" is a shortcut for:
      // items : 1, 
      // itemsDesktop : false,
      // itemsDesktopSmall : false,
      // itemsTablet: false,
      // itemsMobile : false
  });
});