<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="POST" name="editArticle" onSubmit="window.document.forms['editArticle'].x{$BASEID}_yoffset.value= window.pageYOffset;">
<a name="top" /><input type="hidden" name="x{$BASEID}_module" value="{$ADMINMODULE}">
<input type="hidden" name="x{$BASEID}_active" value="{$DATA.lang_active}">
<input type="hidden" name="x{$BASEID}_node_id" value="">
{include file="includes/buttons.tpl" data=$EDIT_ARTICLES_BUTTONS}
{inline_navigator data=$INLINE_NAVIGATION}
 <br><br>
 {include file="includes/lang_selector_submit.tpl" form="editArticle" action="saveArticle"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
  <td class="table_header" colspan="2">{"details"|translate}</td>
 </tr>
 <tr>
  <td class="left">{"active"|translate}</td>
  <td class="right">
  {if $DATA.lang_active  == 1}
  {actionIcon
     action  = "deactivateArticleLang"
     icon    = "active_small.gif"
     perm    = "activateArticle"
     form    = "editArticle"
     title   = "deactiveate article"
     nopermicon = "active.gif"
     nopermtitle="article is active"
     yoffset    = "1"
   }{else}{actionIcon
     action  = "activateArticleLang"
     icon    = "inactive_small.gif"
     perm    = "activateArticle"
     form    = "editArticle"
     title   = "activeate article"
     nopermicon = "inactive.gif"
     nopermtitle="article is inactive"
     yoffset     = "1"
   }{/if}
  </td>
 </tr>
 <tr>
  <td class="left">{"title"|translate}</td>
  <td class="right"><input type="text" size="42" name="x{$BASEID}_title" value="{$DATA.title}" onchange="window.parent.document.title = this.value"></td>
 </tr>
 <tr>
  <td class="left">{"lead"|translate}</td>
  <td class="right">
     <textarea name="x{$BASEID}_lead" rows="3" cols="42">{$DATA.lead}</textarea>
  </td>
 </tr>
 <tr>
  <td class="table_header" colspan="2">{"additional article properties"|translate} <a name="additionalProperties">&nbsp;</a>
  <input type="hidden" name="x{$BASEID}_field_id" value="">
  </td>
 </tr>
{foreach from=$ARTICLEFIELDS item=FIELD}
 <tr>
  <td class="left">
  <a href="javascript:
  if(confirm('{'q_delete_property'|translate}'))
   document.forms['editArticle'].x{$BASEID}_field_id.value={$FIELD.field_id};
   document.forms['editArticle'].x{$BASEID}_action.value='deletePropertyFromArticle';
   document.forms['editArticle'].submit();">
  <img src="images/icons/delete.png" align="right" alt="{"delete property"|translate}" title="{"delete property"|translate}"></a>
  <b>{$FIELD.label}</b><br>
  {$FIELD.description}
  </td>
  <td class="right"><textarea id="field_{$FIELD.field_id}" name="x{$BASEID}_field[{$FIELD.field_id}]" rows="2" cols="42">{$FIELD.value}</textarea></td>
 </tr>
{/foreach}
<tr>
  <td class="left">{"add properties"|translate}</td>
  <td class="right">
  <select name=x{$BASEID}_property_id>
    {html_options options=$FIELDNAMES}
  </select>
  <a href="javascript:document.forms['editArticle'].x{$BASEID}_action.value='addPropertiesToArticle'; document.forms['editArticle'].submit();">
   <img src="images/icons/breakpoint_add.png" alt="{"add property"|translate}" title="{"add property"|translate}">
  </a>
  </td>
</tr>
</table><br>

 {$EA_BASIC_DATAROWS}
<br>
{inline_navigator_top anchor ="articleImages"}<br>
 <table cellspacing="0" cellpadding="0" width="100%">
 <!-- images -->
<tr>
  <td class="table_header" colspan="2">{"article images"|translate}
     <input type="hidden" name="x{$BASEID}_delete_image_id" value="">
     <input type="hidden" name="x{$BASEID}_main_image_id" value="">
     <input type="hidden" name="x{$BASEID}_move_image_id" value="">
  </td>
 </tr>
{foreach from=$IMAGES item=IMAGE}
 <tr>
  <td class="left">{"image"|translate}<a name="articleImages_{$IMAGE.position}">&nbsp;</a><br>
  {if $IMAGE.main == 1}
  <img src="images/icons/photo_scenery.png" alt="{"this is the main image of the article"|translate}" title="{"this is the main image of the article"|translate}" style="cursor: hand; cursor: pointer; margin-bottom: 5px;">
  {/if}
  </td>
   <td class="right">
   <img id="image_{$IMAGE.position}" onclick="popup('{$smarty.server.PHP_SELF}?TPL={$IMAGE_PICKER_TPL}&x{$IMAGE_PICKER_BASE_ID}_field=x{$BASEID}_image_{$IMAGE.position}&x{$IMAGE_PICKER_BASE_ID}_form=editArticle',770,470,'picker');" style="cursor: hand; cursor: pointer; margin-bottom: 5px;" src="{$XT_IMAGES}icons/pick_photo.png" title="{"pick_image"|translate}" alt="{"pick_image"|translate}">
   {actionIcon
     action  = "deleteImageFromArticle"
     icon    = "delete.png"
     form    = "editArticle"
     title   = "delete image"
     ask     = "delete this image?"
     yoffset     = "1"
     delete_image_id=$IMAGE.position
   }

   {if $IMAGE.image != 0}<a href="javascript:
   document.forms['editArticle'].x{$BASEID}_move_image_id.value={$IMAGE.position};
   document.forms['editArticle'].x{$BASEID}_action.value='moveImageDown';

   document.forms['editArticle'].submit();">
     <img src="images/icons/explorer/arrow_down_green.png" alt="{"move_down_image"|translate}" title="{"move_down_image"|translate}" style="cursor: hand; cursor: pointer; margin-bottom: 5px;"></a>
   <a href="javascript:
   document.forms['editArticle'].x{$BASEID}_move_image_id.value={$IMAGE.position};
   document.forms['editArticle'].x{$BASEID}_action.value='moveImageUp';
   document.forms['editArticle'].submit();">
     <img src="images/icons/explorer/arrow_up_green.png" alt="{"move_up_image"|translate}" title="{"move_up_image"|translate}" style="cursor: hand; cursor: pointer; margin-bottom: 5px;"></a>
     {if $IMAGE.main == 0}
     <a href="#" onclick="javascript:document.forms['editArticle'].x{$BASEID}_action.value='setMainImage';document.forms['editArticle'].x{$BASEID}_main_image_id.value={$IMAGE.position};document.forms['editArticle'].submit();"><img src="images/icons/photo_small.png" alt="{"make this image to main image"|translate}" title="{"make this image to main image"|translate}" style="cursor: hand; cursor: pointer; margin-bottom: 5px;"></a>
     {/if}
   {/if}
   <br>

   {if $IMAGE.image == ''}
   <img name="x{$BASEID}_image_{$IMAGE.position}_view" src="{$XT_IMAGES}spacer.gif" alt="">
   {else}
   <{if $IMAGE.version == 'embed'}embed{else}img{/if} name="x{$BASEID}_image_{$IMAGE.position}_view" src="{filepath id=$IMAGE.image version=$IMAGE.version}" {if $IMAGE.version != 'embed'}alt=""{else}width="100%"{/if}>
   {/if}
   <input type="hidden" name="x{$BASEID}_image_{$IMAGE.position}" value="{$IMAGE.image}">
   <input type="hidden" name="x{$BASEID}_image_{$IMAGE.position}_version" value="{$IMAGE.version}">
   <input type="hidden" name="x{$BASEID}_image_versions[{$IMAGE.position}]" value="{$IMAGE.position}">
  </td>
 </tr>
{/foreach}
 <tr>
  <td class="left">{"add image"|translate}</td>
  <td class="right"><a
  href="javascript:document.forms['editArticle'].x{$BASEID}_action.value='addImageToArticle'; document.forms['editArticle'].submit();"
  ><img
  style="cursor: hand; cursor: pointer; margin-bottom: 5px;"
  src="{$XT_IMAGES}icons/breakpoint_add.png"
  title="{"add image"|translate}"
  alt="{"add image"|translate}"></a>
  </td>
 </tr>
</table>
{if $CONF.related == true}
{include file="ch.iframe.snode.catalog/admin/edit_articles_related.tpl"}
{/if}
{foreach from=$EDIT_ARTICLE_DATAROWS item=ENTRY}
  {if $ENTRY.label == "head"}
   <br>
   <table cellspacing="0" cellpadding="0" width="100%">
    <tr>
      <td class="table_header" colspan="2">{$ENTRY.input|translate}</td>
    </tr>
  {elseif $ENTRY.label == "end"}
   </table>
  {else}
    <tr>
      <td class="left">{$ENTRY.label|translate}</td>
      <td class="right">{$ENTRY.input}</td>
    </tr>
  {/if}
{/foreach}
<input type="hidden" name="x{$BASEID}_id" value="{$DATA.id}">

{if $FOCUS.segment != ''}
<img src="{$XT_IMAGES}spacer.gif" onLoad="anchor('{$FOCUS.segment}');" width="1">
{/if}
{if $FOCUS.field != ''}
<img src="{$XT_IMAGES}spacer.gif" onLoad="document.forms['editArticle'].{$FOCUS.field}.focus();" width="1">
{/if}
{if $PICKER > 0}
<img src="{$XT_IMAGES}spacer.gif" onLoad="popup('{$smarty.server.PHP_SELF}?TPL={$IMAGE_PICKER_TPL}&x{$IMAGE_PICKER_BASE_ID}_field=x{$BASEID}_image_{$PICKER}&x{$IMAGE_PICKER_BASE_ID}_form=editArticle',770,470,'picker');" width="1">
{/if}
{yoffset}
</form>
