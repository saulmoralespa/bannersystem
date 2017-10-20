jQuery('button#pages-bansys').click(function (e) {
    e.preventDefault();
    jQuery.ajax({
        data : 'action=create_pages_banner_sys&' +  jQuery('input[name=createpages]').serialize(),
        type: 'post',
        url: ajaxurl,
        beforeSend : function(){
            jQuery('div#create-pages img').show();
        },
        success: function(r) {
            console.log(r);
            var r = JSON.parse(r);
            if (r.status){
                jQuery('div#create-pages').hide();
                jQuery('div#pages-create').show();
            }
        },
        error: function(x, s, e) {
            jQuery('div#create-pages').show(x.responseText + s.status + e.error);
        }
    });
});

jQuery('input[name="rec_medium_bannersystem"]').on('change',function(e){
    var _URL = window.URL || window.webkitURL;
    var file = jQuery(this).val();
    var nameFile = 'rec_medium_bannersystem';
    var valuefile;
    var fd = new FormData();
    var imgwidth = 0;
    var imgheight = 0;
    var maxwidth = 300;
    var maxheight = 250;

    if ((valuefile = this.files[0])){
        img = new Image();
        img.onload = function () {
            imgwidth = this.width;
            imgheight = this.height;
            if (imgwidth <= maxwidth && imgheight <= maxheight){
                loadAjaxFile(true,nameFile,maxwidth,maxheight,valuefile,file,fd);
            }else{
                loadAjaxFile(false,nameFile,maxwidth,maxheight);
            }
        };
        img.src = _URL.createObjectURL(valuefile);
    }
});
jQuery('input[name="banner_system_rec_medium_banner_src_pay"]').on('change',function(e){
    var _URL = window.URL || window.webkitURL;
    var file = jQuery(this).val();
    var nameFile = 'banner_system_rec_medium_banner_src_pay';
    var valuefile;
    var fd = new FormData();
    var imgwidth = 0;
    var imgheight = 0;
    var maxwidth = 300;
    var maxheight = 250;

    if ((valuefile = this.files[0])){
        img = new Image();
        img.onload = function () {
            imgwidth = this.width;
            imgheight = this.height;
            if (imgwidth <= maxwidth && imgheight <= maxheight){
                loadAjaxFile(true,nameFile,maxwidth,maxheight,valuefile,file,fd);
            }else{
                loadAjaxFile(false,nameFile,maxwidth,maxheight);
            }
        };
        img.src = _URL.createObjectURL(valuefile);
    }
});
jQuery('input[name="leaderboard_bannersystem"]').on('change',function(e){
    var _URL = window.URL || window.webkitURL;
    var file = jQuery(this).val();
    var nameFile = 'leaderboard_bannersystem';
    var valuefile;
    var fd = new FormData();
    var imgwidth = 0;
    var imgheight = 0;
    var maxwidth = 728;
    var maxheight = 90;

    if ((valuefile = this.files[0])){
        img = new Image();
        img.onload = function () {
            imgwidth = this.width;
            imgheight = this.height;
            if (imgwidth <= maxwidth && imgheight <= maxheight){
                loadAjaxFile(true,nameFile,maxwidth,maxheight,valuefile,file,fd);
            }else{
                loadAjaxFile(false,nameFile,maxwidth,maxheight);
            }
        };
        img.src = _URL.createObjectURL(valuefile);
    }
});
jQuery('input[name="banner_system_leaderboard_banner_src_pay"]').on('change',function(e){
    var _URL = window.URL || window.webkitURL;
    var file = jQuery(this).val();
    var nameFile = 'banner_system_leaderboard_banner_src_pay';
    var valuefile;
    var fd = new FormData();
    var imgwidth = 0;
    var imgheight = 0;
    var maxwidth = 728;
    var maxheight = 90;

    if ((valuefile = this.files[0])){
        img = new Image();
        img.onload = function () {
            imgwidth = this.width;
            imgheight = this.height;
            if (imgwidth <= maxwidth && imgheight <= maxheight){
                loadAjaxFile(true,nameFile,maxwidth,maxheight,valuefile,file,fd);
            }else{
                loadAjaxFile(false,nameFile,maxwidth,maxheight);
            }
        };
        img.src = _URL.createObjectURL(valuefile);
    }
});
jQuery('input[name="media_page_bannersystem"]').on('change',function(e){
    var _URL = window.URL || window.webkitURL;
    var file = jQuery(this).val();
    var nameFile = 'media_page_bannersystem';
    var valuefile;
    var fd = new FormData();
    var imgwidth = 0;
    var imgheight = 0;
    var maxwidth = 300;
    var maxheight = 600;

    if ((valuefile = this.files[0])){
        img = new Image();
        img.onload = function () {
            imgwidth = this.width;
            imgheight = this.height;
            if (imgwidth <= maxwidth && imgheight <= maxheight){
                loadAjaxFile(true,nameFile,maxwidth,maxheight,valuefile,file,fd);
            }else{
                loadAjaxFile(false,nameFile,maxwidth,maxheight);
            }
        };
        img.src = _URL.createObjectURL(valuefile);
    }
});
jQuery('input[name="banner_system_media_page_banner_src_pay"]').on('change',function(e){
    var _URL = window.URL || window.webkitURL;
    var file = jQuery(this).val();
    var nameFile = 'banner_system_media_page_banner_src_pay';
    var valuefile;
    var fd = new FormData();
    var imgwidth = 0;
    var imgheight = 0;
    var maxwidth = 300;
    var maxheight = 600;

    if ((valuefile = this.files[0])){
        img = new Image();
        img.onload = function () {
            imgwidth = this.width;
            imgheight = this.height;
            if (imgwidth <= maxwidth && imgheight <= maxheight){
                loadAjaxFile(true,nameFile,maxwidth,maxheight,valuefile,file,fd);
            }else{
                loadAjaxFile(false,nameFile,maxwidth,maxheight);
            }
        };
        img.src = _URL.createObjectURL(valuefile);
    }
});
jQuery('input[name="medio_banner_bannersystem"]').on('change',function(e){
    var _URL = window.URL || window.webkitURL;
    var file = jQuery(this).val();
    var nameFile = 'medio_banner_bannersystem';
    var valuefile;
    var fd = new FormData();
    var imgwidth = 0;
    var imgheight = 0;
    var maxwidth = 234;
    var maxheight = 60;

    if ((valuefile = this.files[0])){
        img = new Image();
        img.onload = function () {
            imgwidth = this.width;
            imgheight = this.height;
            if (imgwidth <= maxwidth && imgheight <= maxheight){
                loadAjaxFile(true,nameFile,maxwidth,maxheight,valuefile,file,fd);
            }else{
                loadAjaxFile(false,nameFile,maxwidth,maxheight);
            }
        };
        img.src = _URL.createObjectURL(valuefile);
    }
});
jQuery('input[name="banner_system_medio_banner_banner_src_pay"]').on('change',function(e){
    var _URL = window.URL || window.webkitURL;
    var file = jQuery(this).val();
    var nameFile = 'banner_system_medio_banner_banner_src_pay';
    var valuefile;
    var fd = new FormData();
    var imgwidth = 0;
    var imgheight = 0;
    var maxwidth = 234;
    var maxheight = 60;

    if ((valuefile = this.files[0])){
        img = new Image();
        img.onload = function () {
            imgwidth = this.width;
            imgheight = this.height;
            if (imgwidth <= maxwidth && imgheight <= maxheight){
                loadAjaxFile(true,nameFile,maxwidth,maxheight,valuefile,file,fd);
            }else{
                loadAjaxFile(false,nameFile,maxwidth,maxheight);
            }
        };
        img.src = _URL.createObjectURL(valuefile);
    }
});
jQuery('input[name="movil_banner_bannersystem"]').on('change',function(e){
    var _URL = window.URL || window.webkitURL;
    var file = jQuery(this).val();
    var nameFile = 'movil_banner_bannersystem';
    var valuefile;
    var fd = new FormData();
    var imgwidth = 0;
    var imgheight = 0;
    var maxwidth = 320;
    var maxheight = 100;

    if ((valuefile = this.files[0])){
        img = new Image();
        img.onload = function () {
            imgwidth = this.width;
            imgheight = this.height;
            if (imgwidth <= maxwidth && imgheight <= maxheight){
                loadAjaxFile(true,nameFile,maxwidth,maxheight,valuefile,file,fd);
            }else{
                loadAjaxFile(false,nameFile,maxwidth,maxheight);
            }
        };
        img.src = _URL.createObjectURL(valuefile);
    }
});
jQuery('input[name="banner_system_movil_banner_banner_src_pay"]').on('change',function(e){
    var _URL = window.URL || window.webkitURL;
    var file = jQuery(this).val();
    var nameFile = 'banner_system_movil_banner_banner_src_pay';
    var valuefile;
    var fd = new FormData();
    var imgwidth = 0;
    var imgheight = 0;
    var maxwidth = 320;
    var maxheight = 100;

    if ((valuefile = this.files[0])){
        img = new Image();
        img.onload = function () {
            imgwidth = this.width;
            imgheight = this.height;
            if (imgwidth <= maxwidth && imgheight <= maxheight){
                loadAjaxFile(true,nameFile,maxwidth,maxheight,valuefile,file,fd);
            }else{
                loadAjaxFile(false,nameFile,maxwidth,maxheight);
            }
        };
        img.src = _URL.createObjectURL(valuefile);
    }
});
function loadAjaxFile(valImg,nameFile,maxwidth = '',maxheight = '',valuefile = '',file = '',fd = ''){
    if (valImg){

        fd.append(nameFile, valuefile);
        fd.append('action', 'bannersystem');
        fd.append('value', file);

        jQuery.ajax({
            data: fd,
            type: 'post',
            contentType: false,
            processData: false,
            url: ajaxurl,
            beforeSend : function(){
                jQuery('div.overlay-banner-system').show();
                jQuery('div.overlay-banner-system div.message strong').html('Subiendo imágen...');
            },

            success: function(r) {
                jQuery('div.overlay-banner-system div.message strong').html('');
                jQuery('div.overlay-banner-system').hide();
                console.log(r);
                var obj = JSON.parse(r);
                if (obj.status === false){
                    jQuery('table tr.'+nameFile).append('<td></td><strong style="color:red;"> '+obj.message+'</strong></td>');
                }else{
                    window.location.reload(true);
                }

            },
            error: function(x, s, e) {
                console.log(x.responseText + s.status + e.error);
            }
        });
    }else if (!valImg){
        jQuery('table tr.'+nameFile).append('<td><strong style="color:red;"> La imagen debe tener un tamaño máximo de '+ maxwidth + 'px y de alto ' + maxheight + 'px</strong></td>');
    }
}

if(jQuery("#form-flow-banner-sytem select[name=test-banner-system] option:selected").val() === 'live'){
    jQuery('tr.live-flow-banner-system').show();
    displayInput(true);
}else if (jQuery("#form-flow-banner-sytem select[name=test-banner-system] option:selected").val() === 'sandbox'){
    jQuery('tr.sandbox-flow-banner-system').show();
    displayInput(false);
}
jQuery(document).on('change','#form-flow-banner-sytem select[name=test-banner-system]',function(){
    if( this.value === 'live' ){
        jQuery('tr.sandbox-flow-banner-system').hide();
        displayInput(true);
        jQuery('tr.live-flow-banner-system').show();
    }else{
        jQuery('tr.live-flow-banner-system').hide();
        displayInput(false);
        jQuery('tr.sandbox-flow-banner-system').show();
    }
});

jQuery('form#form-flow-banner-sytem').submit(function (e) {
    e.preventDefault();
    var parent = this;
    var fd = new FormData(jQuery(parent)[0]);
    fd.append('action', 'bannersystem');
    jQuery.ajax({
        data: fd,
        type: 'post',
        cache: false,
        contentType: false,
        processData: false,
        url: ajaxurl,
        beforeSend : function(){
            jQuery('div.overlay-banner-system').show();
            jQuery('div.overlay-banner-system div.message strong').html('Guardando...');
        },
        success: function(r) {
            var obj = JSON.parse(r);
            if (obj.status === false){
                jQuery('div.overlay-banner-system div.message strong').html('');
                jQuery('div.overlay-banner-system').hide();
                jQuery(parent).parent('div').children('h1').text(obj.message);
            }else{
                window.location.reload(true);
            }

        },
        error: function(x, s, e) {
            console.log(x.responseText + s.status + e.error);
        }
    });
});

function displayInput(test){
    if (test){
        jQuery('tr.live-flow-banner-system input').prop("disabled", false);
        jQuery('tr.live-flow-banner-system select').prop("disabled", false);
        jQuery('tr.sandbox-flow-banner-system input').prop("disabled", true);
        jQuery('tr.sandbox-flow-banner-system select').prop("disabled", true);
    }else{
        jQuery('tr.sandbox-flow-banner-system input').prop("disabled", false);
        jQuery('tr.sandbox-flow-banner-system select').prop("disabled", false);
        jQuery('tr.live-flow-banner-system input').prop("disabled", true);
        jQuery('tr.live-flow-banner-system select').prop("disabled", true);
    }
}

var timer;
jQuery('input[name^="text_price"]').focus(function () {
    var elem = this;
    timer = setInterval(function(){

        var value = jQuery(elem).val();
        var coma = value.includes(",");
        var punto = value.includes(".");

        if(coma){
            value = value.replace(",", "");
            jQuery(elem).val(value);
        }
        if(punto){
            value = value.replace(".", "");
            jQuery(elem).val(value);
        }
        if (typeof  parseInt(value) === "number" && value.length > 7){
            jQuery(elem).val('');
        }
    }, 50);
});

jQuery('input[name^="text_price"]').focusout(function () {
    clearInterval(timer);
});

jQuery('form#form-member-banner-system').submit(function (e) {
    e.preventDefault();
    jQuery.ajax({
        data : jQuery('[data-banner-system="data"]').serialize() + '&action=bannersystem',
        type: 'post',
        url: ajaxurl,
        beforeSend : function(){
            jQuery('div.overlay-banner-system').show();
            jQuery('div.overlay-banner-system div.message strong').html('Guardando...');
        },
        success: function(r) {
            console.log(r);
            jQuery('div.overlay-banner-system div.message strong').html('');
            jQuery('div.overlay-banner-system').hide();
        },
        error: function(x, s, e) {
            console.log(x.responseText + s.status + e.error);
        }
    });
});

jQuery('button.save_url_banner').click(function(){
    var url = jQuery(this).closest('td').find('input[type="url"]').val();
    if(url.includes("http") || url.includes("www")){
        var urldate = jQuery(this).closest('td').find('input[type="url"]').serialize();
    }else{
        alert('Debe ingresar una url');
        return;
    }

    jQuery.ajax({
        data : urldate + '&member_role=url&action=bannersystem',
        type: 'post',
        url: ajaxurl,
        beforeSend : function(){
            jQuery('div.overlay-banner-system').show();
            jQuery('div.overlay-banner-system div.message strong').html('Guardando...');
        },
        success: function(r) {
            window.location.reload(true);
        },
        error: function(x, s, e) {
            console.log(x.responseText + s.status + e.error);
        }
    });

});

jQuery('[data-reset="banners_system"]').click(function () {
    var result = window.confirm('Atención: Esta acción pondra todos los banners como disponibles');
    if (result){
        var con = prompt("reconfirme escribiendo 'banner'", "");
    }
    if (con === 'banner'){
        jQuery.ajax({
           data: 'action=bannersystem&resetbanner=' + jQuery(this).attr('data-reset'),
           url: ajaxurl,
           type: 'post',
            beforeSend: function(){
                jQuery('[data-reset="banners_system"]').hide();
                jQuery('[data-reset="banners_system"]').parent('div').children('h1').text('Reseteando...');
            },
            success: function(r){
                jQuery('[data-reset="banners_system"]').parent('div').children('h1').text('Banners reseteados');
            },
            error: function (x, s, e) {
                console.log(x.responseText + s.status + e.error);
            }
        });
    }
});