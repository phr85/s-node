{literal}
<script language="JavaScript" type="text/javascript"><!--
window.parent.frames['master'].document.forms[1].submit();
window.parent.frames['slave2'].document.forms[0].submit();
//-->
</script>
{/literal}
<form method="POST" name="edit" enctype="multipart/form-data" onSubmit="window.document.forms['editArticle'].x{$BASEID}_yoffset.value= window.pageYOffset;">
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header">
   <span class="title">{$FILE.title}</span>
   <span class="subline"><br />{"Uploaded"|translate}: {$FILE.upload_date|date_format:"%d.%m.%Y %H:%I:%S"} - {"Uploaded by"|translate}: {$FILE.username}</span>
  </td>
  <td class="view_header" align="right"><a href="download.php?file_id={$FILE.id}"><img src="{$XT_IMAGES}icons/download.png" alt="" class="icon" /></a></td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$EDIT_BUTTONS}
{include file="includes/lang_selector_simple.tpl" form="edit"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"Title"|translate}:</td>
  <td class="right" colspan="2"><input type="text" name="x{$BASEID}_title" size="42" value="{$FILE.title|htmlspecialchars}"></td>
 </tr>
 {if $FILE.type == 3 || $FILE.type == 2 || $FILE.type == 1}
 <tr>
  <td class="view_header">
   <span class="title">{"Preview"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 {/if}
 {if $FILE.type == 3}
 <tr>
  <td class="view_header" colspan="4">
   <span><img src="tmp.png?{$TIME}" alt="" /></span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 {/if}
 {if $FILE.type == 2}
 <tr>
  <td class="view_header" colspan="4">
   <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="100%">
   <param name="movie" value="{$XT_WEB_ROOT}download.php?file_id={$FILE.id}&amp;date={$FILE.upload_date}" />
   <param name="quality" value="high" />
   <embed src="{$XT_WEB_ROOT}download.php?file_id={$FILE.id}&amp;date={$FILE.upload_date}" quality="high" width="100%" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed>
   </object>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 {/if}
 {if $FILE.type == 1}
 <tr>
  <td class="view_header" colspan="4" style="padding-bottom: 0px;">
   <img src="{$XT_WEB_ROOT}download.php?file_id={$FILE.id}&amp;file_version=1&amp;date={$FILE.upload_date}" alt="" style="border: 1px solid black;" />
  </td>
 </tr>
 {/if}
 <tr>
  <td class="view_header">
   <span class="title">{"Details"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$EDIT_BUTTONS withouthidden=1}
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="left">{"Filename"|translate}:</td>
  <td class="right" colspan="2"><input type="text" name="x{$BASEID}_filename" size="42" value="{$FILE.filename}"></td>
 </tr>
 <tr>
  <td class="left">{"Description"|translate}:</td>
  <td class="right" colspan="2">{toggle_editor id="description"}
  <textarea id="x{$BASEID}_description" name="x{$BASEID}_description" cols="50" rows="4">{$FILE.description}</textarea></td>
 </tr>
 <tr>
  <td class="left">{"Keywords"|translate}:</td>
  <td class="right" colspan="2"><textarea name="x{$BASEID}_keywords" cols="50" rows="4">{$FILE.keywords}</textarea></td>
 </tr>
 <tr>
  <td class="left">{"available for search"|translate}</td>
  <td class="right"><input type="checkbox" name="x{$BASEID}_public" value="1" {if $FILE.public == 1}checked{/if}></td>
 </tr>


 <tr>
  <td class="left">{"image Date"|translate} (d.m.y)</td>
  <td class="right"><input type="text" name="x{$BASEID}_manual_date_str" id="x{$BASEID}_manual_date_str" value="{$FILE.manual_date|date_format:"%d.%m.%Y"}" size="12" />
    {include file="includes/widgets/datepicker.tpl" relative="manual_date_str"}
  <input type="hidden" name="x{$BASEID}_manual_date" value="{$FILE.manual_date}" />
  </td>
 </tr>

 <tr>
  <td class="left">{"Valid to Date"|translate} (d.m.y)</td>
  <td class="right">
  <input type="checkbox" id="validdate" name="x{$BASEID}_validity" value="enabled" {if $FILE.valid_date > 0}checked="checked" {/if} onclick="toggleDivByCheckbox('#validdate','#validdatebox');" /> Datei hat ein Ablaufdatum
  <div id="validdatebox" {if $FILE.valid_date == 0} style="display:none" {/if}>
  <input type="text" name="x{$BASEID}_valid_date_str" id="x{$BASEID}_valid_date_str" value="{if $FILE.valid_date > 0}{$FILE.valid_date|date_format:"%d.%m.%Y"}{/if}" size="12" />
    {include file="includes/widgets/datepicker.tpl" relative="valid_date_str"}
  <input type="hidden" name="x{$BASEID}_valid_date" value="{$FILE.valid_date}" /></div>
  </td>
 </tr>
<tr>
  <td class="left">{"Valid_from Date"|translate} (d.m.y)</td>
  <td class="right">
  <input type="checkbox" id="validfrom" name="x{$BASEID}_validity_from" value="enabled" {if $FILE.valid_from > 0}checked="checked" {/if} onclick="toggleDivByCheckbox('#validfrom','#validfrombox');" /> Datei hat ein "gültig ab" Datum
  <div id="validfrombox" {if $FILE.valid_from == 0} style="display:none" {/if}>
 <input type="text" name="x{$BASEID}_valid_from_str" id="x{$BASEID}_valid_from_str" value="{if $FILE.valid_from > 0}{$FILE.valid_from|date_format:"%d.%m.%Y"}{/if}" size="12" />
    {include file="includes/widgets/datepicker.tpl" relative="valid_from_str"}
  H:   <select name="x{$BASEID}_validity_from_hrs">
    <option value="0" {if $FILE.valid_from_hrs == 0}selected="selected"{/if}>0</option>
    <option value="1" {if $FILE.valid_from_hrs == 1}selected="selected"{/if}>1</option>
    <option value="2" {if $FILE.valid_from_hrs == 2}selected="selected"{/if}>2</option>
    <option value="3" {if $FILE.valid_from_hrs == 3}selected="selected"{/if}>3</option>
    <option value="4" {if $FILE.valid_from_hrs == 4}selected="selected"{/if}>4</option>
    <option value="5" {if $FILE.valid_from_hrs == 5}selected="selected"{/if}>5</option>
    <option value="6" {if $FILE.valid_from_hrs == 6}selected="selected"{/if}>6</option>
    <option value="7" {if $FILE.valid_from_hrs == 7}selected="selected"{/if}>7</option>
    <option value="8" {if $FILE.valid_from_hrs == 8}selected="selected"{/if}>8</option>
    <option value="9" {if $FILE.valid_from_hrs == 9}selected="selected"{/if}>9</option>
    <option value="10" {if $FILE.valid_from_hrs == 10}selected="selected"{/if}>10</option>
    <option value="11" {if $FILE.valid_from_hrs == 11}selected="selected"{/if}>11</option>
    <option value="12" {if $FILE.valid_from_hrs == 12}selected="selected"{/if}>12</option>
    <option value="13" {if $FILE.valid_from_hrs == 13}selected="selected"{/if}>13</option>
    <option value="14" {if $FILE.valid_from_hrs == 14}selected="selected"{/if}>14</option>
    <option value="15" {if $FILE.valid_from_hrs == 15}selected="selected"{/if}>15</option>
    <option value="16" {if $FILE.valid_from_hrs == 16}selected="selected"{/if}>16</option>
    <option value="17" {if $FILE.valid_from_hrs == 17}selected="selected"{/if}>17</option>
    <option value="18" {if $FILE.valid_from_hrs == 18}selected="selected"{/if}>18</option>
    <option value="19" {if $FILE.valid_from_hrs == 19}selected="selected"{/if}>19</option>
    <option value="20" {if $FILE.valid_from_hrs == 20}selected="selected"{/if}>20</option>
    <option value="21" {if $FILE.valid_from_hrs == 21}selected="selected"{/if}>21</option>
    <option value="22" {if $FILE.valid_from_hrs == 22}selected="selected"{/if}>22</option>
    <option value="23" {if $FILE.valid_from_hrs == 23}selected="selected"{/if}>23</option>
    </select>
  M: <select name="x{$BASEID}_validity_from_min">
    <option value="0" {if $FILE.valid_from_min == "00"}selected="selected"{/if}>0</option>
    <option value="5" {if $FILE.valid_from_min == "05"}selected="selected"{/if}>5</option>
    <option value="10" {if $FILE.valid_from_min == "10"}selected="selected"{/if}>10</option>
    <option value="15" {if $FILE.valid_from_min == "15"}selected="selected"{/if}>15</option>
    <option value="20" {if $FILE.valid_from_min == "20"}selected="selected"{/if}>20</option>
    <option value="25" {if $FILE.valid_from_min == "25"}selected="selected"{/if}>25</option>
    <option value="30" {if $FILE.valid_from_min == "30"}selected="selected"{/if}>30</option>
    <option value="35" {if $FILE.valid_from_min == "35"}selected="selected"{/if}>35</option>
    <option value="40" {if $FILE.valid_from_min == "40"}selected="selected"{/if}>40</option>
    <option value="45" {if $FILE.valid_from_min == "45"}selected="selected"{/if}>45</option>
    <option value="50" {if $FILE.valid_from_min == "50"}selected="selected"{/if}>50</option>
    <option value="55" {if $FILE.valid_from_min == "55"}selected="selected"{/if}>55</option>
    </select>
    
  <input type="hidden" name="x{$BASEID}_valid_from" value="{$FILE.valid_from}" /></div>
  </td>
 </tr>

 <tr>
  <td class="left">{"File size"|translate}:</td>
  <td class="right" colspan="2">{$FILE.filesize|format_filesize}</td>
 </tr>
 <tr>
  <td class="left">{"MD5 sum"|translate}:</td>
  <td class="right" colspan="2">{$FILE.md5sum}</td>
 </tr>
 <tr>
  <td class="left">{"MIME Type"|translate}:</td>
  <td class="right" colspan="2">{$FILE.mime}&nbsp;</td>
 </tr>
 {if $DISPLAY.relations}
 {include file="includes/widgets/relations.tpl" cid=$FILE.id ctitle=$FILE.title}
 {/if}
{if $DISPLAY.properties}
  {include file="includes/widgets/properties.tpl" content_id=$FILE.id content_type=$BASEID formname="edit" universal=true}
{/if}
 <tr>
  <td class="view_header">
   <span class="title">{"Image"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$EDIT_BUTTONS withouthidden=1}
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
    <td class="left">{"Image"|translate}&nbsp;</td>
    <td class="right">
    <a href="#" onclick="popup('{$smarty.server.PHP_SELF}?TPL=597&x240_field=x{$BASEID}_image&x240_form=edit',770,470,'picker');"><img style="cursor: hand; cursor: pointer;" src="{$XT_IMAGES}icons/pick_photo.png" title="{"Pick an image"|translate}" alt="{"Pick an image"|translate}" /></a>{
    actionIcon
       action="deleteImage"
       icon="delete.png"
       form="edit"
       title="Delete Image"
       ask="Are you sure that you want to delete this image relation"
       file_id=$FILE.id
    }<br />
   {if $FILE.image <= 0}
   <img name="x{$BASEID}_image_view" src="{$XT_IMAGES}spacer.gif" alt="" />
   {else}
   {if $FILE.image_type == 2}
   <div style="border: 1px solid black; margin-top: 5px; width: 200px;">
   <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="200" height="{math equation=200/(width/height) width=$FILE.width height=$FILE.height}">
   <param name="movie" value="{$XT_WEB_ROOT}download.php?file_id={$FILE.image}" />
   <param name="quality" value="high" />
   <embed src="{$XT_WEB_ROOT}download.php?file_id={$FILE.image}" quality="high" width="200" height="{math equation=200/(width/height) width=$FILE.width height=$FILE.height}" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed>
   </object>
   </div>
   <img name="x{$BASEID}_image_view" src="{$XT_IMAGES}spacer.gif" alt="" />
   {else}
   <img name="x{$BASEID}_image_view" src="{$XT_WEB_ROOT}download.php?file_id={$FILE.image}&file_version=2" alt="" class="picked" />
   {/if}
   {/if}</td>
 </tr>

 <tr>
  <td class="view_header">
   <span class="title">{"Statistics"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$EDIT_BUTTONS withouthidden=1}
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="left">{"Enable statistics"|translate}</td>
  <td class="right">
   <input type="hidden" name="x{$BASEID}_downloads" value="{$FILE.downloads}" />
   <input type="checkbox" name="x{$BASEID}_count_downloads" value="1" {if $FILE.count_downloads == 1}checked{/if} onclick="document.forms[0].x{$BASEID}_yoffset.value=window.pageYOffset;document.forms[0].x{$BASEID}_action.value='saveFile';document.forms[0].submit();">
  </td>
 </tr>
 {if $FILE.count_downloads == 1}
 <tr>
  <td class="left">{"Downloads"|translate}</td>
  <td class="right">{$FILE.downloads}</td>
 </tr>
 {/if}
 <tr>
  <td class="view_header">
   <span class="title">{"Replace file"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$EDIT_BUTTONS withouthidden=1}
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="left">{"Replace file"|translate}</td>
  <td class="right"><input type="file" name="file" size="34"></td>
 </tr>
</table>

<input type="hidden" name="x{$BASEID}_node_id" />
<input type="hidden" name="x{$BASEID}_node_pid" />
<input type="hidden" name="x{$BASEID}_position" />
<input type="hidden" name="x{$BASEID}_before_content_id" />
<input type="hidden" name="x{$BASEID}_before_content_type" />
<input type="hidden" name="x{$BASEID}_file_id" value="{$FILE.id}" />
<input type="hidden" name="x{$BASEID}_file_name" />
<input type="hidden" name="x{$BASEID}_type" value="{$FILE.type}" />
<input type="hidden" name="x{$BASEID}_image" value="{$FILE.image}" />
<input type="hidden" name="x{$BASEID}_image_version" value="{$FILE.image_version}" />
<input type="hidden" name="module" value="e" />
{yoffset}
{include file="includes/editor.tpl"}
</form>