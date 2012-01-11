<form method="POST" name="searchadmin">
{include file="ch.iframe.snode.search/admin/hiddenValues.tpl"}
{include file="includes/lang_selector_simple.tpl" form="searchadmin"}
{include file="includes/charfilter.tpl" form="searchadmin"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
  <td class="table_header" width="25">&nbsp;</td>
   <td class="table_header" width="32">ID</td>
   <td class="table_header">{"Keyword"|translate}</td>
   <td class="table_header" width="70">{"different users"|translate}</td>
   <td class="table_header" width="70">{"times searched for"|translate}</td>
   <td class="table_header" width="50">{"Profile"|translate}</td>
   <td class="table_header" width="100">{"last searche date"|translate}</td>
  </tr>
 {foreach from=$DATA item=ENTRY}
  <tr class="{cycle values="row_a,row_b"}">
    <td class="button">
    
         {actionIcon 
                action="show_ls_details" 
                icon="view.png"
                form="searchadmin"
                perm="viewdetails"
                id=$ENTRY.id
                title="view details"
      }
    </td>

    <td class="row">{$ENTRY.id}&nbsp;</td>
    <td class="row">{$ENTRY.kw}&nbsp;</td>
    <td class="row">{$ENTRY.users}&nbsp;</td>
    <td class="row">{$ENTRY.kwcount}&nbsp;</td>
    <td class="row">{$ENTRY.profile}&nbsp;</td>
    <td class="row">{$ENTRY.sd|date_format:"%d.%m.%Y %H:%M"}&nbsp;</td>
  </tr>
 {/foreach}
 </table>
 {include file="includes/navigator.tpl" form="searchadmin"}
</form>
