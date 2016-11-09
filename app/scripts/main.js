;
/*=======================================
 =            Modules            =
 =======================================*/
/* Form handler module */
var FormHandler = (() => {
    var data, submit_form, url;
    // submit form function
    submit_form = (form, callbacks) => {
        url = $(form).attr('action');
        data = $(form).serializeArray();
        console.log('sending from javascript {' + data + '}');
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
    return {submit: submit_form};
})();

/* Ajax loader module :
 require:
 - bootstrap 4 modal
 - jquery 3
 */
var AjaxLoader = (function () {
    var $loading_icon = $(
        '<div class=\'spinner-content\'>' +
        '<i class=\'fa fa-circle-o-notch fa-spin fa-3x fa-fw\'>' +
        '<span class=\'sr-only\'>Loading</span></i>' +
        '</div>');
    var $overlay = $('<div class="spinner-overlay in"></div>');

    var showLoader = function () {
        $overlay.append($loading_icon);
        $('body').append($overlay);
    };

    var removeLoader = function () {
        $overlay.hide();
    };

    return {
        showLoader: showLoader,
        removeLoader: removeLoader
    }
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
            swal('Oops...', responseMsg.err[0], 'error');
        }
    };

    $('#form-user-signup').submit(function (event) {
        event.preventDefault();
        FormHandler.submit(this, {success: display_signup_result});
    });

    /*=====================================
     =      Login Scripts           =
     =====================================*/
    var displayUserMenu = (responseMsg) => {
        if (responseMsg.status) {
            console.log(responseMsg);
            AjaxLoader.removeLoader();
            $('#modal-login').modal('hide');
            $('#member_area').empty();
            $('#member_area').append(
                '<li class="nav-link">'+
                    '<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> ' +
                '<iclass="glyphicon glyphicon-log-in hide visible-xs "></i> Hi,'+ responseMsg.data.last_name.toUpperCase() +
                '<b class="caret"></b></a>'+
                    '<ul class="dropdown-menu dropdown-menu-right">'+
                        '<li class="dropdown-item"><a href="#"> Profile</a></li>'+
                        '<li class="dropdown-item"><a href="#"> Backed Projects</a></li>'+
                        '<li class="divider"></li>'+
                        '<li class="dropdown-item"><a href="controllers/do_logout.php" id="logoutBtn"> Log Out</a></li>'+
                    '</ul>'+
                '</li>'
            );

            if( $('#form-backup').length) {
                $('#form-backup').append(
                    '<input type="hidden" name="backerId" value="' + responseMsg.data.user_id + '">'
                    );
            }


        } else {
            swal('Ahh..', responseMsg.err[0], 'error');
        }
    };;

    $('#form-user-signin').submit(function (event) {
        event.preventDefault();
        FormHandler.submit(this, {
            beforeSend: AjaxLoader.showLoader,
            success: displayUserMenu
        });
    });


    /*=====================================
     =      Create Project Scripts           =
     =====================================*/
      var handle_create_project_result =(responseMsg)=> {
        console.log('Response data : \n' + responseMsg);
        if(responseMsg.status){
            console.log(responseMsg);
            AjaxLoader.removeLoader();
            $('#modal-create-project').modal('hide');
            // TODO: using a pop up to display is bad taste
            swal('Huray ..!', 'Your fund is on its way', 'success');
        } else {
            // TODO: bad taste
            console.log(responseMsg);
            AjaxLoader.removeLoader();
            swal('Oops...', responseMsg.err[0], 'error');

        }
    };

    $('#form-create-project').submit(function(event) {
        event.preventDefault();
        FormHandler.submit(this, {
            beforeSend: AjaxLoader.showLoader,
            success: handle_create_project_result
        });
    });

    /*=====================================
     =      Back Project Scripts           =
     =====================================*/
     var handle_backup_result =(responseMsg)=> {
        console.log('Response data : \n' + responseMsg);
        if(responseMsg.code == 1) {
            AjaxLoader.removeLoader();
            swal('Oops...', responseMsg.err[0], 'error');
            $('#modal-login').modal('show');
        } else {
            console.log(responseMsg);
            AjaxLoader.removeLoader();
            swal('Huray ..!', 'Thank you for your support!', 'success');
        }
    };

    $('#form-backup').submit(function(event) {
        event.preventDefault();
        FormHandler.submit(this, {
            beforeSend: AjaxLoader.showLoader,
            success: handle_backup_result
        });
    });


}); // do not remove this closing tag!