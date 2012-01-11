{literal}
<script language="JavaScript"><!--
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>
{/literal}
<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="POST" name="edit_node">
 <h2><span class="light">{"Folder"|translate}:</span> {$NODE.title}</h2>
 {include file="includes/buttons.tpl" data=$EDIT_NODE_BUTTONS}
 {include file="includes/lang_selector_submit.tpl" form="edit_node" action="saveNode"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="left">{"name"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_title" value="{$NODE.title|htmlspecialchars}" size="42"></td>
  </tr>
  <tr>
   <td class="left">{"description"|translate}</td>
   <td class="right">{toggle_editor id="description"}
   <textarea id="x{$BASEID}_description" name="x{$BASEID}_description" cols="65" rows="6">{$NODE.description}</textarea></td>
  </tr>
  <tr>
   <td class="left">{"public"|translate}</td>
   <td class="right">
   <input type="checkbox" name="x{$BASEID}_public" {if $NODE.public==1} checked="checked" {/if} />{"public"|translate}</td>
  </tr>
  <tr>
  <tr>
   <td class="left">{"Main image"|translate}</td>
   <td class="right">
   <a href="#" onclick="popup('{$smarty.server.PHP_SELF}?TPL=597&x240_field=x{$BASEID}_image&x240_form=edit_node',770,470,'picker');">
    <img src="{$XT_IMAGES}icons/pick_photo.png" title="{"Pick an image"|translate}" alt="{"Pick an image"|translate}" /></a>{
    actionIcon
        action="deleteNodeImage"
        icon="delete.png"
        form="edit_node"
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
  {if $DISPLAY.properties}
  {include file="includes/widgets/properties.tpl" content_id=$NODE_ID content_type=271 WBASEID=271 formname="edit_node" universal=false lang=$ACTIVE_LANG}
{/if}
   {if $DISPLAY.relations}
 {include file="includes/widgets/relations.tpl" cid=$NODE_ID ctitle=$NODE.title ctype=271}
 {/if}
 </table>
 <input type="hidden" name="x{$BASEID}_node_id" value="{$NODE_ID}">
 <input type="hidden" name="x{$BASEID}_module" value="{$ADMINMODULE}">
 <input type="hidden" name="x{$BASEID}_save_lang" value="{$ACTIVE_LANG}">
 <input type="hidden" name="x{$BASEID}_node_pid">
 <input type="hidden" name="x{$BASEID}_active" value="{$NODE.active}">
 <input type="hidden" name="x{$BASEID}_position">
 <input type="hidden" name="x{$BASEID}_file_id">
 <input type="hidden" name="x{$BASEID}_id">
 <input type="hidden" name="x{$BASEID}_image" value="{$NODE.image}">
 <input type="hidden" name="x{$BASEID}_image_version" value="{$NODE.image_version}">
 {include file="includes/editor.tpl}
</form>