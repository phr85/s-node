{literal}
<script type="text/javascript"><!--
if(window.parent.frames['master']){
    window.parent.frames['master'].document.forms[1].submit();
}
//-->
</script>
{/literal}
<form method="POST" name="edit">
<h2><span class="light">{"Object"|translate}:&nbsp;</span>{$DATA.title}</h2>
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"Title"|translate}&nbsp;</td>
  <td class="right"><input type="text" name="x{$BASEID}_title" value="{$DATA.title}" size="42"></td>
 </tr>
 <tr>
  <td class="left">{"Open URL"|translate}&nbsp;</td>
  <td class="right"><input type="text" name="x{$BASEID}_open_url" value="{$DATA.open_url}" size="42"></td>
 </tr>
 <tr>
  <td class="left">{"Content table"|translate}&nbsp;</td>
  <td class="right"><input type="text" name="x{$BASEID}_content_table" value="{$DATA.content_table}" size="42"></td>
 </tr>
 <tr>
  <td class="left">{"Title field"|translate}&nbsp;</td>
  <td class="right"><input type="text" name="x{$BASEID}_title_field" value="{$DATA.title_field}" size="42"></td>
 </tr>
 <tr>
  <td class="left">{"Icon"|translate}&nbsp;</td>
  <td class="right"><input type="text" name="x{$BASEID}_icon" value="{$DATA.icon}" size="42"></td>
 </tr>
 <tr>
  <td class="left">{"Id field"|translate}&nbsp;</td>
  <td class="right"><input type="text" name="x{$BASEID}_id_field" value="{$DATA.id_field}" size="42"></td>
 </tr>
</table>
<input type="hidden" name="x{$BASEID}_object_id" value="{$DATA.id}" />
</form>