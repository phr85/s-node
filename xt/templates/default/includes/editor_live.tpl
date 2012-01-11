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
		language : "{/literal}{$SYSTEM_LANG|default:"en"}{literal}",
		theme_advanced_buttons1 : "bold,italic,underline,separator,bullist,numlist,separator,undo",
		theme_advanced_buttons2 : "",
		theme_advanced_buttons3 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		force_br_newlines : true,
		forced_root_block : '',
		force_p_newlines : false,
		cleanup : true,
		visual : false,
		convert_urls: false
	});
</script>
<!-- /tinyMCE -->
{/literal}