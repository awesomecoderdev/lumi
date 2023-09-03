$( document ).ready( function () {
    //================================================== variables ================================================	 
    var ajaxurl = ac_restaurant.ajaxurl;
    var carturl = ac_restaurant.carturl;
    //=============================================================================================================

    //===============================================  Ajax Add to Cart Function =============================================	 
    $( document ).on( "click", ".restaurant_cart_btn", function ( e ) {
        e.preventDefault();
        var product_sku = $( this ).data( "product_sku" );
        var product_id = $( this ).data( "product_id" );
        var quantity = $( this ).data( "quantity" );

        $( "#product_id_" + product_id ).prop( "disabled", true );

        var postdata = `product_sku=${product_sku}&quantity=${quantity}&product_id=${product_id}`;
        $.ajax( {
            type: "POST",
            url: carturl,
            data: postdata,
            success: function ( data ) {
                $( "#product_id_" + product_id + " .bx" ).removeClass( "bx-cart-alt" );
                if ( data.error ) {
                    $( "#product_id_" + product_id ).css( "background", "#9c0606" );
                    $( "#product_id_" + product_id + " .bx" ).addClass( "bx-error-alt" );
                    window.location = data.product_url;
                    return;
                } else {
                    var response = data.fragments;
                    response = Object.values( response )[ 0 ];
                    // console.log( response );
                    // $( "div.widget_shopping_cart_content" ).html( response );
                    $( "#product_id_" + product_id + " .bx" ).addClass( "bx-check-circle" );

                    var postdata = "action=ac_restaurant_ajax_request&ac_action=cart_count";
                    $.ajax( {
                        type: "POST",
                        url: ajaxurl,
                        data: postdata,
                        success: function ( data ) {
                            // console.log( data );
                            $( ".nav_cart .nav__link" ).html( "Cart<span id='cartCount'>" + data + "</span></i>" );
                        }
                    } ); // End ajax
                }
            }
        } ); // End ajax

        setTimeout( () => {
            if ( $( "#product_id_" + product_id + " .bx" ).hasClass( "bx-check-circle" ) ) {
                $( "#product_id_" + product_id + " .bx" ).removeClass( "bx-check-circle" );
                $( "#product_id_" + product_id + " .bx" ).addClass( "bx-cart-alt" );
            }
            $( "#product_id_" + product_id ).prop( "disabled", false );

        }, 5000 );

    } );
    //==================================================================================================================	 


    //============================================================ User login Function ======================================================	 
    $( "#music_login" ).validate( {
        // rules: {
        //     email: {
        //         required: true,
        //         email: true
        //     },
        //     password: {
        //         required: true,
        //         minlength: 8
        //     }
        // },
        // messages: {
        //     password: {
        //         required: "Please provide a password",
        //         minlength: "Password must be at least 8 characters"
        //     },
        //     email: "Please enter a valid email address"
        // },
        // submitHandler: function ( form ) {
        //     var from_data = $( "#music_login" ).serialize();

        //     $( "#loginBtn" ).val( "Loading..." );
        //     $( "#loginBtn" ).attr( "disabled", true );

        //     var postdata = "action=music_ajax_request&ac_action=user_login&" + from_data;
        //     $.ajax( {
        //         type: "POST",
        //         url: ajaxurl,
        //         data: postdata,
        //         success: function ( data ) {
        //             // var response = $.parseJSON( data );
        //             console.log( data );
        //         } // Success


        //     } ); // End ajax

        // }




    } );
    //==================================================================================================================	 


} );