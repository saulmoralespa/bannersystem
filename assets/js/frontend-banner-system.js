jQuery('form#form_user_banner_system').submit(function (e) {
    e.preventDefault();
    jQuery.ajax({
        data: jQuery(this).serialize() + '&action=form_banner_system',
        type: 'post',
        url: banner_system.ajaxurl,
        beforeSend: function(){
            jQuery('div.overlay-banner-system').show();
            jQuery('div.overlay-banner-system div.message strong').html(banner_system.before_flow);
        },
        success: function (r) {
            console.log(r);
            var obj = jQuery.parseJSON(r);
            if (typeof obj === 'object'){
                if (obj.status){
                    jQuery('div.overlay-banner-system div.message strong').html('');
                    jQuery('div.overlay-banner-system div.message strong').html(banner_system.flow_message);
                    jQuery("div form#form_user_banner_system").remove();
                    jQuery('div#container_form_banner_system').html("<form id='params_flow_banner' method='post' action='"+obj.url+"'><input type='hidden' name='parameters' value='"+obj.parameters+"' /><input type='submit'></form>");
                    jQuery('form#params_flow_banner').submit();

                }
            }
        },
        error: function (x, s, e) {
            console.log(x.responseText + s.status + e.error);
        }
    });
});

jQuery('[data-control="rec_medium"]').click(function(e) {

    jQuery.ajax({
        data: jQuery.param({ action: "register_click_banner_system", banner_click : jQuery(this).attr('data-control')}),
        type: 'post',
        url: banner_system.ajaxurl
    });
});
jQuery('[data-control="leaderboard"]').click(function(e) {
    jQuery.ajax({
        data: jQuery.param({ action: "register_click_banner_system", banner_click : jQuery(this).attr('data-control')}),
        type: 'post',
        url: banner_system.ajaxurl
    });
});
jQuery('[data-control="media_page"]').click(function(e) {
    jQuery.ajax({
        data: jQuery.param({ action: "register_click_banner_system", banner_click : jQuery(this).attr('data-control')}),
        type: 'post',
        url: banner_system.ajaxurl
    });
});
jQuery('[data-control="medio_banner"]').click(function(e) {
    jQuery.ajax({
        data: jQuery.param({ action: "register_click_banner_system", banner_click : jQuery(this).attr('data-control')}),
        type: 'post',
        url: banner_system.ajaxurl
    });
});
jQuery('[data-control="movil_banner"]').click(function(e) {
    jQuery.ajax({
        data: jQuery.param({ action: "register_click_banner_system", banner_click : jQuery(this).attr('data-control')}),
        type: 'post',
        url: banner_system.ajaxurl
    });
});