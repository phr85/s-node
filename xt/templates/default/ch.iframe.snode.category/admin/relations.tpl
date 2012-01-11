 <form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="post" name="relations">
 {include file="includes/buttons.tpl" data=$BUTTONS withouthidden=1}

 {include file="ch.iframe.snode.category/admin/hiddenValues.tpl"}
<h2><span class="light">{"Node"|translate}:</span> {$NODE.title}</h2>
<div style="padding: 15px; border-bottom: 2px solid #CDCDCD;">
{if $NODE.image > 0}
{image id=$NODE.image version=0 align=right}
{/if}
{$NODE.description}
</div>

 <table cellpadding="0" cellspacing="0" width="100%">
{foreach from=$DATA item=ENTRY name=N}
 <tr class="{cycle values="row_a,row_b"}">
 <td class="row" style="padding: 5px;">
   {$ENTRY.target_title}
   </td>
   <td class="row" style="padding: 5px; width:150px;">
   {$CTYPES[$ENTRY.target_content_type]|default:$ENTRY.target_content_type} ({$ENTRY.target_content_id})
   </td>
    <td class="button" align="right" width="80">{if !$smarty.foreach.N.last}{actionIcon
        action="moveDownCategory"
        icon="explorer/arrow_down_green.png"
        form="relations"
        id=$ENTRY.id
        position=$ENTRY.position
        title="move down"
    }{/if}{if !$smarty.foreach.N.first}{actionIcon
        action="moveUpCategory"
        icon="explorer/arrow_up_green.png"
        form="relations"
        id=$ENTRY.id
        position=$ENTRY.position
        title="move down"
    }{/if}{actionIcon 
        action="deleteRelation"
        icon="delete.png"
        form="relations"
        id=$ENTRY.id
        title="remove this relation"
      }</td>
   </tr>
   
{/foreach}
</table>
</form>
