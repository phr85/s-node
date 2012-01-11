<form method="POST" name="browser">
<table cellspacing="0" cellpadding="0" width="100%">
 {foreach from=$FOLDERS item=FOLDER}
 <tr class="{cycle values=row_a,row_b}">
  <td class="button" style="width: 16px;"><a href="javascript:document.forms[0].x{$BASEID}_open.value={$FOLDER.id};document.forms[0].submit();window.parent.frames['master'].document.forms['navigation'].x{$BASEID}_open.value={$FOLDER.id};window.parent.frames['master'].document.forms['navigation'].submit();"><img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="" /></a></td>
  <td class="row" colspan="3"><a href="javascript:document.forms[0].x{$BASEID}_open.value={$FOLDER.id};document.forms[0].submit();window.parent.frames['master'].document.forms['navigation'].x{$BASEID}_open.value={$FOLDER.id};window.parent.frames['master'].document.forms['navigation'].submit();">{$FOLDER.title}</a>&nbsp;</td>
 </tr>
 {/foreach}
 {foreach from=$FILES item=FILE}
 <tr class="{cycle values=row_a,row_b}">
  <td class="button" style="width: 16px;">{$FILE.filename|icon}</td>
  <td class="row">  <a href="javascript:
{if $MODE != "full"}
window.parent.opener.document.forms['{$FORM}'].{$FIELD}.value={$FILE.id};
{else}
window.parent.opener.document.forms['{$FORM}'].{$FIELD}.value='{"download_path"|getConfigValue}download.php?file_id={$FILE.id}&download=true';
{/if}

{if $TITLEFIELD == ""}

window.parent.opener.document.forms['{$FORM}'].{$FIELD}_title.value='{$FILE.filename}';
{else}
window.parent.opener.document.forms['{$FORM}'].{$TITLEFIELD}.value='{$FILE.filename}';
{/if}
window.parent.close();">
  {$FILE.filename}<br />
  {if $FILE.type == 2}
  <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="80" height="80">
   <param name="movie" value="{$XT_WEB_ROOT}download.php?file_id={$FILE.id}" />
   <param name="quality" value="high" />
   <embed src="{$XT_WEB_ROOT}download.php?file_id={$FILE.id}&amp;date={$FILE.upload_date}" quality="high" width="80" height="80" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed>
  </object>
  {/if}
  {if $FILE.type == 1}{image
      id=$FILE.id
      version=0
      title=$FILE.filename
      alt=$FILE.title
      style="margin-top: 5px; border: 1px solid black;"
  }{/if}</a><br />{$FILE.description}</td>
  <td class="row" width="150">{$FILE.upload_date|date_format:"%d.%m.%Y %H:%I:%S"} <br />{$FILE.filesize|format_filesize}</td>
  <td class="button" align="right"><a href="javascript:
{if $MODE != "full"}
window.parent.opener.document.forms['{$FORM}'].{$FIELD}.value={$FILE.id};
{else}
window.parent.opener.document.forms['{$FORM}'].{$FIELD}.value='{"download_path"|getConfigValue}download.php?file_id={$FILE.id}&download=true';
{/if}

{if $TITLEFIELD == ""}

window.parent.opener.document.forms['{$FORM}'].{$FIELD}_title.value='{$FILE.filename}';
{else}
window.parent.opener.document.forms['{$FORM}'].{$TITLEFIELD}.value='{$FILE.filename}';
{/if}
window.parent.close();"><img src="images/icons/check.png" {"select this article"|alttag}></a>
  </td>
 </tr>
 {/foreach}
</table>
<input type="hidden" name="x{$BASEID}_open" />
<input type="hidden" name="x{$BASEID}_file_id" />
<input type="hidden" name="x{$BASEID}_action" />
<input type="hidden" name="x{$BASEID}_node_id" value="{$OPEN}" />
<input type="hidden" name="x{$BASEID}_node_pid" />
<input type="hidden" name="x{$BASEID}_file_name" />
</form>