$(document).ready(function(){
    $('#jobfilterwrapper select').bind('change', function(){
        $(this).parents('form:first').submit();
    });
});