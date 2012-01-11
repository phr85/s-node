<h2><span class="light">{"Banner"|translate}: </span> {$BANNER.title}</h2>
<form method="POST" name="edit">
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"Title"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_title" size="42" value="{$BANNER.title|htmlspecialchars}"></td>
 </tr>
 <tr>
  <td class="left">{"Description"|translate}</td>
  <td class="right">{toggle_editor id="description"}
  <textarea id="x{$BASEID}_description" name="x{$BASEID}_description" rows="6" cols="65">{$BANNER.description}</textarea></td>
 </tr>
 <tr>
  <td class="left">{"Banner width"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_bannerwidth" size="5" value="{$BANNER.bannerwidth}"></td>
 </tr>
 <tr>
  <td class="left">{"Banner height"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_bannerheight" size="5" value="{$BANNER.bannerheight}"></td>
 </tr>
 <tr>
  <td class="left">{"Type"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_type" onChange="document.forms[0].x{$BASEID}_action.value='saveBanner';document.forms[0].submit();">
    <option value="1" {if $BANNER.type == "1"}selected{/if}>{"Local (default)"|translate}</option>
    <option value="2" {if $BANNER.type == "2"}selected{/if}>{"Custom code"|translate}</option>
   </select>
  </td>
 </tr>
 {if $BANNER.type == 1}
 <tr>
  <td class="left">{"Image"|translate}<a name="image" /></td>
  <td class="right">
  <a href="#image" onclick="popup('{$smarty.server.PHP_SELF}?TPL={$IMAGE_PICKER_TPL}&x{$IMAGE_PICKER_BASE_ID}_field=x{$BASEID}_image&x{$IMAGE_PICKER_BASE_ID}_form=0',770,470,'picker');">
   <img src="{$XT_IMAGES}icons/pick_photo.png" title="{"Pick an image"|translate}" alt="{"Pick an image"|translate}" /></a>{
   actionIcon
       action="deleteImage"
       icon="delete.png"
       form="0"
       title="Delete Image"
       ask="Are you sure that you want to delete this image relation"
       banner_id=$banner.id
   }<br />
   {if $BANNER.image < 1}
   <img name="x{$BASEID}_image_view" src="{$XT_IMAGES}spacer.gif" alt="" />
   {else}
   {if $BANNER.image_type == 2}
   <div style="border: 1px solid black; margin-top: 5px; width: 200px;">
   <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="200" height="{math equation=200/(width/height) width=$BANNER.width height=$BANNER.height}">
   <param name="movie" value="{$XT_WEB_ROOT}download.php?file_id={$BANNER.image}" />
   <param name="quality" value="high" />
   <embed src="{$XT_WEB_ROOT}download.php?file_id={$BANNER.image}" quality="high" width="200" height="{math equation=200/(width/height) width=$BANNER.width height=$BANNER.height}" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed>
   </object>
   </div>
   <img name="x{$BASEID}_image_view" src="{$XT_IMAGES}spacer.gif" alt="" />
   {else}
   <img name="x{$BASEID}_image_view" src="{$XT_WEB_ROOT}download.php?file_id={$BANNER.image}&file_version=1" alt="" class="picked" />
   {/if}
   {/if}
  </td>
 </tr>
 {/if}
 {if $BANNER.type == 2}
 <tr>
  <td class="left">{"Banner code"|translate}</td>
  <td class="right"><textarea name="x{$BASEID}_code" rows="8" cols="70">{$BANNER.code}</textarea></td>
 </tr>
 {/if}
 <tr>
  <td class="left">{"Link type"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_link_type" onChange="document.forms[0].x{$BASEID}_action.value='saveBanner';document.forms[0].submit();">
    <option value="0" {if $BANNER.link_type == "0"}selected{/if}>{"External (default)"|translate}</option>
    <option value="1" {if $BANNER.link_type == "1"}selected{/if}>{"Internal"|translate}</option>
   </select>
  </td>
 </tr>
 {if $BANNER.link_type == 0}
 <tr>
  <td class="left">{"Link"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_link" size="42" value="{$BANNER.link}"></td>
 </tr>
 {/if}
 {if $BANNER.link_type == 1}
 <tr>
  <td class="left">{"Link"|translate}<a name="link" /></td>
  <td class="right">
  <a href="#link" onclick="popup('{$smarty.server.PHP_SELF}?TPL=131&field=x{$BASEID}_link&form=edit',960,500);">
<img src="images/icons/breakpoint_add.png" {"Please select a page"|alttag}></a>
<input type="hidden" name="x{$BASEID}_link_title" size="60" disabled value="{$PAGES[$BANNER.link][title]}" />

   <select name="x{$BASEID}_link" value="{$BANNER.link}">
   {foreach from=$PAGES item=PAGE}
    <option value="{$PAGE.node_id}" {if $BANNER.link == $PAGE.node_id}selected{/if}>{$PAGE.title} ({$PAGE.node_id})</option>
   {/foreach}
   </select>
  </td>
 </tr>
 {/if}
 <tr>
  <td class="left">{"Target"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_target">
    <option value="_self" {if $BANNER.target == "_self"}selected{/if}>{"Same window"|translate} (_self)</option>
    <option value="_blank" {if $BANNER.target == "_blank"}selected{/if}>{"New window"|translate} (_blank)</option>
    <option value="_parent" {if $BANNER.target == "_parent"}selected{/if}>{"Parent window"|translate} (_parent)</option>
    <option value="_top" {if $BANNER.target == "_top"}selected{/if}>{"Top window"|translate} (_top)</option>
   </select>
  </td>
 </tr>

 {if $DISPLAY.relations}
 {include file="includes/widgets/relations.tpl" cid=$BANNER.id ctitle=$BANNER.title}
 {/if}

</table>
{include file="ch.iframe.snode.banner/admin/time.tpl"}
<h2>{"Zones"|translate}</h2>
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"Zones"|translate}</td>
  <td class="right">
   <table cellspacing="0" cellpadding="0" width="100%">
   {foreach from=$ZONES item=ZONE}
   <tr>
    <td width="25"><input type="checkbox" name="x{$BASEID}_zones[{$ZONE.id}]" value="1" {if $ZONE.zone_id == $ZONE.id || $ZONE.id == $ACTIVE_ZONE}checked{/if}></td>
    <td {if $ZONE.zone_id == $ZONE.id}style="font-weight: bold;"{/if}>{$ZONE.title}</td>
   </tr>
   {/foreach}
   </table>
  </td>
 </tr>
</table>
{include file="includes/editor.tpl"}
<input type="hidden" name="x{$BASEID}_zone_id" />
<input type="hidden" name="x{$BASEID}_banner_id" value="{$BANNER.id}" />
<input type="hidden" name="x{$BASEID}_image" value="{$BANNER.image}" />
<input type="hidden" name="x{$BASEID}_image_version" value="{$BANNER.image_version}" />
</form>
