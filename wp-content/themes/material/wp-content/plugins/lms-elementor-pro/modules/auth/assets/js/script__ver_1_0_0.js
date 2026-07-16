(function ($) {

    var lmselementorAuthValidation = {

        init : function() {
            jQuery( 'body' ).delegate( '.lmselementor-pro-login-link', 'click', function(e){

                jQuery.ajax({
                    type: "POST",
                    url: lmselementor_urls.ajaxurl,
                    data:
                    {
                        action: 'lmselementor_pro_show_login_form_popup',
                        nonce: lmselementor_urls.nonce
                    },
                    success: function (response) {
    
                        jQuery('body').find('.lmselementor-pro-login-form-container').remove();
                        jQuery('body').find('.lmselementor-pro-login-form-overlay').remove();
                        jQuery('body').append(response);
    
                        jQuery('#user_login').focus();

                        lmselementorAuthValidation.addPlaceholder();
    
                    }
                });
    
                e.preventDefault();
    
            });
    
            jQuery( 'body' ).delegate( '.lmselementor-pro-login-form-overlay', 'click', function(e){
    
                jQuery('body').find('.lmselementor-pro-login-form-container').fadeOut();
                jQuery('body').find('.lmselementor-pro-login-form-overlay').fadeOut();
    
                e.preventDefault;
    
            });

        },

        addPlaceholder : function() {

            // Login Form Scripts
            $('#loginform input[id="user_login"]').attr('placeholder', 'Username');
            $('#loginform input[id="user_pass"]').attr('placeholder', 'Password');
            
            $('#loginform label[for="user_login"]').contents().filter(function() {
                return this.nodeType === 3;
            }).remove();
            $('#loginform label[for="user_pass"]').contents().filter(function() {
                return this.nodeType === 3;
            }).remove();
            
            $('input[type="checkbox"]').click(function() {
                $(this+':checked').parent('label').css("background-position","0px -20px");
                $(this).not(':checked').parent('label').css("background-position","0px 0px");
            });
        }

    }

    // Handle registration form submission
    $('#registrationform').on('submit', function(e) {
        e.preventDefault();

        var user_name  = $('#user_name').val();
        var password   = $('#user_password').val();
        var user_email = $('#user_email').val();
        var userrole   = $('#role').val();
        var lms_registration_nonce = $('#lms_registration_nonce_js').val();

        $.ajax({
            type: "POST",
            url: lmselementor_urls.ajaxurl,
            data: {
                action: 'lmselementor_pro_register_user_front_end',
                user_name: user_name,
                password: password,
                user_email: user_email,
                userrole: userrole, // Send selected role
                lms_registration_nonce: lms_registration_nonce
            },
            success: function(response) {
                if (response.success) {
                    $('.lmselementor-registration-alert').text(response.data.message).show();
                    // Optional: reset the form after successful registration
                    $('#registrationform')[0].reset();
                } else {
                    $('.lmselementor-registration-alert').text(response.data ? response.data.message : 'Registration failed').show();
                }
            },
            error: function(xhr) {
                var msg = 'Registration failed';
                try {
                    var r = JSON.parse(xhr.responseText);
                    if (r && r.data && r.data.message) msg = r.data.message;
                } catch(e) {}
                $('.lmselementor-registration-alert').text(msg).show();
            }
        });
    });

    "use strict";
    $(document).ready(function () {   
        lmselementorAuthValidation.init();

        // Custom register page
        if( ($('#signup-content').length) || ($('#signup-content').length) > 1 ) {
            $('body').addClass('wdt-custom-auth-form');
            $('.wrapper').addClass('wdt-custom-auth-form');
        }
    });

})(jQuery);