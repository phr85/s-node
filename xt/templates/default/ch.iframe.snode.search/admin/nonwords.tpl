<form method="POST" name="searchadmin">
{include file="ch.iframe.snode.search/admin/hiddenValues.tpl"}
{include file="includes/lang_selector_simple.tpl" form="searchadmin"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="left">{"Nonwords"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_keyword" size="50">
   
   <input type="submit" value="{"Add nonword"|translate}" class="button" onclick="document.forms['searchadmin'].x{$BASEID}_action.value='nonword_add'">
   </td>
  </tr>
 </table>
 {include file="includes/charfilter.tpl" form="searchadmin"}

 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="80">{"Options"|translate}</td>
   <td class="table_header" width="32">ID</td>
   <td class="table_header" width="80">{"short form"|translate}</td>
   <td class="table_header">{"Keyword"|translate}</td>
  </tr>
 {foreach from=$DATA item=ENTRY}
  <tr class="{cycle values="row_a,row_b"}">
    <td class="button">
      {actionIcon 
                action="nonword_remove" 
                icon="delete.png"
                form="searchadmin"
                id=$ENTRY.id
                title="delete"
      }
    </td>
    <td class="row">{$ENTRY.id}&nbsp;</td>
    <td class="row">{$ENTRY.two}&nbsp;</td>
    <td class="row">{$ENTRY.kw}&nbsp;</td>
  </tr>
 {/foreach}
 </table>
 {include file="includes/navigator.tpl" form="searchadmin"}
</form>
