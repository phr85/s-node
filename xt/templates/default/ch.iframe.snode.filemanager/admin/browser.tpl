<form method="post" name="browser" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
{node_perm perm="addFiles" node_id=$OPEN node_pid=$OPEN_PID assign="ADDPERM"}
{if $ADDPERM}
{include file="includes/buttons.tpl" data=$BROWSER_BUTTONS}
{else}
<input type="hidden" name="x{$BASEID}_action" />
{/if}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
   <td class="table_header" style="width: 16px;">&nbsp;</td>
   <td class="table_header" onclick="document.forms['browser'].x{$BASEID}_order_by.value='det.title';document.forms['browser'].x{$BASEID}_order_by_dir.value='{if $ORDER_BY_DIR == 'ASC' && $ORDER_BY == 'det.title'}DESC{else}ASC{/if}';document.forms['browser'].submit();">{"Title"|translate} {if $ORDER_BY == 'det.title'}<img src="{$XT_IMAGES}admin/header_arrow_{if $ORDER_BY_DIR == 'DESC'}down{else}up{/if}.gif" alt=""/>{/if}</td>
   <td class="table_header" onclick="document.forms['browser'].x{$BASEID}_order_by.value='b.filesize';document.forms['browser'].x{$BASEID}_order_by_dir.value='{if $ORDER_BY_DIR == 'ASC' && $ORDER_BY == 'b.filesize'}DESC{else}ASC{/if}';document.forms['browser'].submit();">{"Size"|translate} {if $ORDER_BY == 'b.filesize'}<img src="{$XT_IMAGES}admin/header_arrow_{if $ORDER_BY_DIR == 'DESC'}down{else}up{/if}.gif" alt=""/>{/if}</td>
   <td class="table_header" onclick="document.forms['browser'].x{$BASEID}_order_by.value='b.upload_date';document.forms['browser'].x{$BASEID}_order_by_dir.value='{if $ORDER_BY_DIR == 'ASC' && $ORDER_BY == 'b.upload_date'}DESC{else}ASC{/if}';document.forms['browser'].submit();">{"Date"|translate} {if $ORDER_BY == 'b.upload_date'}<img src="{$XT_IMAGES}admin/header_arrow_{if $ORDER_BY_DIR == 'DESC'}down{else}up{/if}.gif" alt=""/>{/if}</td>
   <td class="table_header" >&nbsp;</td>
  </tr>
 {if $OPEN_PID > 0}
 <tr class="{cycle values=row_a,row_b}">
  <td class="button" style="width: 16px;"><a href="javascript:document.forms[0].x{$BASEID}_open.value={$OPEN_PID};document.forms[0].submit();window.parent.frames['master'].document.forms['o'].x{$BASEID}_open.value={$OPEN_PID};window.parent.frames['master'].document.forms['o'].submit();"><img src="{$XT_IMAGES}icons/explorer/folder_up.png" alt="" /></a></td>
  <td class="row" colspan="4"><a href="javascript:document.forms[0].x{$BASEID}_open.value={$OPEN_PID};document.forms[0].submit();window.parent.frames['master'].document.forms['o'].x{$BASEID}_open.value={$OPEN_PID};window.parent.frames['master'].document.forms['o'].submit();">../</a>&nbsp;</td>
 </tr>
 {/if}
 {foreach from=$FOLDERS item=FOLDER}
 <tr class="{cycle values=row_a,row_b}">
  <td class="button" style="width: 16px;"><a href="javascript:document.forms[0].x{$BASEID}_pid.value={$FOLDER.pid};document.forms[0].x{$BASEID}_open.value={$FOLDER.id};document.forms[0].submit();window.parent.frames['master'].document.forms['o'].x{$BASEID}_open.value={$FOLDER.id};window.parent.frames['master'].document.forms['o'].submit();"><img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="" /></a></td>
  <td class="row" colspan="4"><a href="javascript:document.forms[0].x{$BASEID}_pid.value={$FOLDER.pid};document.forms[0].x{$BASEID}_open.value={$FOLDER.id};document.forms[0].submit();window.parent.frames['master'].document.forms['o'].x{$BASEID}_open.value={$FOLDER.id};window.parent.frames['master'].document.forms['o'].submit();">{$FOLDER.title}</a>&nbsp;</td>
 </tr>
 {/foreach}
 {foreach from=$FILES item=FILE}
 <tr class="{cycle values=row_a,row_b}">
  <td class="button" style="width: 16px;">{$FILE.filename|icon}</td>
  <td class="row"><a href="javascript:window.parent.frames['slave1'].document.forms[0].x{$BASEID}_action.value='editFile';window.parent.frames['slave1'].document.forms[0].x{$BASEID}_file_id.value={$FILE.id};window.parent.frames['slave1'].document.forms[0].submit();">{$FILE.title|default:$FILE.filename}<br />
  {if $FILE.type == 1}{image
      id=$FILE.id
      version=0
      title=$FILE.title
      alt=$FILE.title
      style="margin-top: 5px; border: 1px solid black;"
  }{/if}
  <!-- {if $FILE.type == 2}
  <object style="margin-top: 5px;" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" height="80">
   <param name="movie" value="{$XT_WEB_ROOT}download.php?file_id={$FILE.id}&amp;date={$FILE.upload_date}" />
   <param name="quality" value="high" />
   <embed src="{$XT_WEB_ROOT}download.php?file_id={$FILE.id}&amp;date={$FILE.upload_date}" quality="high" height="80" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed>
  </object>
  {/if} --></a></td>
  <td class="row" width="60">
  {$FILE.filesize|format_filesize}
  </td>
  <td class="row" width="60">
  {$FILE.upload_date|date_format:"%d.%m.%Y"}
  </td>
  <td class="button" align="right" width="60">
 {actionIcon
        action="editFile"
        icon="pencil.png"
        form="0"
        file_id=$FILE.id
        node_perm="editFiles"
        node_id=$OPEN
		node_pid=$OPEN_PID
        title="Edit this file"
        target="slave1"
  }<a href="{$XT_WEB_ROOT}download.php?file_id={$FILE.id}&amp;date={$FILE.upload_date}"><img src="{$XT_IMAGES}icons/download.png" alt="" class="icon" /></a>{
  actionIcon
        action="deleteFile"
        icon="delete.png"
        form="browser"
        file_id=$FILE.id
        node_perm="deleteFiles"
        node_id=$OPEN
		node_pid=$OPEN_PID
        title="Delete this file"
        ask="Are you sure you want to delete this file?"
  }{if $CTRL == false}
  <br /> {actionIcon
                action="cutFile"
                icon="cut.png"
                form="o"
                target="master"
                file_id=$FILE.id
                node_id=$OPEN
                node_perm="deleteFiles"
        		node_id=$OPEN
    			node_pid=$OPEN_PID
                title="Cut this file"
   }{/if}
  </td>
 </tr>
 {/foreach}
</table>
<input type="hidden" name="x{$BASEID}_open" />
<input type="hidden" name="x{$BASEID}_file_id" />
<input type="hidden" name="x{$BASEID}_pid" value="{$OPEN_PID}" />
<input type="hidden" name="x{$BASEID}_node_id" value="{$OPEN}" />
<input type="hidden" name="x{$BASEID}_node_pid" />
<input type="hidden" name="x{$BASEID}_file_name" />
<input type="hidden" name="x{$BASEID}_order_by" value="{$ORDER_BY}" />
<input type="hidden" name="x{$BASEID}_order_by_dir" value="{$ORDER_BY_DIR}"/>
<input type="hidden" name="x{$BASEID}_module" value="{$ADMINMODULE}" />
</form>