<script language="JavaScript"><!--
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>
<form method="POST" name="edit">
{include file="includes/buttons.tpl" data=$EDIT_BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Virtual"|translate}:</span>&nbsp;<span class="title">{$VIRTUAL.pattern}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"Shortcut"|translate}&nbsp;</td>
  <td class="right"><input type="text" name="x{$BASEID}_pattern" value="{$VIRTUAL.pattern}" size="42"></td>
 </tr>
 <tr>
  <td class="left">{"URL"|translate}&nbsp;</td>
  <td class="right"><input type="text" name="x{$BASEID}_url" value="{$VIRTUAL.url}" size="42"></td>
 </tr>
</table>
<input type="hidden" name="x{$BASEID}_virtual_id" value="{$VIRTUAL.id}" />
</form>