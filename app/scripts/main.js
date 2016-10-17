;
/*=======================================
 =            Modules            =
 =======================================*/
var FormHandler = (() => {
    var data, submit_form, url;
    // submit form function
    submit_form = (form, callbacks) => {
        url = $(form).attr('action');
        data = $(form).serializeArray();
        data.push({name: 'register', value: 1});
        console.log('sending from javascript {' + data + '}');
        console.log(form);
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            beforeSend: ()=> {
                if (callbacks.beforeSend) callbacks.beforeSend();
                else console.log('sending ......');
            },
            success: (responseMessage) => {
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
})();

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
    });

    /* Search trigger configuration */

    $('.search-trigger').click(() => {
        $('.search-bar').addClass('is-active');
        $('.search-bar-input').focus();
    });

    $('.search-close').click((e)=>
        $('.search-bar').removeClass('is-active'));

    /* Checkbox theme configuration */
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-orange',
        radioClass: 'iradio_square-orange',
        increaseArea: '20%' // optional
    });

    /*=====================================
     =      Registration scripts           =
     =====================================*/


    var display_signup_result = (responseMsg)=> {
        console.log('Response data : \n' + responseMsg);
        if (responseMsg.status) {
            console.log(responseMsg);
            $('#modal-sign-up').modal('hide');
            // TODO: using a pop up to display is bad taste
            swal('Huray ..!', 'You are now a proud backer', 'success');
        } else {
            // TODO: bad taste
            swal(
                'Oops...',
                responseMsg.err[0],
                'error'
            )
        }
    };

    $('#form-user-signup').submit(function () {
        event.preventDefault();
        FormHandler.submit(this, {success: display_signup_result});

    });

    /*=====================================
     =      Login Scripts           =
     =====================================*/

    var refreshPage = function () {

    }
    
    $("#form-user-signin").submit(function (event) {
        event.preventDefault();
        FormHandler.submit(this, {success: refreshPage()});
    });


}); // do not remove this closing tag!