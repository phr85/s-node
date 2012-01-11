<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td colspan="3" class="toolbar" style="padding: 5px; height: 1px;">
  {subplugin package="ch.iframe.snode.filemanager" module="upload"}
  </td>
 </tr>
</table>

<form method="POST">
<input type="hidden" name="x{$BASEID}_action" />
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td width="200" style="padding: 5px;" valign="top">
   <table cellspacing="0" cellpadding="0" width="100%" style="background-color: #FFFFFF; border: 1px solid #7F9DB9;">
    <tr>
     <td valign="top">

      <table cellspacing="0" cellpadding="0" width="100%">
      {foreach from=$NODES item=NODE}
      <tr>
       <td>
        <table cellspacing="0" cellpadding="0" width="100%">
         <tr>
          <td class="row" style="padding-left: {$NODE.level*20-32}px; width: 1px;">{if $NODE.subs > 0}{if $NODE.itw}<img src="{$XT_IMAGES}icons/minus.gif" alt="" />{else}<img src="{$XT_IMAGES}icons/plus.gif" alt="" />{/if}{else}<img src="{$XT_IMAGES}spacer.gif" width="9" />{/if}</td>
          <td class="row" style="padding: 5px; padding-left: 0px; padding-right: 0px;width: 16px">
           <a href="javascript:document.forms[1].x{$BASEID}_open.value={$NODE.id};document.forms[1].submit();">{if $NODE.itw}{if $NODE.subs > 0}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />{else}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />{/if}{else}{if $NODE.subs > 0}<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="" />{else}<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="" />{/if}{/if}</a><br />
          </td>
          <td class="row">
          <a href="javascript:window.opener.document.forms['{$PICKER_FORM}'].{$PICKER_FIELD}.value={$NODE.id};window.opener.document.forms['{$PICKER_FORM}'].{$ACTION_FIELD}.value='importImageFolder';window.close();window.opener.document.forms['{$PICKER_FORM}'].submit();"><img src="{$XT_IMAGES}icons/check.png" title="{"Use this folder"|translate}" alt="{"Use this folder"|translate}" /></a>
          <a href="javascript:document.forms[1].x{$BASEID}_open.value={$NODE.id};document.forms[1].submit();">{if $NODE.itw}<span style="color: black;">{if $NODE.selected}<b>{$NODE.title}</b>{else}{$NODE.title}{/if}</span>{else}{$NODE.title}{/if}&nbsp;</a></td>
         </tr>
        </table>
       </td>
      </tr>
      {/foreach}
      </table>
     <img src="{$XT_IMAGES}spacer.gif" width="200" height="10" />
     </td>
    </tr>
   </table>
  </td>
  <td width="390" style="padding: 5px; padding-left: 0px;" valign="top">
   <table cellspacing="0" cellpadding="0" width="100%" style="height: 100%; background-color: #FFFFFF;">
    <tr>
     <td valign="top" valign="top">

      {foreach from=$FILES item=FILE name=F}
      <table cellspacing="0" cellpadding="0" align="left" style="border: 1px solid #DDDDDD;{if $SELECTED.id == $FILE.id}border-color: orange;{/if}{if $smarty.foreach.F.iteration%4!=1}margin-left: 5px;{/if}">
       <tr>
        <td onClick="document.forms[1].x{$BASEID}_file_id.value='{$FILE.id}';document.forms[1].submit();" style="cursor: hand; cursor: pointer; padding: 2px; background-image: url({$XT_IMAGES}icons/filetypes/image_big.png);" width="80" height="80" align="center" valign="bottom">{
        if $FILE.type == 1}<img src="{$XT_WEB_ROOT}download.php?file_id={$FILE.id}&file_name={$FILE.title}&file_version=cube" alt="{$FILE.title}" title="{$FILE.title}" width="80" height="80" />{/if}{
        if $FILE.type == 2}<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="80" height="80">
       <param name="movie" value="{$XT_WEB_ROOT}download.php?file_id={$FILE.id}" />
       <param name="quality" value="high" />
       <embed src="{$XT_WEB_ROOT}download.php?file_id={$FILE.id}" quality="high" width="80" height="80" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed>
      </object>{/if
        }<span style="color: #999999;">{
        $FILE.title|truncate:14:"...":true
        }</span></td>
       </tr>
      </table>
      {if $smarty.foreach.F.iteration%4==0}<br /><img src="{$XT_IMAGES}spacer.gif" width="100%" height="5" /><br />{/if}
      {/foreach}
     </td>
    </tr>
   </table>
  </td>
 </tr>
</table>

<input type="hidden" name="x{$BASEID}_open" />
<input type="hidden" name="x{$BASEID}_file_id" />
</form>