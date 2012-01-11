<form method="post" name="productpage" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
<div class="toolbar">
{actionIcon icon="save.png" action="saveProductpage" form="productpage" label="save"}
</div>
<h2>{"productpage"|translate}</h2>

<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"Title"|translate}</td>
  <td class="right">
  	<input type="text" name="x{$BASEID}_productpage[site_title]" value="{$MICROSHOP.data.site_title}" size="42" style="font-weight: bold;" />
  	<input type="checkbox" name="x{$BASEID}_productpage[hide_title]" {if $MICROSHOP.data.hide_title==1} checked="checked" {/if} />{"hide title"|translate}
  </td>
 </tr>
 <tr>
  <td class="left">{"Text"|translate}</td>
  <td class="right">{toggle_editor id="text"}
  <textarea id="x{$BASEID}_text" name="x{$BASEID}_productpage[text]" rows="6" cols="65">{$MICROSHOP.data.text}</textarea></td>
 </tr>
 
 <tr>
  <td class="left">{"Image"|translate}<a name="image" /></td>
  <td class="right">{actionPopUp
    icon="pick_photo.png"
    title="Pick an image"|translate
    TPL=$IMAGE_PICKER_TPL
    BASEID=$IMAGE_PICKER_BASE_ID
    fieldBaseId=$BASEID
    fieldName="image"
    form="productpage"
    name="picker"  
}{
   actionIcon
       action="deleteImageFromproductpage"
       icon="delete.png"
       form="productpage"
       yoffset=1
       title="Delete Image"
       ask="Are you sure that you want to delete this image relation"
       page_id=$MICROSHOP.data.id
   }<br />
   {if $MICROSHOP.data.image < 1}
   <img name="x{$BASEID}_image_view" src="{$XT_IMAGES}spacer.gif" alt="" />
   {else}
   {if $MICROSHOP.data.image_type == 2}
   <div style="border: 1px solid black; margin-top: 5px; width: 200px;">
   <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="200" height="{math equation=200/(width/height) width=$MICROSHOP.data.width height=$MICROSHOP.data.height}">
   <param name="movie" value="{$XT_WEB_ROOT}download.php?file_id={$MICROSHOP.data.image}" />
   <param name="quality" value="high" />
   <embed src="{$XT_WEB_ROOT}download.php?file_id={$MICROSHOP.data.image}" quality="high" width="200" height="{math equation=200/(width/height) width=$MICROSHOP.data.width height=$MICROSHOP.data.height}" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed>
   </object>
   </div>
   <img name="x{$BASEID}_image_view" src="{$XT_IMAGES}spacer.gif" alt="" />
   {else}
   <img name="x{$BASEID}_image_view" src="{$XT_WEB_ROOT}download.php?file_id={$MICROSHOP.data.image}&amp;file_version=1" alt="" class="picked" />
   {/if}
   {/if}
  </td>
 </tr> 

 <tr>
  <td class="left">{"Layout"|translate}</td>
  <td class="right">
   <select name="tplselect" onchange="document.getElementById('layout').value=this.value;">
   <option value="">{"Please select"|translate}</option>
   {foreach from=$MICROSHOP.metadata.styles key="avTPL" item="avTPLTheme"}
    <option value="{$avTPL}"{if $avTPL==$MICROSHOP.data.style} selected="selected"{/if}>{$avTPL}  ({$avTPLTheme})</option>
   {/foreach}
   </select>
   <br />
   <input id="layout" name="x{$BASEID}_productpage[style]" size="42" value="{$MICROSHOP.data.style}" />
  </td>
 </tr>

 </table>

{include file="ch.iframe.snode.microshop/admin/edit_product.tpl"}
 

{include file="includes/editor.tpl"} 

<input type="hidden" name="x{$BASEID}_productpage[id]" value="{$MICROSHOP.data.id}" />
<input type="hidden" name="x{$BASEID}_image" value="{$MICROSHOP.data.image}" />
<input type="hidden" name="x{$BASEID}_product_id" value="" />
<input type="hidden" name="x{$BASEID}_image_version" value="{$MICROSHOP.data.image}" />

{include file="ch.iframe.snode.microshop/admin/hidden_values.tpl"}
</form>