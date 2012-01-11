{include file="includes/lang_selector_simple.tpl" form="mediatable"}
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="table_header" colspan="3">{"Folder tree"|translate}</td>
 </tr>
 {foreach from=$NODES item=NODE}
  {if node_allowed($NODE.id,"list")}
  <tr class="{cycle values="row_a,row_b"}" colspan="2">
   <td>
    <table cellspacing="0" cellpadding="0" width="100%">
     <tr>
      <td class="row" style="padding-left: {$NODE.level*20-32}px; width: 1px;">{if $NODE.subs > 0}{if $NODE.itw}<img src="{$XT_IMAGES}icons/minus.gif" alt="">{else}<img src="{$XT_IMAGES}icons/plus.gif" alt="">{/if}{else}<img src="{$XT_IMAGES}spacer.gif" width="9">{/if}</td>
      <td class="row" style="padding: 5px; padding-right: 0px;width: 16px">
       <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_active={$NODE.id}">{if $NODE.itw}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="">{else}<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="">{/if}</a><br>
      </td>
      <td class="row">
      {actionLink
        active   = $NODE.id
        form     ="mediatable"
        text     = $NODE.title}
        </td>
      <td class="row" style="padding: 5px; vertical-align: top;" align="right">
      {if $CTRL_ADD}{
      actionIcon
          action="insertFolder"
          position="after"
          node_id=$NODE.id
          icon="explorer/arrow_down_green.png"
          title="After this node"
          form="mediatable"
      }{
      actionIcon
          action="insertFolder"
          position="before"
          node_id=$NODE.id
          icon="explorer/arrow_up_green.png"
          title="Before this node"
          form="mediatable" 
      }{
      actionIcon
          action="insertFolder"
          position="into"
          node_id=$NODE.id
          icon="explorer/folder_into.png"
          title="Into this node"
          form="mediatable"
      }{else}{if !$PICKER}{
      actionIcon
          action="editNode"
          node_id=$NODE.id
          icon="pencil.png"
          title="Edit this folder"
          form="mediatable"
      }{
      actionIcon
          action="deleteNode"
          node_id=$NODE.id
          icon="delete.png"
          title="Delete this folder"
          form="mediatable"
          ask="Are you sure to delete this entry?"
      }{/if}{/if}</td>
     </tr>
    </table>
   </td>
  </tr>
  {/if}
 {/foreach}
</table>
<input type="hidden" name="x{$BASEID}_active">
<input type="hidden" name="x{$BASEID}_position">
<input type="hidden" name="x{$BASEID}_node_id">