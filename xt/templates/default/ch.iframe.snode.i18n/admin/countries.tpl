<form method="POST" name="countries">
{include file="includes/buttons.tpl" data=$COUNTRIES_BUTTONS}
{include file="includes/charfilter.tpl" form="countries"}
{include file="includes/navigator.tpl" form="countries"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
   <td class="table_header" width="80">{"Options"|translate}</td>
   <td class="table_header" width="60" colspan="2">{"Code"|translate}</td>
   <td class="table_header">{"Country"|translate}</td>
  </tr>

  {foreach from=$COUNTRIES item=COUNTRY}
  <tr class="{cycle values="row_a,row_b"}">
   <td class="button">{if "edit"|allowed}<a href="{$INDEX_PHP}?TPL={$TPL}&x{$BASEID}_action=editUnit&x{$BASEID}_id={$ENTRY.id}"><img src="images/icons/pencil.png" alt="{"edit"|translate}" title="{"edit"|translate}" /></a>{/if}{if "delete"|allowed}<a href="{$INDEX_PHP}?TPL={$TPL}&x{$BASEID}_action=delete&x{$BASEID}_id={$ENTRY.id}"><img src="images/icons/delete.png" alt="{"delete"|translate}" title="{"delete"|translate}" /></a>{/if}<img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
   <td class="row">{$COUNTRY.country}</td>
   <td class="button" style="padding-top: 5px;" align="center"><img src="{$XT_IMAGES}lang/{$COUNTRY.country}.png" alt="{$COUNTRY.country}" /></td>
   <td class="row">
   {$COUNTRY.name}
   </td>
  </tr>
 {/foreach}
</table>
{include file="includes/navigator.tpl" form="countries" withouthidden=1}
</form>
