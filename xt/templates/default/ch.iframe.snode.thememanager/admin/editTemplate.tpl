{literal}
<script language="JavaScript"><!--
if(window.parent.frames['master']){
    window.parent.frames['master'].document.forms[1].submit();
}
//-->
</script>
{/literal}
<form method="post">
{include file="includes/buttons.tpl" data=$BUTTONS}
<div style="padding: 10px;">
<textarea name="x{$BASEID}_content" style="width: 550px; height: 500px; font-family: Courier New">{$FILE}</textarea>
</div>
<input type="hidden" name="x{$BASEID}_path" value="{$PATH}" />
</form>