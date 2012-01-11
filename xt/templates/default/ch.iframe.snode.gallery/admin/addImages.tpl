{if $LIVETPL == 1}
<script language="JavaScript"><!--
opener.document.location.reload();
//-->
</script>
{/if}
<form method="post" name="o">
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Add / Remove images to gallery"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$BUTTONS}
{include file="includes/lang_selector_simple.tpl" form="o"}
<table cellpadding="0" cellspacing="0" width="100%">
 {foreach from=$NODES item=NODE}
  <tr class="{cycle values="row_a,row_b"}">
   <td>
    <table cellspacing="0" cellpadding="0" width="100%">
     <tr>
      {if $NODE.l != 1}<td class="row" style="padding: 8px; padding-right: 3px; padding-left: {$NODE.level*20-32}px; width: 1px;">{if $NODE.subs > 0}{if $NODE.itw}<a href="javascript:document.forms['o'].x{$BASEID}_openfolder.value={$NODE.pid};document.forms['o'].submit();"><img src="{$XT_IMAGES}icons/minus.gif" alt="" /></a>{else}<a href="javascript:document.forms['o'].x{$BASEID}_yoffset.value=window.pageYOffset;document.forms['o'].x{$BASEID}_openfolder.value={$NODE.id};document.forms['o'].submit();"><img src="{$XT_IMAGES}icons/plus.gif" alt="" /></a>{/if}{else}<img src="{$XT_IMAGES}spacer.gif" width="9" />{/if}</td>{/if}
      <td class="row" style="padding: 5px; padding-right: 0px;width: 16px">
       <a href="javascript:document.forms['o'].x{$BASEID}_yoffset.value=window.pageYOffset;document.forms['o'].x{$BASEID}_openfolder.value={$NODE.id};document.forms['o'].submit();">{if $NODE.itw}{if $NODE.subs > 0}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />{else}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />{/if}{else}{if $NODE.subs > 0}<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="" />{else}<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="" />{/if}{/if}</a><br />
      </td>
      <td class="row" style="padding: 3px; padding-right: 0px;width: 16px">
       <input type="checkbox" name="x{$BASEID}_nodes[{$NODE.id}]" value="1" {if $REL_FOLDERS[$NODE.id]}checked onclick="javascript:document.forms['o'].x{$BASEID}_yoffset.value=window.pageYOffset;document.forms['o'].x{$BASEID}_folder.value='{$NODE.id}';document.forms['o'].x{$BASEID}_action.value='removeFolderFromGallery';document.forms['o'].submit();"{else}onclick="javascript:document.forms['o'].x{$BASEID}_yoffset.value=window.pageYOffset;document.forms['o'].x{$BASEID}_folder.value='{$NODE.id}';document.forms['o'].x{$BASEID}_action.value='addFolderToGallery';document.forms['o'].submit();"{/if} />
      </td>
      <td class="row"><a href="javascript:document.forms['o'].x{$BASEID}_yoffset.value=window.pageYOffset;document.forms['o'].x{$BASEID}_openfolder.value={$NODE.id};document.forms['o'].submit();">{if $NODE.itw}<span style="color: black;">{if $NODE.selected}<b>{$NODE.title}</b>{else}{$NODE.title}{/if}</span>{else}{$NODE.title}{/if}&nbsp;</a></td>
      <td class="button" align="right"></td>
     </tr>
    </table>
   </td>
  </tr>
 {/foreach}
</table>
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Images in active folder"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
<table cellpadding="0" cellspacing="0" width="100%">
{foreach from=$FILES item=FILE}
 <tr class="{cycle values="row_a,row_b"}">
  <td class="button" style="padding-left: 16px; padding-right: 0px;width: 10px;"><img src="/images/icons/photo_portrait.png" alt="" /></td>
  <td class="row" style="padding: 3px; padding-right: 0px;width: 16px">
   <input type="checkbox" name="x{$BASEID}_files[{$FILE.id}]" value="1" {if $REL_FILES[$FILE.id]}checked onclick="javascript:document.forms['o'].x{$BASEID}_file.value='{$FILE.id}';document.forms['o'].x{$BASEID}_folder.value='{$FILE.node_id}';document.forms['o'].x{$BASEID}_action.value='removeFileFromGallery';document.forms['o'].x{$BASEID}_yoffset.value=window.pageYOffset;document.forms['o'].submit();"{else}onclick="javascript:document.forms['o'].x{$BASEID}_file.value='{$FILE.id}';document.forms['o'].x{$BASEID}_folder.value='{$FILE.node_id}';document.forms['o'].x{$BASEID}_action.value='addFileToGallery';document.forms['o'].x{$BASEID}_yoffset.value=window.pageYOffset;document.forms['o'].submit();"{/if} />
  </td>
  <td class="row">{$FILE.filename}<br />
  {if $FILE.type == 1}{image
      id=$FILE.id
      version=0
      title=$FILE.filename
      alt=$FILE.filename
      style="margin-top: 5px; border: 1px solid black;"
  }{/if}</td>
 </tr>
{/foreach}
</table>
<input type="hidden" name="x{$BASEID}_id" value="" />
<input type="hidden" name="x{$BASEID}_position" value="" />
<input type="hidden" name="x{$BASEID}_node_id" value="{$OPEN_GALLERY}" />
<input type="hidden" name="x{$BASEID}_node_pid" value="" />
<input type="hidden" name="x{$BASEID}_openfolder" value="" />
<input type="hidden" name="x{$BASEID}_folder" value="" />
<input type="hidden" name="x{$BASEID}_file" value="" />
<input type="hidden" name="x{$BASEID}_pos" value="" />
<input type="hidden" name="x{$BASEID}_source_node_id" value="" />
<input type="hidden" name="module" value="ai" />
<input type="hidden" name="x{$BASEID}_livetpl" value="{$LIVETPL}" />
{yoffset}
</form>