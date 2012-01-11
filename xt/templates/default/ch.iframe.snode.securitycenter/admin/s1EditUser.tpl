{literal}
<script language="JavaScript"><!--
if(window.parent.frames['master']){
    window.parent.frames['master'].document.forms[1].submit();
}
//-->
</script>
{/literal}
<form method="POST" name="edit">
{include file="ch.iframe.snode.securitycenter/admin/hiddenValues.tpl"}
<input type="hidden" name="x{$BASEID}_address_id" value="{$address_id}" />
{include file="includes/buttons.tpl" data=$BUTTONS withouthidden=1}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"User"|translate}:</span> <span class="title">{$username}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 {foreach from=$USER key=FIELD item=ROW}
 <tr>
  <td class="left" width="200" valign="top">{$ROW.label}</td>
  {if $ROW.type == 'text'}
    <td class="right">{$ROW.value}<input type="hidden" name="x{$BASEID}_{$FIELD}" value="{$ROW.value}"></td>
  {/if}
  {if $ROW.type == 'inputpassword'}
    <td class="right"><input type="password" name="x{$BASEID}_{$FIELD}" size="{$ROW.size}"></b></td>
  {/if}
  {if $ROW.type == 'inputtext'}
    <td class="right"><input type="text" name="x{$BASEID}_{$FIELD}" value="{$ROW.value}" size="{$ROW.size}"></td>
  {/if}
  {if $ROW.type == 'inputarea'}
    <td class="right">
     <textarea name="x{$BASEID}_{$FIELD}" rows="{$ROW.rows}" cols="{$ROW.cols}">{$ROW.value}</textarea>
    </td>
  {/if}
  {if $ROW.type == 'select'}
    <td class="right" valign="middle">
     <select name="x{$BASEID}_{$FIELD}">
      {html_options values=$ROW.value selected=$ROW.selected output=$ROW.value_labels}
     </select>
    </td>
  {/if}
 </tr>
 {/foreach}
  <tr>
  <td class="left">{"Image"|translate}</td>
  <td class="right">
   <a href="#" onclick="popup('{$smarty.server.PHP_SELF}?TPL={$IMAGE_PICKER_TPL}&x{$IMAGE_PICKER_BASE_ID}_field=x{$BASEID}_image&x{$IMAGE_PICKER_BASE_ID}_form=edit',770,470,'picker');"><img style="cursor: hand; cursor: pointer;" src="{$XT_IMAGES}icons/pick_photo.png" title="{"Pick an image"|translate}" alt="{"Pick an image"|translate}" /></a>{
   actionIcon
       action="s1DeleteImageFromUser"
       icon="delete.png"
       form="edit"
       title="Delete Image"
       ask="Are you sure that you want to delete this image relation"
       user_id= $USER_ID
   }<br />
   {if $IMAGE == ''}
   <img name="x{$BASEID}_image_view" src="{$XT_IMAGES}spacer.gif" alt="" />
   {else}
   {image id=$IMAGE version=1 name="x100_image_view"}
   {/if}
  </td>
 </tr>
</table>
</form>