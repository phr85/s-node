<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" name="overview">
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="row">{"Please choose a category"|translate}:</td>
  <td class="row" align="right">
   <select name="x{$BASEID}_scategory_id_" onChange="this.form.submit();">
    <option value="0" {if $ACTIVE_CATEGORY < 1}selected{/if}>{"All"|translate}</option>
    {foreach from=$CATEGORIES item=CATEGORY}
    <option value="{$CATEGORY.id}" {if $ACTIVE_CATEGORY == $CATEGORY.id}selected{/if}>{$CATEGORY.title}</option>
    {/foreach}
   </select>
  </td>
 </tr>
 <tr>
 <td class="row">{"Please choose a language"|translate}:</td>
  <td class="row" align="right">
   <select name="x{$BASEID}_lang" onChange="this.form.submit();">
    <option value="" {if $ACTIVE_LANG == ""}selected{/if}>{"All"|translate}</option>
    {foreach from=$LANGS key=KEY item=LANG}
    <option value="{$KEY}" {if $ACTIVE_LANG == $KEY}selected{/if}>{$LANG.name|translate}</option>
    {/foreach}
   </select>
  </td>
 </tr>
</table>
{include file="includes/charfilter.tpl" form="overview"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" width="80">{actionIcon action="NULL" form=overview label="ID" sort=$sort.0.value icon=$sort.0.icon}</td>
  <td class="table_header">{actionIcon action="NULL" form=overview label="E-Mail" sort=$sort.1.value icon=$sort.1.icon}</td>
  <td class="table_header" width="110">{actionIcon action="NULL" form=overview label="Unsubscribed at" sort=$sort.0.value icon=$sort.0.icon}</td>
 </tr>
 {foreach from=$SUBSCRIBERS item=SUBSCRIBER}
 <tr class="{cycle values=row_a,row_b}">
  <td class="button">{$SUBSCRIBER.id}</td>
  <td class="row">{$SUBSCRIBER.email}</td>
  <td class="row">{$SUBSCRIBER.date|date_format:"%d.%m.%Y %H:%M"}</td>
 </tr>
 {/foreach}
</table>
{include file="includes/navigator.tpl" form="overview"}
<input type="hidden" name="x{$BASEID}_sort" value="" />
{include file="ch.iframe.snode.newsletter/admin/hiddenValues.tpl"}
</form>