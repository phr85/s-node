<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="table_header" colspan="3">{"Media browser"|translate} - <b>{$OPEN_FOLDER.title}</b></td>
 </tr>
 {if sizeof($MEDIA) > 0}
 {foreach from=$MEDIA item=ITEM name=M}
 <tr class="{cycle values="row_a,row_b" name="picbrowser"}">
  <td class="row" style="padding: 5px; width: 32px"><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_action=viewPic&x{$BASEID}_media_id={$ITEM.id}"><img src="/pictures/{$ITEM.id}_0" width="50" alt="" class="browser"></a></td>
  <td class="row" style="padding-top: 5px; padding-left: 2px; vertical-align: top;"><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_action=viewPic&x{$BASEID}_media_id={$ITEM.id}">{$ITEM.title}</a><br>{$ITEM.filesize/1000} KB - {$ITEM.width} x {$ITEM.height}</td>
  <td style="padding: 5px; vertical-align: top;" align="right">
  {if !$PICKER}{if "deleteMedia"|allowed}<a href="javascript:ask('Are you sure to delete this media element?','{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_action=deleteMedia&x{$BASEID}_media_id={$ITEM.id}')"><img src="{$XT_IMAGES}icons/photo_scenery_delete.png" alt="{'Delete item'|translate} - {$ITEM.title}" title="{'Delete item'|translate} - {$ITEM.title}"></a>{/if}{else}<a href="javascript:window.opener.document.forms['{$PICKER_FORM}'].{$PICKER_FIELD}.value={$ITEM.id};window.opener.document.forms['{$PICKER_FORM}'].{$PICKER_FIELD}_version.value=1;window.opener.document.forms['{$PICKER_FORM}'].{$PICKER_FIELD}_view.src='/pictures/{$ITEM.id}_1';window.close();"><img src="{$XT_IMAGES}icons/check.png" title="{"Pick this image"|translate}" alt="{"Pick this image"|translate}"></a>{/if}</td>
 </tr>
 {/foreach}
 {else}
 <tr class="{cycle values="row_a,row_b" name="picbrowser"}">
  <td class="row" colspan="3">{"Keine Medien vorhanden"|translate}</td>
 </tr>
 {/if}
 </table>
<br>
{include file="includes/navigator.tpl" form=""}