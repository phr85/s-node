<form method="POST" name="edit">
<input type="submit" value="{$LABEL_SUBMIT}" name="submit" class="button" />
<br /><br />
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" colspan="2">{"User data"|translate}</td>
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
   <a href="#" onclick="popup('{$smarty.server.PHP_SELF}?TPL={$IMAGE_PICKER_TPL}&x{$IMAGE_PICKER_BASE_ID}_field=x{$BASEID}_image&x{$IMAGE_PICKER_BASE_ID}_form=edit',770,470,'picker');"><img style="cursor: hand; cursor: pointer; margin-bottom: 5px;" src="{$XT_IMAGES}icons/pick_photo.png" title="{"Pick an image"|translate}" alt="{"Pick an image"|translate}" /></a><br />
   {if $IMAGE == ''}
   <img name="x{$BASEID}_image_view" src="{$XT_IMAGES}spacer.gif" alt="" />
   {else}
   <img name="x{$BASEID}_image_view" src="/pictures/{$IMAGE}{$IMAGE_VERSION}" alt="" />
   <img name="x{$BASEID}_image_view" src="{filepath id=$IMAGE.image version=$IMAGE.version}" alt="" />
   {/if}
  </td>
 </tr>
</table>
<input type="hidden" name="x{$BASEID}_image" value="{$IMAGE}" />
<input type="hidden" name="x{$BASEID}_image_version" value="{$IMAGE_VERSION}" />
<input type="hidden" name="x{$BASEID}_action" value="saveUser" />
<input type="hidden" name="x{$BASEID}_id" value="{$USER_ID}" />
<input type="hidden" name="x{$BASEID}_username" value="{$USERNAME}" />
</form>
