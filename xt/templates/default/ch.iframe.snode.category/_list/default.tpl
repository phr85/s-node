<h2>Listed Categories</h2>
<form method="post" name="list" action="">
{include file="includes/lang_selector_simple.tpl" form="list"}
 
<table cellpadding="0" cellspacing="0" width="100%">
{foreach from=$DATA item=ENTRY}
 <tr class="{cycle values="row_a,row_b"}">
 <td class="row" style="padding: 5px; padding-right: 0px;width: 16px">
   <label title="Node:{$ENTRY.node_id} {$ENTRY.subtitle},{$ENTRY.description}">{$ENTRY.title}</label>
   </td>
    <td width="40" class="button" align="right">
    {actionIcon 
        action="removeCategoryFromObject"
        icon="pin_green.png"
        form="list"
        node_id=$ENTRY.node_id
        title="remove this category from selection"
        ctype=$CTYPE
        cid=$CID
      }
    </td>
   </tr>
{/foreach}
</table>

<input type="hidden" name="x{$BASEID}_ctype" value="" />
<input type="hidden" name="x{$BASEID}_cid" value="" />
<input type="hidden" name="x{$BASEID}_action" value="" />
<input type="hidden" name="x{$BASEID}_node_id" value="" />

{yoffset}
</form>