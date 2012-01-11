<form method="post" name="tree" action="">
{include file="includes/lang_selector_simple.tpl" form="tree"}

<table cellpadding="0" cellspacing="0" width="350">
 {foreach from=$NODES item=NODE}
 {if $NODE.l >1}
 {if $NODE.active == "1"}
  <tr class="{cycle values="row_a,row_b"}">
   <td>
    <table cellspacing="0" cellpadding="0" width="100%">
     <tr>
    <td class="row" style="padding-left: {$NODE.level*20-32}px; width: 1px;">
      {if $NODE.subs > 0}{if $NODE.itw}<a href="javascript:document.forms['tree'].x{$BASEID}_open.value={$NODE.pid};document.forms['tree'].submit();"><img src="{$XT_IMAGES}icons/minus.gif" alt="" /></a>{else}<a href="javascript:document.forms['tree'].x{$BASEID}_open.value={$NODE.id};document.forms['tree'].submit();"><img src="{$XT_IMAGES}icons/plus.gif" alt="" /></a>{/if}{else}<img src="{$XT_IMAGES}spacer.gif" width="9" />{/if}</td>
      <td class="row" style="padding: 5px; padding-right: 0px;width: 16px">
       <a href="javascript:document.forms['tree'].x{$BASEID}_open.value={$NODE.id};document.forms['tree'].submit();">{if $NODE.itw}{if $NODE.subs > 0}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />{else}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />{/if}{else}{if $NODE.subs > 0}<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="" />{else}<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="" />{/if}{/if}</a><br />
      </td>
      <td class="row"><a href="javascript:document.forms['tree'].x{$BASEID}_open.value={$NODE.id};document.forms['tree'].submit();">{if $NODE.itw}<span style="color: black;">{if $NODE.selected}<b>{$NODE.title}</b>{else}{$NODE.title}{/if}</span>{else}{$NODE.title}{/if}&nbsp;</a></td>
      <td class="button" align="right">{if $NODE.subs > 0}{if $SELECTED[$NODE.id]==1}{actionIcon
        action="removeAllSubCategoryToObject"
        icon="pin_red.png"
        form="tree"
        node_id=$NODE.id
        title="remove this category and all subs from selection"
        ctype=$CTYPE
        cid=$CID
        yoffset=true
      }{else}{actionIcon
        action="addAllSubCategoryToObject"
        icon="pin_yellow.png"
        form="tree"
        node_id=$NODE.id
        title="add this category and all subs to selection"
        ctype=$CTYPE
        cid=$CID
        yoffset=true
      }{/if}{/if}{if $SELECTED[$NODE.id]==1}{actionIcon
        action="removeCategoryFromObject"
        icon="pin_green.png"
        form="tree"
        node_id=$NODE.id
        title="remove this category from selection"
        ctype=$CTYPE
        cid=$CID
        yoffset=true
      }{else}{actionIcon
        action="addCategoryToObject"
        icon="pin_grey.png"
        form="tree"
        node_id=$NODE.id
        title="add this category to selection"
        ctype=$CTYPE
        cid=$CID
        yoffset=true
      }{/if}
      </td>
     </tr>
    </table>
   </td>
  </tr>
  {/if}
  {/if}
 {/foreach}
</table>

<input type="hidden" name="x{$BASEID}_ctype" value="" />
<input type="hidden" name="x{$BASEID}_cid" value="" />
<input type="hidden" name="x{$BASEID}_action" value="" />
<input type="hidden" name="x{$BASEID}_node_id" value="" />
<input type="hidden" name="x{$BASEID}_node_pid" value="" />
<input type="hidden" name="x{$BASEID}_open" value="" />

{yoffset}
</form>