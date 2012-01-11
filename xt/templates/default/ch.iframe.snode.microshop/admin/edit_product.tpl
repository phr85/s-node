<div class="toolbar">
{actionIcon
       action="addSingleProduct"
       icon="add.png"
       label="add product"
       form="productpage"
       yoffset=1
       title="add product"
       
   }
</div>
{foreach from=$MICROSHOP.products key="FIELD" item="ROW"}
 <h2><span class="light">{"Product"|translate}:</span> {$ROW.title}</h2>
 <table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"Controls"|translate}<a id="product_{$ROW.id}" name="product_{$ROW.position}">&nbsp;</a></td>
  <td class="right"> {if $ROW.active
  }{actionIcon
       action="deactivateProduct"
       perm="edit"
       icon="active.png"
       form="productpage"
       yoffset=1
       title="Deactivate the product"
       product_id=$ROW.id
   }{else}{actionIcon
       action="activateProduct"
       icon="inactive.png"
       perm="edit"
       form="productpage"
       yoffset=1
       title="Activate the product"
       product_id=$ROW.id
   }{/if}
   
   {actionIcon
       action="deleteProduct"
       icon="delete.png"
       perm="edit"
       form="productpage"
       yoffset=1
       title="Delete"
       ask="Are you sure to delete this entry?"
       product_id=$ROW.id
   }
  
   </td>
 </tr>
 
 <tr>
  <td class="left">{"Title"|translate}</td>
  <td class="right"><b><input type="text" name="x{$BASEID}_title{$FIELD}" value="{$ROW.title}" size="40" /></b><a name="x{$FIELD}">&nbsp;</a></td>
 </tr>
  
 
 <tr>
  <td class="left">{"Text"|translate}</td>
  <td class="right">{if $ROW.layout != "bbcode.tpl"}{toggle_editor id="maintext" suffix=$FIELD}{else}{"HTML editor is not available for this template"|translate}<br/>{/if}
   <textarea id="x{$BASEID}_maintext{$FIELD}" name="x{$BASEID}_text{$FIELD}" rows="4" cols="65">{$ROW.text}</textarea>
  </td>
 </tr>
<tr>
  <td class="left">{"price"|translate}</td>
  <td class="right"> 
  <input type="text" name="x{$BASEID}_price{$FIELD}" value="{$ROW.price}" size="40" />
  </td>
 </tr>
<tr>
  <td class="left">{"give_gift_by"|translate}</td>
  <td class="right"> 
 <input type="text" name="x{$BASEID}_give_gift_by{$FIELD}" value="{$ROW.give_gift_by}" size="40" />
  </td>
 </tr>
<tr>
  <td class="left">{"receive_items"|translate}</td>
  <td class="right">
 <input type="text" name="x{$BASEID}_receive_items{$FIELD}" value="{$ROW.receive_items}" size="40" />
  </td>
 </tr>

 <tr>
  <td class="left">{"Image"|translate}<a name="image{$FIELD}" /></td>
  <td class="right">{actionPopUp
    icon="pick_photo.png"
    title="Pick an image"|translate
    TPL=$IMAGE_PICKER_TPL
    BASEID=$IMAGE_PICKER_BASE_ID
    fieldBaseId=$BASEID
    fieldName="image"|cat:$FIELD
    form="productpage"
    name="picker"
    anker="image"|cat:$FIELD
}{
   actionIcon
       action="deleteProductImage"
       icon="delete.png"
       form="productpage"
       title="Delete Image"
       yoffset=1
       ask="Are you sure that you want to delete this image relation"
       product_id=$ROW.id
   }<br />
   {if $ROW.image < 1}
   <img name="x{$BASEID}_image{$FIELD}_view" src="{$XT_IMAGES}spacer.gif" alt="" />
   {else}
   {if $ROW.image_type == 2}
   <div style="border: 1px solid black; margin-top: 5px; width: 200px;">
   <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="200" height="{math equation=200/(width/height) width=$ROW.width height=$ROW.height}">
   <param name="movie" value="{$XT_WEB_ROOT}download.php?file_id={$ROW.image}" />
   <param name="quality" value="high" />
   <embed src="{$XT_WEB_ROOT}download.php?file_id={$ROW.image}" quality="high" width="200" height="{math equation=200/(width/height) width=$ROW.width height=$ROW.height}" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed>
   </object>
   </div>
   <img name="x{$BASEID}_image{$FIELD}_view" src="{$XT_IMAGES}spacer.gif" alt="" />
   {else}
   <img name="x{$BASEID}_image{$FIELD}_view" src="{$XT_WEB_ROOT}download.php?file_id={$ROW.image}&amp;file_version=1" alt="" class="picked" />
   {/if}
   {/if}
   <input type="hidden" name="x{$BASEID}_image{$FIELD}" value="{$ROW.image}" />
   <input type="hidden" name="x{$BASEID}_image{$FIELD}_version" value="{$ROW.image_version}" />
   <input type="hidden" name="x{$BASEID}_item_id{$FIELD}" value="{$ROW.id}" />
  </td>
 </tr>

 </table>
 
 {/foreach}
 
 <input type="hidden" name="x{$BASEID}_maxlevel" value="{$FIELD}" />