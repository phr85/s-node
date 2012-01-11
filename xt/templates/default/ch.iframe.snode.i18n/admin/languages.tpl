<form method="POST" name="units">
{include file="includes/buttons.tpl" data=$OVERVIEW_BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%" style="margin-right: 10px;">
 <tr>
   <td class="table_header" width="80">{"Options"|translate}</td>
   <td class="table_header" width="20">ID</td>
   <td class="table_header" width="20">Flag</td>
   <td class="table_header" width="80">{"Language"|translate}</td>
   <td class="table_header" width="80">{"short"|translate}</td>
   <td class="table_header">{"full"|translate}</td>
  </tr>

  {foreach from=$LANGS item=LANG}
  <tr class="{cycle values="row_a,row_b"}">
   <td class="button">
    {if "edit"|allowed}<a href="{$INDEX_PHP}?TPL={$TPL}&x{$BASEID}_action=editUnit&x{$BASEID}_id={$ENTRY.id}"><img src="images/icons/pencil.png" alt="{"edit"|translate}" title="{"edit"|translate}" /></a>{/if}
    {if "delete"|allowed}<a href="{$INDEX_PHP}?TPL={$TPL}&x{$BASEID}_action=delete&x{$BASEID}_id={$ENTRY.id}"><img src="images/icons/delete.png" alt="{"delete"|translate}" title="{"delete"|translate}" /></a>{/if}
   </td>
   <td class="row">{$LANG.id}</td>
   <td class="button" style="padding-top: 5px;" align="center"><img src="{$XT_IMAGES}lang/{$LANG.id}.png" alt="" /></td>
   <td class="row">{$LANG.title}</td>
   <td class="row"></td>
   <td class="row"></td>
  </tr>
 {/foreach}
</table>
</form>
