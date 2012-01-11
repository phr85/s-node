<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="POST" name="edit_forum">
 {include file="includes/buttons.tpl" data=$EDIT_FORUM_BUTTONS withouthidden=true}
 {include file="includes/lang_selector_submit.tpl" form="edit_forum"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" colspan="2">{"Node data"|translate}</td>
  </tr>
  <tr>
   <td class="left">{"name"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_title" value="{$NODE.title}" size="42"></td>
  </tr>
  <tr>
   <td class="left">{"description"|translate}</td>
   <td class="right">{toggle_editor id="description"}
   <textarea id="x{$BASEID}_description" name="x{$BASEID}_description" rows="6" cols="65">{$NODE.description}</textarea></td>
  </tr>
  <tr>
   <td class="left">{"Main image"|translate}</td>
   <td class="right">
    <a href="#" onclick="popup('{$smarty.server.PHP_SELF}?TPL=597&x240_field=x{$BASEID}_image&x240_form=edit_forum',770,470,'picker');"><img style="cursor: hand; cursor: pointer;" src="{$XT_IMAGES}icons/pick_photo.png" title="{"Pick an image"|translate}" alt="{"Pick an image"|translate}" /></a>{
    actionIcon
        action="deleteForumImage"
        icon="delete.png"
        form="edit_forum"
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
 {if $DISPLAY.relations}
 {include file="includes/widgets/relations.tpl" cid=$NODE.id ctitle=$NODE.title}
 {/if}
 </table>
  <input type="hidden" name="x{$BASEID}_image" value="{$NODE.image}" />
 <input type="hidden" name="x{$BASEID}_image_version" value="{$NODE.image_version}" />
{include file="ch.iframe.snode.forum/admin/hiddenValues.tpl"}
</form>
{include file="includes/editor.tpl"}