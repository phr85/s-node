{literal}
<!-- tinyMCE -->
<script language="javascript" type="text/javascript" src="{/literal}{$XT_SCRIPTS}{literal}tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
    var tinyMCEmode = new Array();
    function toggleEditorMode(sEditorID) {
        if (!tinyMCE.getInstanceById(sEditorID)) {
            tinyMCE.execCommand('mceAddControl', false, sEditorID);
        }
        else {
            tinyMCE.execCommand('mceRemoveControl', false, sEditorID);
        }
    }

    tinyMCE.init({
        mode : "exact",
        theme : "advanced",
        plugins : "fullscreen,safari",
        language : "{/literal}{$SYSTEM_LANG|default:"en"}{literal}",
        theme_advanced_buttons1 : "bold,italic,underline,separator,justifyleft,justifyright,justifyfull,separator,bullist,numlist,separator,undo,link,code,separator,fullscreen",
        theme_advanced_buttons2 : "",
        theme_advanced_buttons3 : "",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        content_css : "{/literal}{$XT_STYLES}live/{$XT_THEME}/{$XT_THEME}_editor.css{literal}",
        force_br_newlines : true,
        forced_root_block : '',
        force_p_newlines : false,
        cleanup : true,
        visual : true,
        strict_loading_mode : true,
        relative_urls : false,
        remove_script_host : false,
        document_base_url : "http://{/literal}{$smarty.server.HTTP_HOST}{literal}/",
        convert_urls: true,
        fullscreen_new_window : false,
        fullscreen_settings : {
            plugins : 'fullscreen, advhr, searchreplace, table, paste, safari',
            table_color_fields : 'true',
            theme_advanced_buttons1 : 'fullscreen,bold,italic,underline,strikethrough,separator,sub,sup,separator,justifyleft,justifyright,justifycenter,justifyfull,separator,bullist,numlist,separator,outdent,indent,separator,advhr,separator,undo,redo,separator,link,unlink,anchor,image,separator,code',
            theme_advanced_buttons2 : 'tablecontrols, separator,forecolor,backcolor,separator,fontsizeselect,separator,fontselect,styleselect',
            theme_advanced_buttons3 : 'selectall,cut,paste,pastetext,pasteword,separator,search,replace,separator,removeformat,visualaid,separator,charmap'
        }
    });
</script>
<!-- /tinyMCE -->
{/literal}