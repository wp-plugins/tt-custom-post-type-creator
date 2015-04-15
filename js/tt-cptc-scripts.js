jQuery( document ).ready( function( $ ) {
    // close postboxes that should be closed
    $( '.if-js-closed' ) .removeClass( 'if-js-closed' ).addClass( 'closed' );
    // postboxes setup
    postboxes.add_postbox_toggles( '<?php echo $options_page; ?>' );
});

jQuery(document).ready(function($) {
    $(".info-button").click(function() {
    var element = $(this), I = element.attr("id");
    var txt = element.text();
    
    $(".config-details"+I).slideToggle(300);
    if (txt=="Show Config Details") {
	$(this).text('Hide Config Details');    
    }else{
        $(this).text('Show Config Details');
    }
    $(this).toggleClass("active");
    return false;
    });
});
