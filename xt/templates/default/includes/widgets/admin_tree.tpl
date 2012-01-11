<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="table_header" colspan="3">{"Node tree"|translate}</td>
 </tr>
 {foreach from=$NODES item=NODE}
  <tr class="{cycle values="row_a,row_b"}" colspan="2">
   <td>
    <table cellspacing="0" cellpadding="0" width="100%">
     <tr>
      <td style="padding-left: {$NODE.level*20-32}px; width: 1px;">{if $NODE.subs > 0}{if $NODE.itw}<img src="{$XT_IMAGES}icons/minus.gif" alt="" />{else}<img src="{$XT_IMAGES}icons/plus.gif" alt="" />{/if}{else}<img src="{$XT_IMAGES}spacer.gif" width="9" />{/if}</td>
      <td class="row" style="padding: 5px; padding-right: 0px;width: 16px">
       <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_open={$NODE.id}">{if $NODE.itw}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />{else}<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="" />{/if}</a><br />
      </td>
      <td class="row"><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_open={$NODE.id}">{if $NODE.itw}<span style="color: black;">{if $NODE.selected}<b>{$NODE.title}</b>{else}{$NODE.title}{/if}</span>{else}{$NODE.title}{/if}</a></td>
      <td style="padding: 5px; vertical-align: top;" align="right">
      {if $CTRL_ADD}<a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_action=insertNode&x{$BASEID}_position=after&x{$BASEID}_node_id={$NODE.id}"><img src="{$XT_IMAGES}icons/explorer/arrow_down_green.png" class="icon" alt="{"After this node"|translate}" /></a><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_action=insertNode&x{$BASEID}_position=before&x{$BASEID}_node_id={$NODE.id}"><img src="{$XT_IMAGES}icons/explorer/arrow_up_green.png" class="icon" alt="{"Before this node"|translate}" /></a>{if node_allowed($NODE.id,"addNodes")}<a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_action=insertNode&x{$BASEID}_position=into&x{$BASEID}_node_id={$NODE.id}"><img src="{$XT_IMAGES}icons/explorer/folder_into.png" class="icon" alt="{"Into this node"|translate}" /></a>{else}{$ICONSPACER}{/if}{else}{if !$PICKER}<a href="#" onclick="popup('{$smarty.server.PHP_SELF}?TPL={$NODE_MANAGER_TPL}&x{$NODE_MANAGER_BASE_ID}_node_id={$NODE.id}&x{$NODE_MANAGER_BASE_ID}_base_id={$BASEID}&x{$NODE_MANAGER_BASE_ID}_lang_filter={$ACTIVE_LANG}&x{$NODE_MANAGER_BASE_ID}_package={$PACKAGE}',550,450);"><img src="{$XT_IMAGES}icons/folder_lock.png" class="icon" title="{"Edit folder permissions"|translate}" alt="{"Edit folder permissions"|translate}" /></a>{if node_allowed($NODE.id,"editNodes")}<a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_action=editNode&x{$BASEID}_node_id={$NODE.id}"><img src="{$XT_IMAGES}icons/folder_edit.png" class="icon" title="{"Edit folder"|translate}" alt="{"Edit folder"|translate}" /></a>{else}{$ICONSPACER}{/if}{if node_allowed($NODE.id,"deleteNodes")}<a href="javascript:ask('{"Are you sure to delete this entry?"|translate}','{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_action=deleteNode&x{$BASEID}_node_id={$NODE.id}');"><img src="{$XT_IMAGES}icons/folder_delete.png" alt="{'Delete folder'|translate} - {$NODE.title}" title="{'Delete folder'|translate} - {$NODE.title}" class="icon" /></a>{else}{$ICONSPACER}{/if}{/if}{/if}</td>
     </tr>
    </table>
   </td>
  </tr>
 {/foreach}
</table>
