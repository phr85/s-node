 <!-- images -->
 <tr>
  <td class="view_header" colspan="2">
   <span class="title"> {"Images"|translate}</span>{inline_navigator_top anchor ="articleImages"}
     <input type="hidden" name="x{$BASEID}_delete_image_id" value="">
     <input type="hidden" name="x{$BASEID}_main_image_id" value="">
     <input type="hidden" name="x{$BASEID}_move_image_id" value="">
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
</tr>
 <tr>
  <td class="left">{"add image folder"|translate}<br />

  </td>
  <td class="right">
  <a href="#" onclick="popup('{$smarty.server.PHP_SELF}?TPL={$IMAGE_CATEGORY_PICKER_TPL}&x{$IMAGE_PICKER_BASE_ID}_field=x{$BASEID}_imagefolder&x{$IMAGE_PICKER_BASE_ID}_form=editArticle&x{$IMAGE_PICKER_BASE_ID}_actionField=x{$BASEID}_action',770,470,'picker');"><img style="cursor: hand; cursor: pointer;" src="{$XT_IMAGES}icons/pick_photo.png" title="{"pick_folder"|translate}" alt="{"pick_folder"|translate}" />
<input type="hidden" name="x{$BASEID}_imagefolder" value="" />
   </td>
</tr>


{foreach from=$IMAGES item=IMAGE}
 <tr>
  <td class="left">{"image"|translate}<a name="articleImages_{$IMAGE.position}">&nbsp;</a><br />
  {if $IMAGE.main == 1}
  <img src="images/icons/photo_scenery.png" alt="{"this is the main image of the article"|translate}" title="{"this is the main image of the article"|translate}" style="cursor: hand; cursor: pointer;" />
  {/if}
  </td>
  <td class="right">
   <img id="image_{$IMAGE.position}" onclick="popup('{$smarty.server.PHP_SELF}?TPL={$IMAGE_PICKER_TPL}&x{$IMAGE_PICKER_BASE_ID}_field=x{$BASEID}_image_{$IMAGE.position}&x{$IMAGE_PICKER_BASE_ID}_form=editArticle',770,470,'picker');" style="cursor: hand; cursor: pointer;" src="{$XT_IMAGES}icons/pick_photo.png" title="{"pick_image"|translate}" alt="{"pick_image"|translate}" />
   {if $IMAGE.image != 0}<a href="javascript:
   document.forms['editArticle'].x{$BASEID}_move_image_id.value={$IMAGE.position};
   document.forms['editArticle'].x{$BASEID}_action.value='moveImageDown';

   document.forms['editArticle'].submit();">
     <img src="images/icons/explorer/arrow_down_green.png" alt="{"move_down_image"|translate}" title="{"move_down_image"|translate}" style="cursor: hand; cursor: pointer;" /></a>
   <a href="javascript:
   document.forms['editArticle'].x{$BASEID}_move_image_id.value={$IMAGE.position};
   document.forms['editArticle'].x{$BASEID}_action.value='moveImageUp';
   document.forms['editArticle'].submit();">
     <img src="images/icons/explorer/arrow_up_green.png" alt="{"move_up_image"|translate}" title="{"move_up_image"|translate}" style="cursor: hand; cursor: pointer;" /></a>
     {if $IMAGE.main == 0}
     <a href="javascript:document.forms['editArticle'].x{$BASEID}_action.value='setMainImage';document.forms['editArticle'].x{$BASEID}_main_image_id.value={$IMAGE.position};document.forms['editArticle'].submit();"><img
        src="images/icons/photo_small.png" alt="{"make this image to main image"|translate}" title="{"make this image to main image"|translate}" /></a>
     {/if}
   {/if}
   {actionIcon
     action  = "deleteImageFromArticle"
     icon    = "delete.png"
     form    = "editArticle"
     title   = "delete image"
     ask     = "delete this image?"
     yoffset     = "1"
     delete_image_id=$IMAGE.position
   }
   <br />

   {if $IMAGE.image == ''}
   <img name="x{$BASEID}_image_{$IMAGE.position}_view" src="{$XT_IMAGES}spacer.gif" alt="" />
   {else}
   <{if $IMAGE.version == 'embed'}embed{else}img{/if} name="x{$BASEID}_image_{$IMAGE.position}_view" src="{$XT_WEB_ROOT}download.php?file_id={$IMAGE.image}&file_version={$IMAGE.version}" {if $IMAGE.version != 'embed'}alt=""{else}width="100%"{/if} class="picked">
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
  alt="{"add image"|translate}" /></a>
  </td>
 </tr>
