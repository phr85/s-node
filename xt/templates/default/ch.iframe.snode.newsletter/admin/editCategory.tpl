<script language="JavaScript"><!--
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>
<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
<h2><span class="light">{"Category"|translate}:</span> {$CATEGORY.title}</h2>
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"Title"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_title" size="42" value="{$CATEGORY.title}" /></td>
 </tr>
 <tr>
  <td class="left">{"Description"|translate}</td>
  <td class="right">{toggle_editor id="description"}
  <textarea id="x{$BASEID}_description" name="x{$BASEID}_description" rows="6" cols="50">{$CATEGORY.description}</textarea></td>
 </tr>
</table>
<h2>{"Last 15 Subscriptions"|translate}</h2>
{include file="includes/buttons.tpl" data=$BUTTONS_SUB withouthidden="1"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header">{"E-Mail"|translate}</td>
  <td class="table_header" width="100">{"Subscribed at"|translate}</td>
 </tr>
 {foreach from=$SUBSCRIBERS item=SUBSCRIBER}
 <tr class="{cycle values=row_a,row_b}">
  <td class="row">{$SUBSCRIBER.email}</td>
  <td class="row">{$SUBSCRIBER.creation_date|date_format:"%d.%m.%Y %H:%M"}</td>
 </tr> 
 {/foreach}
</table>

{include file="ch.iframe.snode.newsletter/admin/hiddenValues.tpl"}
{include file="includes/editor.tpl"}
</form>
