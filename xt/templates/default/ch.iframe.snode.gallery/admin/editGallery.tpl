{if $LIVETPL != 1}
{literal}
<script language="JavaScript"><!--
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>
{/literal}
{else}
<script language="JavaScript"><!--
opener.document.location.reload();
//-->
</script>
{/if}
<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="post" name="edit_node" onsubmit="window.document.forms['navigation'].x{$BASEID}_yoffset.value=window.pageYOffset;">
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="view_header" colspan="2">
    <span class="title_light">{"Gallery"|translate}:</span> <span class="title">{$NODE.title}</span>
   </td>
  </tr>
  <tr>
   <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
  </tr>
 </table>
 {include file="includes/buttons.tpl" data=$BUTTONS}
 {include file="includes/lang_selector_submit.tpl" form="edit_node" action="saveNode"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="left">{"Title"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_title" value="{$NODE.title|htmlspecialchars}" size="42"></td>
  </tr>
  <tr>
   <td class="left">{"Description"|translate}</td>
   <td class="right">{toggle_editor id="description"}
   <textarea id="x{$BASEID}_description" name="x{$BASEID}_description" cols="65" rows="4">{$NODE.description}</textarea></td>
  </tr>
  <tr>
   <td class="left">{"Image count"|translate}</td>
   <td class="right">{$COUNT}</td>
  </tr>
  <tr>
   <td class="left">{"Is this gallery public?"|translate}</td>
   <td class="right"><input type="checkbox" name="x{$BASEID}_public" value="1" {if $NODE.public == 1}checked{/if}></td>
  </tr>
  <tr>
   <td class="left">{"Main image"|translate}<a name="image" /></td>
   <td class="right">
    <a href="#image" onclick="popup('{$smarty.server.PHP_SELF}?TPL=597&x240_field=x{$BASEID}_image&x240_form=edit_node',770,470,'picker');"><img style="cursor: hand; cursor: pointer;" src="{$XT_IMAGES}icons/pick_photo.png" title="{"Pick an image"|translate}" alt="{"Pick an image"|translate}" /></a>{
    actionIcon
        action="deleteImage"
        icon="delete.png"
        form="edit_node"
        yoffset=1
        title="Delete Image"
        ask="Are you sure you want to delete this image relation?"
    }<br />
    {if $NODE.image < 1}
    <img name="x{$BASEID}_image_view" src="{$XT_IMAGES}spacer.gif" alt="" />
    {else}
    <{if $NODE.image_version == 'embed'}embed{else}img{/if} name="x{$BASEID}_image_view" src="{$XT_WEB_ROOT}download.php?file_id={$NODE.image}&file_version=2" {if $NODE.image_version != 'embed'}alt=""{else}width="100%"{/if} class="picked" />
    {/if}
   </td>
  </tr>
  <tr>
   <td class="view_header" colspan="2">
    <span class="title">{'Content'|translate}</span>
   </td>
  </tr>
  <tr>
   <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
  </tr>
  {if $DISPLAY.relations}
 {include file="includes/widgets/relations.tpl" cid=$NODE_ID ctitle=$NODE.title}
{/if}
{if $DISPLAY.properties}
  {include file="includes/widgets/properties.tpl" content_id=$NODE_ID content_type=$BASEID formname="edit_node" universal=true lang=$ACTIVE_LANG}
{/if}
 </table>
 {include file="includes/buttons.tpl" data=$CONTENT_BUTTONS withouthidden="1"}

 <table cellpadding="0" cellspacing="0" width="100%">
 {foreach from=$FILES key=KEY item=FILE name=F}
 {if $KEY%3 == 0}<tr class="{cycle values="row_a,row_b"}">{/if}
  <td class="button" style="padding-left: 16px; padding-right: 0px;width: 10px;">{if !$smarty.foreach.F.first}{
  actionIcon
      action="moveUp"
      icon="explorer/arrow_left_green.png"
      title="Move up"
      form="0"
      file=$FILE.id
      pos=$FILE.pos
      yoffset=1
  }{else}<img src="/images/spacer.gif" alt="" width="16" />{/if}{if !$smarty.foreach.F.last}{
  actionIcon
      action="moveDown"
      icon="explorer/arrow_right_green.png"
      title="Move down"
      form="0"
      file=$FILE.id
      pos=$FILE.pos
      yoffset=1
  }{else}<img src="/images/spacer.gif" alt="" width="16" />{/if}{
  if $FILE.active == 1}{
  actionIcon
      action="deactivateImage"
      icon="active.png"
      title="Deactivate this image"
      form="0"
      file=$FILE.id
      yoffset=1
  }{else}{
  actionIcon
      action="activateImage"
      icon="inactive.png"
      title="Activate this image"
      form="0"
      file=$FILE.id
      yoffset=1
  }{/if}{
  actionIcon
      action="removeFileFromGallery"
      icon="delete.png"
      title="Remove this image"
      form="0"
      folder=$FILE.source_folder_id
      file=$FILE.id
      pos=$FILE.pos
      yoffset=1
  }</td>
  <td class="row" width="80">{$FILE.title|truncate:15:"...":true}<a name="file" /><br />
  {if $FILE.type == 1}<a href="#file" onclick="popup('{$smarty.server.PHP_SELF}?TPL=160&x240_file_id={$FILE.id}');">{image
      id=$FILE.id
      version=0
      title=$FILE.title
      alt=$FILE.title
      yoffset=1
      style="margin-top: 5px; border: 1px solid black;"
  }</a>{/if}</td>
 {if $KEY%3 == 2}<td class="row">&nbsp;</td></tr>{/if}
 {/foreach}
 {if sizeof($FILES)%3 == 1}
 <td class="row" colspan="6">&nbsp;<td></tr>
 {/if}
 {if sizeof($FILES)%3 == 2}
 <td class="row" colspan="3">&nbsp;<td></tr>
 {/if}
 </table>
{include file="includes/editor.tpl"}
<input type="hidden" name="x{$BASEID}_node_id" value="{$NODE_ID}" />
<input type="hidden" name="x{$BASEID}_module" value="{$ADMINMODULE}" />
<input type="hidden" name="x{$BASEID}_save_lang" value="{$ACTIVE_LANG}" />
<input type="hidden" name="x{$BASEID}_node_pid" />
<input type="hidden" name="x{$BASEID}_id" />
<input type="hidden" name="x{$BASEID}_position" />
<input type="hidden" name="x{$BASEID}_file" />
<input type="hidden" name="x{$BASEID}_folder" />
<input type="hidden" name="x{$BASEID}_pos" />
<input type="hidden" name="x{$BASEID}_active" value="{$NODE.active}" />
<input type="hidden" name="x{$BASEID}_image" value="{$NODE.image}" />
<input type="hidden" name="x{$BASEID}_image_version" value="{$NODE.image_version}" />
<input type="hidden" name="x{$BASEID}_livetpl" value="{$LIVETPL}"/>
{yoffset}
</form>



