<form method="POST" name="searchadmin">
{include file="ch.iframe.snode.search/admin/hiddenValues.tpl"}
{include file="includes/lang_selector_simple.tpl" form="searchadmin"}
 {include file="includes/charfilter.tpl" form="searchadmin"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="80">{"Options"|translate}</td>
   <td class="table_header" width="32">ID</td>
   <td class="table_header" width="80">{"Twoletter"|translate}</td>
   <td class="table_header" width="250">{"Keyword"|translate}</td>
   <td class="table_header" width="50">{"Pages"|translate}</td>
   <td class="table_header" width="70">{"Search count"|translate}</td>
   <td class="table_header">{"sondex value"|translate}</td>
  </tr>
 {foreach from=$DATA item=ENTRY}
  <tr class="{cycle values="row_a,row_b"}">
    <td class="button">
     {actionIcon 
                action="kw2nw" 
                icon="data_add.png"
                form="searchadmin"
                perm="nonwords"
                id=$ENTRY.id
                title="move to nonwords"
      }
      {if $COUNTS[$ENTRY.id]==0}
         {actionIcon 
                action="delete_keyword" 
                icon="delete.png"
                form="searchadmin"
                perm="del_kw"
                id=$ENTRY.id
                title="delete"
      }
      {/if}
    </td>
    <td class="row">{$ENTRY.id}&nbsp;</td>
    <td class="row">{$ENTRY.two}&nbsp;</td>
    <td class="row">{$ENTRY.kw}&nbsp;</td>
    <td class="row">{$COUNTS[$ENTRY.id]|default:0}  &nbsp;</td>
    <td class="row">{$FOUNDS[$ENTRY.id]|default:0}  &nbsp;</td>
    <td class="row">{$ENTRY.soundex}&nbsp;</td>
  </tr>
 {/foreach}
 </table>
 {include file="includes/navigator.tpl" form="searchadmin"}
</form>
