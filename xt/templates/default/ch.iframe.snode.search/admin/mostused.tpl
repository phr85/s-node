<form method="POST" name="searchadmin">
{include file="ch.iframe.snode.search/admin/hiddenValues.tpl"}
{include file="includes/lang_selector_simple.tpl" form="searchadmin"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="60">{"Options"|translate}</td>
   <td class="table_header" width="32">ID</td>
   <td class="table_header" width="80">{"times used"|translate}</td>
   <td class="table_header">{"Keyword"|translate}</td>
  </tr>
 {foreach from=$DATA item=ENTRY}
  <tr class="{cycle values="row_a,row_b"}">
    <td class="button">
     {if "nonwords"|allowed}<a href="{$INDEX_PHP}?TPL={$TPL}&x{$BASEID}_action=mu2nw&x{$BASEID}_id={$ENTRY.id}"><img src="images/icons/arrow_red.gif" alt="{"move to nonwords"|translate}" title="{"move to nonwords"|translate}" /></a>{/if}
    </td>
    <td class="row">{$ENTRY.id}&nbsp;</td>
    <td class="row">{$ENTRY.kwcount}&nbsp;</td>
    <td class="row">{$ENTRY.kw}&nbsp;</td>
  </tr>
 {/foreach}
 </table>
 {include file="includes/navigator.tpl" form="searchadmin"}
</form>