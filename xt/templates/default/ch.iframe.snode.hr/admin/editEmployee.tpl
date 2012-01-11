<script language="JavaScript"><!--
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>
<form method="POST" name="edit">
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Employee"|translate}: </span><span class="title">{$EMPLOYEE.lastName} {$EMPLOYEE.firstName}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$EDIT_BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"Last name"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_lastName" value="{$EMPLOYEE.lastName}" size="42"></td>
 </tr>
 <tr>
  <td class="left">{"First name"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_firstName" value="{$EMPLOYEE.firstName}" size="42"></td>
 </tr>
 <tr>
  <td class="left">{"E-Mail"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_email" value="{$EMPLOYEE.email}" size="42"></td>
 </tr>
 <tr>
  <td class="left">{"Telephone"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_tel" value="{$EMPLOYEE.tel}" size="15"></td>
 </tr>
 <tr>
  <td class="left">{"Linked to user"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_user_id" onChange="document.forms['edit'].x{$BASEID}_action.value='saveEmployee';document.forms['edit'].submit();">
    <option value="0" {if $EMPLOYEE.user_id == 0}selected{/if}>{"Not assigned"|translate}</option>
    {foreach from=$USERS item=USER}
    <option value="{$USER.id}" {if $EMPLOYEE.user_id == $USER.id}selected{/if}>{$USER.username}</option>
    {/foreach}
   </select>
  </td>
 </tr>
 <tr>
  <td class="left">{"Image"|translate}</td>
  <td class="right">
   <a href="#" onclick="popup('{$smarty.server.PHP_SELF}?TPL={$IMAGE_PICKER_TPL}&x{$IMAGE_PICKER_BASE_ID}_field=x{$BASEID}_image&x{$IMAGE_PICKER_BASE_ID}_form=edit',770,470,'picker');"><img style="cursor: hand; cursor: pointer;" src="{$XT_IMAGES}icons/pick_photo.png" title="{"Pick an image"|translate}" alt="{"Pick an image"|translate}" /></a>{
   actionIcon
       action="deleteImage"
       icon="delete.png"
       form="edit"
       yoffset=1
       title="Delete Image"
       ask="Are you sure that you want to delete this image relation"
       id=$EMPLOYEE.id
   }<br />
   {if $EMPLOYEE.image < 1}
   <img name="x{$BASEID}_image_view" src="{$XT_IMAGES}spacer.gif" alt="" />
   {else}
   <{if $EMPLOYEE.image_version == 'embed'}embed{else}img{/if} name="x{$BASEID}_image_view" src="{$XT_WEB_ROOT}download.php?file_id={$EMPLOYEE.image}&amp;file_version=1" {if $EMPLOYEE.image_version != 'embed'}alt=""{else}width="100%"{/if} class="picked">
   {/if}
  </td>
 </tr>
</table>
<input type="hidden" name="x{$BASEID}_id" />
<input type="hidden" name="x{$BASEID}_image" value="{$EMPLOYEE.image}" />
<input type="hidden" name="x{$BASEID}_image_version" value="{$EMPLOYEE.image_version}" />
{yoffset}
</form>
