{literal}
<script language="JavaScript"><!--
if(window.parent.frames['master']){
    window.parent.frames['master'].document.forms[1].submit();
}
//-->
</script>
{/literal}
<form method="post" name="edit">
{include file="ch.iframe.snode.securitycenter/admin/hiddenValues.tpl"}
{include file="includes/buttons.tpl" data=$BUTTONS withouthidden=1}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header">
   <span class="title">{"Edit role"|translate}</span>
  </td>
 </tr>
<tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"Name"|translate}</td>
  <td class="right"><input type="text" size="42" name="x{$BASEID}_title" value="{$ROLE.title}"></td>
 </tr>
 <tr>
  <td class="left">{"Description"|translate}</td>
  <td class="right"><textarea cols="50" rows="3" name="x{$BASEID}_description">{$ROLE.description}</textarea></td>
 </tr>
</table>
</form>
