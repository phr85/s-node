<form method="POST" name="browser">
{include file="includes/buttons.tpl" data=$BROWSER_BUTTONS withouthidden=1}
<table cellspacing="0" cellpadding="0" width="100%">
 {foreach from=$FOLDERS item=FOLDER}
 <tr class="{cycle values=row_a,row_b}">
  <td class="button" style="width: 16px;"><a href="javascript:document.forms[0].x{$BASEID}_open.value={$FOLDER.id};document.forms[0].submit();window.parent.frames['master'].document.forms['o'].x{$BASEID}_open.value={$FOLDER.id};window.parent.frames['master'].document.forms['o'].submit();"><img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="" /></a></td>
  <td class="row" colspan="3"><a href="javascript:document.forms[0].x{$BASEID}_open.value={$FOLDER.id};document.forms[0].submit();window.parent.frames['master'].document.forms['o'].x{$BASEID}_open.value={$FOLDER.id};window.parent.frames['master'].document.forms['o'].submit();">{$FOLDER.title}</a>&nbsp;</td>
 </tr>
 {/foreach}
 {foreach from=$FILES item=FILE}
 <tr class="{cycle values=row_a,row_b}">
  <td class="button" style="width: 16px;">
  {if $FILE.type == 3}
  <img src="{$XT_IMAGES}icons/filetypes/ttf.png" alt="" />
  {/if}
  {if $FILE.type == 2}
  <img src="{$XT_IMAGES}icons/photo_portrait.png" alt="" />
  {/if}
  {if $FILE.type == 1}
  <img src="{$XT_IMAGES}icons/filetypes/image.png" alt="" />
  {/if}
  {if $FILE.type == 0}
  <img src="{$XT_IMAGES}icons/document.png" alt="" />
  {/if}</td>
  <td class="row" width="250"><a href="javascript:window.parent.frames['slave1'].document.forms[0].x{$BASEID}_action.value='viewFile';window.parent.frames['slave1'].document.forms[0].x{$BASEID}_file_id.value={$FILE.id};window.parent.frames['slave1'].document.forms[0].submit();">{$FILE.title}</a></td>
  <td class="row">{$FILE.filesize|format_filesize}</td>
  <td class="button" align="right"><a href="{$smarty.server.PHP_SELF}?TPL=658&x{$BASEID}_file_id={$FILE.id}&x{$BASEID}_file_name={$FILE.title}"><img src="{$XT_IMAGES}icons/view.png" alt="" class="icon" /></a>{
  actionIcon
        action="deleteFile"
        icon="delete.png"
        form="browser"
        file_id=$FILE.id
        node_pid=$OPEN
        node_perm="deleteFiles"
        title="Delete this file"
        ask="Are you sure you want to delete this file?"
  }</td>
 </tr>
 {/foreach}
</table>
{include file="ch.iframe.snode.securitycenter/admin/hiddenValues.tpl"}
</form>
