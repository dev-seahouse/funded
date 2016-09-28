;
/*=======================================
=            Functionalities            =
=======================================*/

var ADD_USER = (function(self, $) {
  var data, submit_form;

  // submit form function
  submit_form = function($form, callbacks) {
    data = $($form).serialize();
    console.log("sending from javascript {" + data + "}");

    $.ajax({

      type: 'POST',
      url: './controllers/register.php',
      data: data,
      beforeSend: function() {
        if (callbacks.beforeSend) callbacks.beforeSend();
        else console.log("sending ......");
      },
      success: function(data) {
        if (callbacks.success) {
          callbacks.success(data);
        } else {
          console.log("Response data: {\n" + data + "}\n");
        }
      }
    });
  };
  // end submit_form function

  return {
    submit: submit_form
  };

})(ADD_USER || {}, jQuery);


/*==============================================
=            Document.ready            =
==============================================*/

$(document).ready(function() {
  /*========================================
  =            Global functions            =
  ========================================*/

  /* Carousel module configuration */
  $('.owl-carousel').owlCarousel({
    items: 1,
    autoplay: true,
    navigation: true, // Show next and prev buttons
    paginationSpeed: 400,
    singleItem: true,
    center: true,
    autoWidth: true,
    loop: true
      // "singleItem:true" is a shortcut for:
      // items : 1,
      // itemsDesktop : false,
      // itemsDesktopSmall : false,
      // itemsTablet: false,
      // itemsMobile : false
  });

  /* Search trigger configuration */

  $('.search-trigger').click(function() {
    $('.search-bar').addClass('is-active');
    $('.search-bar-input').focus();
  });

  $('.search-close').click(function(e) {
    $('.search-bar').removeClass('is-active');
  })

  /* Checkbox theme configuration */
  $('input').iCheck({
    checkboxClass: 'icheckbox_square-orange',
    radioClass: 'iradio_square-orange',
    increaseArea: '20%' // optional
  });

  /*=====================================
  =      Registration scripts           =
  =====================================*/

  var display_signup_result = function(data) {
    console.log("Response data : \n" + data);

    if (data.trim() == 0) {
      console.log("duplicate record on insert "); // NOTE: REMOVE THIS ON PRODUCTION!


    } else if (data.trim() == 1) {
      console.log("registered");
      $("#modal-sign-up").modal('hide');
    } else {
      console.log("failed");
    }
  }

  var display_login_result = function(data) {
    console.log("Response data : \n" + data);
  }

  $("#form-user-signup").submit(function(event) {
    event.preventDefault();
    ADD_USER.submit(this, {
      success: display_signup_result
    });
  });

  $("#form-user-login").submit(function(event) {
    event.preventDefault();
    $.ajax({
      type: 'POST',
      url: './controllers/login.php',
      data: $ ('#form-user-login').serialize(),
      success: display_login_result
    });
  });



}); // do not remove this closing tag!