;
/*=======================================
 =            Functionalities            =
 =======================================*/

var ADD_USER = (function (self, $) {
    var data, submit_form;

    // submit form function
    submit_form = function ($form, callbacks) {
        data = $($form).serializeArray();
        data.push({name: 'register', value: 1});
        console.log('sending from javascript {' + data + '}');
        $.ajax({
            type: 'POST',
            url: './controllers/do_register.php',
            data: data,
            beforeSend: function () {
                if (callbacks.beforeSend) callbacks.beforeSend();
                else console.log('sending ......');
            },
            success: function (responseMessage) {
                if (callbacks.success) {
                    callbacks.success(responseMessage);
                } else {
                    console.log('Response data: {\n' + responseMessage + '}\n');
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

$(function () {
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

    $('.search-trigger').click(function () {
        $('.search-bar').addClass('is-active');
        $('.search-bar-input').focus();
    });

    $('.search-close').click(function (e) {
        $('.search-bar').removeClass('is-active');
    });

    /* Checkbox theme configuration */
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-orange',
        radioClass: 'iradio_square-orange',
        increaseArea: '25%' // optional
    });

    /*=====================================
     =      Registration scripts           =
     =====================================*/

    var display_signup_result = function (responseMsg) {
        console.log('Response data : \n' + responseMsg);
        if (responseMsg.status) {
            console.log(responseMsg);
            $('#modal-sign-up').modal('hide');
            swal('Huray ..!', 'You are now a proud backer', 'success');
        } else {
            swal(
                'Oops...',
                responseMsg.err[0],
                'error'
            )
        }
    };

    $('#form-user-signup').submit(function (event) {
        event.preventDefault();
        ADD_USER.submit(this, {
            success: display_signup_result
        });
    });

}); // do not remove this closing tag!