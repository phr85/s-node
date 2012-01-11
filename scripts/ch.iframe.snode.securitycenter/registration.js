// config
var XTsecuritycenterParams = '&param_autologin=false';

$(document).ready(function() {
    $('#register').ajaxForm({
        beforeSubmit:slideReg,
        target: '#registration_body',
        url: '/ajax.php?package=ch.iframe.snode.securitycenter&module=register' + XTsecuritycenterParams,
        success: reinitregForm
    });
});

function reinitregForm(){
        $('#register').ajaxForm({
            beforeSubmit:slideReg,
            target: '#registration_body',
            url: '/ajax.php?package=ch.iframe.snode.securitycenter&module=register' + XTsecuritycenterParams,
            success: reinitregForm
        });
            $('#registration_body').slideDown();
}


function slideReg(){
    $('#registration_body').slideUp();
}
