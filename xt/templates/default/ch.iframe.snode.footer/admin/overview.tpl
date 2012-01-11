<form method="POST">
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 {foreach from=$DATA item=ENTRY}
 <tr class="{cycle value=row_a,row_b}">
  <td>
   <table cellspacing="0" cellpadding="0" width="100%">
   <tr>
    <td class="row" style="padding-left: {$ENTRY.level*20-20}px; width: 15px;">{if $ENTRY.isFolder == 1}<img src="{$XT_IMAGES}spacer.gif" width="6" /><img src="{$XT_IMAGES}icons/minus.gif" alt="" />{else}<img src="{$XT_IMAGES}spacer.gif" width="15" />{/if}</td>
    <td class="row" style="padding: 5px; padding-right: 0px; padding-left: 3px; width: 16px">
     <a href="javascript:window.parent.frames['slave1'].document.forms[0].x{$BASEID}_action.value='editHeader';window.parent.frames['slave1'].document.forms[0].x{$BASEID}_open.value='{$ENTRY.path}';window.parent.frames['slave1'].document.forms[0].submit();">{if $ENTRY.itw}{if $ENTRY.isFolder == 1}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />{else}<img src="{$XT_IMAGES}icons/explorer/document.png" alt="" />{/if}{else}{if $ENTRY.isFolder == 1}<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="" />{else}<img src="{$XT_IMAGES}icons/document.png" alt="" />{/if}{/if}</a><br />
    </td>
    <td class="row"><a href="javascript:window.parent.frames['slave1'].document.forms[0].x{$BASEID}_action.value='editHeader';window.parent.frames['slave1'].document.forms[0].x{$BASEID}_open.value='{$ENTRY.path}';window.parent.frames['slave1'].document.forms[0].submit();">{$ENTRY.title}&nbsp;</a></td>
   </tr>
   </table>
  </td>
 </tr>
 {/foreach}
</table>
<input type="hidden" name="x{$BASEID}_open" />
</form>