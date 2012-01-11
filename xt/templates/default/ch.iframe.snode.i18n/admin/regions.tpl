<form method="POST" name="countries">
{include file="includes/buttons.tpl" data=$COUNTRIES_BUTTONS}
{include file="includes/charfilter.tpl" form="countries"}
{include file="includes/navigator.tpl" form="countries"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
   <td class="table_header" width="80">{"Options"|translate}</td>
   <td class="table_header" width="60" colspan="2">{"Country"|translate}</td>
   <td class="table_header">{"Region"|translate}</td>
  </tr>

  {foreach from=$REGIONS item=REGION}
  <tr class="{cycle values="row_a,row_b"}">
   <td class="button">
    {if "edit"|allowed}<a href="{$INDEX_PHP}?TPL={$TPL}&x{$BASEID}_action=editUnit&x{$BASEID}_id={$ENTRY.id}"><img src="images/icons/pencil.png" alt="{"edit"|translate}" title="{"edit"|translate}" /></a>{/if}
    {if "delete"|allowed}<a href="{$INDEX_PHP}?TPL={$TPL}&x{$BASEID}_action=delete&x{$BASEID}_id={$ENTRY.id}"><img src="images/icons/delete.png" alt="{"delete"|translate}" title="{"delete"|translate}" /></a>{/if}
   </td>
   <td class="row">
   {$REGION.country}
   </td>
   <td class="button" style="padding-top: 5px;" align="center"><img src="{$XT_IMAGES}lang/{$REGION.country}.png" alt="{$REGION.country}" /></td>
   <td class="row">
   {$REGION.name}
   </td>
  </tr>
 {/foreach}
</table>
<br />
{include file="includes/navigator.tpl" form="countries" withouthidden=1}
</form>
