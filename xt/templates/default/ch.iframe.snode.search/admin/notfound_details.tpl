<form method="POST" name="searchadmin">
{include file="ch.iframe.snode.search/admin/hiddenValues.tpl"}
{include file="includes/lang_selector_simple.tpl" form="searchadmin"} 
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="32">ID</td>
   <td class="table_header">{"Keyword"|translate}</td>
   <td class="table_header" width="200">{"user"|translate}</td>
   <td class="table_header" width="100">{"search date"|translate}</td>
  </tr>
 {foreach from=$DATA item=ENTRY}
  <tr class="{cycle values="row_a,row_b"}">
    <td class="row">{$ENTRY.id}&nbsp;</td>
    <td class="row">{$ENTRY.kw}&nbsp;</td>
    <td class="row">{$ENTRY.users}&nbsp;</td>
    <td class="row">{$ENTRY.sd|date_format:"%d.%m.%y %H:%I:%S"}&nbsp;</td>
  </tr>
 {/foreach}
 </table>
 {include file="includes/navigator.tpl" form="searchadmin"}
</form>
