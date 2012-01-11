<form method="POST" name="slave1">
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td style="padding: 8px;">
<h1>{"selected categories"|translate}</h1>
<table cellpadding="0" cellspacing="0" width="100%">
<tr class="row_b">
<td class="row">
{"node_id"|translate}
</td>
<td class="row">
{"status"|translate}
</td>
<td class="row">
{"title"|translate}
</td>
<td class="button">
{"action"|translate}
</td>
</tr>


{foreach from=$CATEGORIES item=CATEGORY}
<tr class="{cycle values="row_a,row_b"}">
<td class="row" width="50">
{$CATEGORY.node_id}
</td>
<td class="row" width="80">
{if $CATEGORY.active == 1}{"active"|translate}{else}{"inactive"|translate}{/if}
</td>
<td class="row">
{$CATEGORY.title}
</td>
<td class="button" width="80">
{actionIcon
        action="removeCategoryFromSelection"
        icon="delete.png"
        form="slave1"
        id=$CATEGORY.node_id
        title="remove this category from selection"
      }
</td>
</tr>
{/foreach}
</table>
<br />
{"selection completed"|translate}
{actionIcon
        action="getSelection"
        icon="check.png"
        form="slave1"
        title="get selection"
      }
</td>
</tr>
</table>

<input type="hidden" name="x{$BASEID}_id" value="" />
<input type="hidden" name="x{$BASEID}_position" value="" />
<input type="hidden" name="x{$BASEID}_action" value="" />
<input type="hidden" name="x{$BASEID}_node_id" value="" />
<input type="hidden" name="x{$BASEID}_node_pid" value="" />
<input type="hidden" name="x{$BASEID}_open" value="" />
<input type="hidden" name="x{$BASEID}_source_node_id" value="" />
{yoffset}
</form>