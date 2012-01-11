{literal}
<script language="JavaScript"><!--
if(window.parent.frames['master']){
    window.parent.frames['master'].document.forms[1].submit();
}
//-->
</script>
{/literal}
<form method="POST" name="edit">
{include file="includes/buttons.tpl" data=$EDIT_BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Information"|translate}:&nbsp;</span><span class="title">{$DATA.title}</span>

  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
    <td class="left">{"Image"|translate}&nbsp;</td>
    <td class="right">
    <a href="#" onclick="popup('{$smarty.server.PHP_SELF}?TPL={$IMAGE_PICKER_TPL}&x{$IMAGE_PICKER_BASE_ID}_field=x{$BASEID}_image&x{$IMAGE_PICKER_BASE_ID}_form=edit',770,470,'picker');"><img style="cursor: hand; cursor: pointer;" src="{$XT_IMAGES}icons/pick_photo.png" title="{"Pick an image"|translate}" alt="{"Pick an image"|translate}" /></a>{
   actionIcon
       action="deleteImage"
       icon="delete.png"
       form="edit"
       yoffset=1
       title="Delete Image"
       ask="Are you sure that you want to delete this image relation"
       feed_id = $DATA.id
   }<br />
   {if $DATA.image == ''}
   <img name="x{$BASEID}_image_view" src="{$XT_IMAGES}spacer.gif" alt="" />
   {else}
   <{if $DATA.image_version == 'embed'}embed{else}img{/if} name="x{$BASEID}_image_view" src="{$XT_WEB_ROOT}download.php?file_id={$DATA.image}&file_version=2" {if $DATA.image_version != 'embed'}alt=""{else}width="100%"{/if}>
   {/if}</td>
 </tr>
 <tr>
  <td class="left">{"Title"|translate}&nbsp;</td>
  <td class="right"><input type="text" name="x{$BASEID}_title" value="{$DATA.title|htmlspecialchars}" size="42"></td>
 </tr>
 <tr>
  <td class="left">{"Creator"|translate}&nbsp;</td>
  <td class="right"><input type="text" name="x{$BASEID}_creator" value="{$DATA.creator|htmlspecialchars}" size="42"></td>
 </tr>
 <tr>
  <td class="left">{"Tagline"|translate}&nbsp;</td>
  <td class="right"><input type="text" name="x{$BASEID}_tagline" value="{$DATA.tagline|htmlspecialchars}" size="42"></td>
 </tr>
 <tr>
  <td class="left">{"Description"|translate}&nbsp;</td>
  <td class="right"><textarea name="x{$BASEID}_description" cols="65" rows="4">{$DATA.description}</textarea></td>
 </tr>
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Feed"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"Check file"|translate}&nbsp;</td>
  <td class="right"><input type="text" name="x{$BASEID}_checkfile" value="{$DATA.checkfile}" size="42"></td>
 </tr>
 <tr>
  <td class="left">{"Generator file"|translate}&nbsp;</td>
  <td class="right"><input type="text" name="x{$BASEID}_generator" value="{$DATA.generator}" size="42"></td>
 </tr>
</table>
{if count($PARAMS) > 0 }
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="3">
   <span class="title">{"Parameters"|translate}</span>
  </td>
 </tr>
  <tr>
  <td class="view_separator" colspan="3"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 {foreach from=$PARAMS item=PARAM}
 <tr>
  <td class="left">{
  actionIcon
      action="deleteParam"
      icon="delete.png"
      form="edit"
      title="Delete this parameter"
      param_id=$PARAM.id
  }</td>
  <td class="right">{$PARAM.name}&nbsp;</td>
  <td class="right"><input type="text" name="x{$BASEID}_param[{$PARAM.id}]" value="{$PARAM.value}" size="42"></td>
 </tr>
 {/foreach}
</table>
{/if}
<input type="hidden" name="x{$BASEID}_feed_id" value="{$DATA.id}" />
<input type="hidden" name="x{$BASEID}_profile_id" value="{$DATA.profile}" />
<input type="hidden" name="x{$BASEID}_param_id" value="" />
<input type="hidden" name="x{$BASEID}_yoffset" value="" />
<input type="hidden" name="x{$BASEID}_image" value="{$DATA.image}" />
<input type="hidden" name="x{$BASEID}_image_version" value="{$DATA.image_version}" />
</form>