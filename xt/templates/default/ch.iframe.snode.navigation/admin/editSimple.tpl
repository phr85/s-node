<script language="JavaScript"><!--
window.parent.frames['master'].document.forms[1].module.value='o';
window.parent.frames['master'].document.forms[1].x{$BASEID}_open.value={$DATA.node_id};
window.parent.frames['master'].document.forms[1].x{$BASEID}_lang_filter.value='{$ACTIVE_LANG}';
window.parent.frames['master'].document.forms[1].x{$BASEID}_yoffset.value=window.parent.frames['master'].pageYOffset;
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>
<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_module=es" method="post" name="edit" onSubmit="window.document.forms['edit'].x{$BASEID}_yoffset.value= window.pageYOffset;">
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{$DATA.node_id}:</span> <span class="title">{$DATA.title}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$EDIT_BUTTONS}
{include file="includes/lang_selector_submit.tpl" form="edit"}
{if $LANGUAGE_TRANSFER}{include file="includes/buttons.tpl" data=$BUTTONS withouthidden="1"}{/if}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"Navigation"|translate}</td>
  <td class="right"><input type="text" size="42" name="x{$BASEID}_title" value="{$DATA.title|htmlspecialchars}" style="font-weight: bold;"></td>
 </tr>
</table>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
  <tr>
  <td class="view_header" colspan="3">
   <span class="title">{"What you want to display on this page?"|translate}</span>
  </td>
 </tr>
  <tr>
  <td class="view_separator" colspan="3"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 </table>
 {include file="includes/buttons.tpl" data=$CONTENTS_BUTTONS withouthidden="1"}
 <table width="100%" cellpadding="0" cellspacing="0">
 {foreach from=$PACKAGES item=PACKAGE name=A}
 <tr>
    <td class="left">{if $CTRL}{
    actionIcon
        action="insertContentSimple"
        entry_pos=$PACKAGE.position
        entry_mode="before"
        title="Insert content before this content"
        form="edit"
        icon="explorer/arrow_up_green.png"
    }{
    actionIcon
        action="insertContentSimple"
        entry_pos=$PACKAGE.position
        entry_mode="after"
        title="Insert content after this content"
        form="edit"
        icon="explorer/arrow_down_green.png"
    }{else}{if $PACKAGE.active == 0}{
  actionIcon
      action="activateContent"
      icon="inactive.png"
      form="edit"
      title="Activate this content"
      entry_id=$PACKAGE.id
  }{else}{
  actionIcon
      action="deactivateContent"
      icon="active.png"
      form="edit"
      title="Deactivate this content"
      entry_id=$PACKAGE.id
  }{/if}{
  actionIcon
      action="editContentSimple"
      icon="pencil.png"
      form="edit"
      title="Edit this content"
      entry_id=$PACKAGE.id
      entry_position=$PACKAGE.position
  }{
  actionIcon
      action="deleteContent"
      icon="delete.png"
      form="edit"
      title="Delete this content"
      ask="Do you really want to delete this entry?"
      entry_id=$PACKAGE.id
  }{if !$smarty.foreach.A.first}{
  actionIcon
      action="moveUpContent"
      icon="explorer/arrow_up_green.png"
      form="edit"
      title="Move this content up"
      entry_id=$PACKAGE.id
      entry_pos=$PACKAGE.position
  }{else}{$ICONSPACER}{/if}{if !$smarty.foreach.A.last}{
  actionIcon
      action="moveDownContent"
      icon="explorer/arrow_down_green.png"
      form="edit"
      title="Move this content down"
      entry_id=$PACKAGE.id
      entry_pos=$PACKAGE.position
  }{else}{$ICONSPACER}{/if}{/if}</td>
  <td class="right" style="color: black;">{if sizeof($PACKAGE.titles) > 0}{foreach from=$PACKAGE.titles item=TITLE}{$TITLE|truncate:33:"...":true}<br />{/foreach}{else}<span style="color: #999999;">{"Unknown"|translate}</span>&nbsp;{/if}</td>
  <td class="right" width="130" align="right">{$PACKAGE.title}&nbsp;</td>
 </tr>
 {/foreach}

</table>
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Redirect"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"Refer to external location"|translate}</td>
  <td class="right" onclick="showhideCheckbox('x{$BASEID}_refertoextlink','x{$BASEID}_ext_link');showhideCheckbox('x{$BASEID}_refertoextlink','x{$BASEID}_blank');"><input type="checkbox" name="x{$BASEID}_refertoextlink" value="1" {if $DATA.ext_link != ''}checked{/if}></td>
 </tr>
 <tr id="x{$BASEID}_ext_link" style="display: {if $DATA.ext_link != ''}table-row{else}none{/if};">
  <td class="left">{"External link"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_ext_link" value="{$DATA.ext_link}" size="42" style="color: red;"></td>
 </tr>
 <tr id="x{$BASEID}_blank" style="display: {if $DATA.ext_link != ''}table-row{else}none{/if};">
  <td class="left">{"new page"|translate}</td>
  <td class="right"><input type="checkbox" name="x{$BASEID}_blank" value="1"{if $DATA.blank != 0} checked="checked"{/if}></td>
 </tr>
</table>




<table cellspacing="0" cellpadding="0" width="100%">
{if $DISPLAY.headimage}
<tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Head image"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>

 <tr>
  <td class="left">{"Head image"|translate}</td>
  <td class="right">
   <a href="#" onclick="javascript:popup('{$smarty.server.PHP_SELF}?TPL={$IMAGE_PICKER_TPL}&x{$IMAGE_PICKER_BASE_ID}_field=x{$BASEID}_image&x{$IMAGE_PICKER_BASE_ID}_form=edit',770,470,'picker');"><img style="cursor: hand; cursor: pointer;" src="{$XT_IMAGES}icons/pick_photo.png" title="{"Pick an image"|translate}" alt="{"Pick an image"|translate}" /></a>{
   actionIcon
       action="deleteImage"
       icon="delete.png"
       form="edit"
       yoffset=1
       title="Delete Image"
       field="image"
       ask="Are you sure that you want to delete this image relation"
   }<br />
   {if $DATA.image < 1}
   <img name="x{$BASEID}_image_view" src="{$XT_IMAGES}spacer.gif" alt="" />
   {else}
   {if $DATA.image_type == 2}
   <div style="border: 1px solid black; margin-top: 5px; width: 200px;">
   <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="200" height="{math equation=200/(width/height) width=$DATA.width height=$DATA.height}">
   <param name="movie" value="{$XT_WEB_ROOT}download.php?file_id={$DATA.image}" />
   <param name="quality" value="high" />
   <embed src="{$XT_WEB_ROOT}download.php?file_id={$DATA.image}" quality="high" width="200" height="{math equation=200/(width/height) width=$DATA.width height=$DATA.height}" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed>
   </object>
   </div>
   <img name="x{$BASEID}_image_view" src="{$XT_IMAGES}spacer.gif" alt="" />
   {else}
   <img name="x{$BASEID}_image_view" src="{$XT_WEB_ROOT}download.php?file_id={$DATA.image}&file_version=2" alt="" class="picked" />
   {/if}
   {/if}
  </td>
 </tr>
{/if}
{if $DISPLAY.menuimages}
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Menu Images"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>

 <tr>
  <td class="left">{"Normal"|translate}</td>
  <td class="right">
   <img onclick="javascript:popup('{$smarty.server.PHP_SELF}?TPL={$IMAGE_PICKER_TPL}&x{$IMAGE_PICKER_BASE_ID}_field=x{$BASEID}_nav_image&x{$IMAGE_PICKER_BASE_ID}_form=edit',770,470,'picker');" style="cursor: hand; cursor: pointer;" src="{$XT_IMAGES}icons/pick_photo.png" title="{"Pick an image"|translate}" alt="{"Pick an image"|translate}" />{
   actionIcon
       action="deleteImage"
       icon="delete.png"
       form="edit"
       yoffset=1
       title="Delete Image"
       field="nav_image"
       ask="Are you sure that you want to delete this image relation"
   }<br />
   {if $DATA.nav_image == ''}
   <img name="x{$BASEID}_nav_image_view" src="{$XT_IMAGES}spacer.gif" alt="" />
   {else}
   <{if $DATA.nav_image_version == 'embed'}embed{else}img{/if} name="x{$BASEID}_nav_image_view" src="{$XT_WEB_ROOT}download.php?file_id={$DATA.nav_image}&file_version=1" class="admin_image" {if $DATA.nav_image_version != 'embed'}alt=""{else}width="100%"{/if}>
   {/if}
  </td>
 </tr>
 <tr>
  <td class="left">{"Active"|translate}</td>
  <td class="right">
   <img onclick="javascript:popup('{$smarty.server.PHP_SELF}?TPL={$IMAGE_PICKER_TPL}&x{$IMAGE_PICKER_BASE_ID}_field=x{$BASEID}_nav_image_active&x{$IMAGE_PICKER_BASE_ID}_form=edit',770,470,'picker');" style="cursor: hand; cursor: pointer;" src="{$XT_IMAGES}icons/pick_photo.png" title="{"Pick an image"|translate}" alt="{"Pick an image"|translate}" />{
   actionIcon
       action="deleteImage"
       icon="delete.png"
       form="edit"
       yoffset=1
       title="Delete Image"
       field="nav_image_active"
       ask="Are you sure that you want to delete this image relation"
   }<br />
   {if $DATA.nav_image_active == ''}
   <img name="x{$BASEID}_nav_image_active_view" src="{$XT_IMAGES}spacer.gif" alt="" />
   {else}
   <{if $DATA.nav_image_active_version == 'embed'}embed{else}img{/if} name="x{$BASEID}_nav_image_active_view" src="{$XT_WEB_ROOT}download.php?file_id={$DATA.nav_image_active}&file_version=1" class="admin_image" {if $DATA.nav_image_active_version != 'embed'}alt=""{else}width="100%"{/if}>
   {/if}
  </td>
 </tr>
 <tr>
  <td class="left">{"Rollover"|translate}</td>
  <td class="right">
   <img onclick="javascript:popup('{$smarty.server.PHP_SELF}?TPL={$IMAGE_PICKER_TPL}&x{$IMAGE_PICKER_BASE_ID}_field=x{$BASEID}_nav_image_rollover&x{$IMAGE_PICKER_BASE_ID}_form=edit',770,470,'picker');" style="cursor: hand; cursor: pointer;" src="{$XT_IMAGES}icons/pick_photo.png" title="{"Pick an image"|translate}" alt="{"Pick an image"|translate}" />{
   actionIcon
       action="deleteImage"
       icon="delete.png"
       form="edit"
       yoffset=1
       title="Delete Image"
       field="nav_image_rollover"
       ask="Are you sure that you want to delete this image relation"
   }<br />
   {if $DATA.nav_image_rollover == ''}
   <img name="x{$BASEID}_nav_image_rollover_view" src="{$XT_IMAGES}spacer.gif" alt="" />
   {else}
   <{if $DATA.nav_image_rollover_version == 'embed'}embed{else}img{/if} name="x{$BASEID}_nav_image_rollover_view" src="{$XT_WEB_ROOT}download.php?file_id={$DATA.nav_image_rollover}&file_version=1" class="admin_image" {if $DATA.nav_image_rollover_version != 'embed'}alt=""{else}width="100%"{/if}>
   {/if}
  </td>
 </tr>
 <tr>
  <td class="left">{"Active Rollover"|translate}</td>
  <td class="right">
   <img onclick="javascript:popup('{$smarty.server.PHP_SELF}?TPL={$IMAGE_PICKER_TPL}&x{$IMAGE_PICKER_BASE_ID}_field=x{$BASEID}_nav_image_active_rollover&x{$IMAGE_PICKER_BASE_ID}_form=edit',770,470,'picker');" style="cursor: hand; cursor: pointer;" src="{$XT_IMAGES}icons/pick_photo.png" title="{"Pick an image"|translate}" alt="{"Pick an image"|translate}" />{
   actionIcon
       action="deleteImage"
       icon="delete.png"
       form="edit"
       yoffset=1
       title="Delete Image"
       field="nav_image_active_rollover"
       ask="Are you sure that you want to delete this image relation"
   }<br />
   {if $DATA.nav_image_active_rollover == ''}
   <img name="x{$BASEID}_nav_image_active_rollover_view" src="{$XT_IMAGES}spacer.gif" alt="" />
   {else}
   <{if $DATA.nav_image_active_rollover_version == 'embed'}embed{else}img{/if} name="x{$BASEID}_nav_image_active_rollover_view" src="{$XT_WEB_ROOT}download.php?file_id={$DATA.nav_image_active_rollover}&file_version=1" class="admin_image" {if $DATA.nav_image_active_rollover_version != 'embed'}alt=""{else}width="100%"{/if}>
   {/if}
  </td>
 </tr>
 {/if}
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
{if $DISPLAY.properties}
   {include file="includes/widgets/properties.tpl" content_id=$DATA.node_id content_type=$BASEID formname="edit" universal=$DISPLAY.properties_universal lang=$ACTIVE_LANG}
{/if}
</table>




<table cellpadding="0" cellspacing="0" border="0" width="100%">
  <tr>
  <td class="view_header" colspan="3">
   <span class="title">{"Choose template"|translate}</span>
  </td>
 </tr>
  <tr>
  <td class="view_separator" colspan="3"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$LAYOUTS_BUTTONS withouthidden="1"}
<table cellpadding="0" cellspacing="0" border="0" width="100%">
 <tr>
  <td class="row" style="padding-right: 0px;" width="20"><input checked type="radio" name="x{$BASEID}_pagetemplate" value="0"/></td>
  <td class="row">Leere Seite</td>
  <td class="row" style="padding-right: 0px;" width="20">&nbsp;</td>
 </tr>
 {foreach from=$TEMPLATES item=TEMPLATE}
 <tr>
  <td class="row" style="padding-right: 0px;" width="20"><input {if $DATA.based_on_tpl == $TEMPLATE.id}checked{/if} type="radio" name="x{$BASEID}_pagetemplate" value="{$TEMPLATE.id}"/></td>
  <td class="row">{$TEMPLATE.title}</td>
  <td class="row" style="padding-right: 0px;" width="20" {if $TEMPLATE.image > 0}onmouseover="document.getElementById('x{$BASEID}_preview{$TEMPLATE.id}').style.display='table-row';" onmouseout="document.getElementById('x{$BASEID}_preview{$TEMPLATE.id}').style.display='none';"{/if}>{if $TEMPLATE.image > 0}<img src="/images/icons/view.png" />{else}&nbsp;{/if}</td>
 </tr>
 {if $TEMPLATE.image > 0}
 <tr id="x{$BASEID}_preview{$TEMPLATE.id}" style="display: none;">
  <td class="row" colspan="3">{
  image
      id=$TEMPLATE.image
      version=3
      style="border: 1px solid #000000;"
  }</td>
 </tr>
 {/if}
 {/foreach}
</table>
<input type="hidden" name="x{$BASEID}_author" value="{$DATA.author}" />
<input type="hidden" name="x{$BASEID}_copyright" value="{$DATA.copyright}" />
<input type="hidden" name="x{$BASEID}_public" value="{$DATA.public}" />
<input type="hidden" name="x{$BASEID}_description" value="{$DATA.description}" />
<input type="hidden" name="x{$BASEID}_keywords" value="{$DATA.keywords}" />
<input type="hidden" name="x{$BASEID}_target" value="{$DATA.target}" />
<input type="hidden" name="x{$BASEID}_visible" value="{$DATA.visible}" />
<input type="hidden" name="x{$BASEID}_show_in_overview" value="{$DATA.show_in_overview}" />
<input type="hidden" name="x{$BASEID}_header" value="{$DATA.header}" />
<input type="hidden" name="x{$BASEID}_footer" value="{$DATA.footer}" />
<input type="hidden" name="x{$BASEID}_css" value="{$DATA.css}" />
<input type="hidden" name="x{$BASEID}_image" value="{$DATA.image}" />
<input type="hidden" name="x{$BASEID}_image_version" value="{$DATA.image_version}" />
<input type="hidden" name="x{$BASEID}_nav_image" value="{$DATA.nav_image}" />
<input type="hidden" name="x{$BASEID}_nav_image_version" value="{$DATA.nav_image_version}" />
<input type="hidden" name="x{$BASEID}_nav_image_active" value="{$DATA.nav_image_active}" />
<input type="hidden" name="x{$BASEID}_nav_image_active_version" value="{$DATA.nav_image_active_version}" />
<input type="hidden" name="x{$BASEID}_nav_image_rollover" value="{$DATA.nav_image_rollover}" />
<input type="hidden" name="x{$BASEID}_nav_image_rollover_version" value="{$DATA.nav_image_rollover_version}" />
<input type="hidden" name="x{$BASEID}_nav_image_active_rollover" value="{$DATA.nav_image_active_rollover}" />
<input type="hidden" name="x{$BASEID}_nav_image_active_rollover_version" value="{$DATA.nav_image_active_rollover_version}" />
<input type="hidden" name="x{$BASEID}_active" value="{$NAV_ACTIVE}" />
<input type="hidden" name="x{$BASEID}_lang" value="{$ACTIVE_LANG}" />
<input type="hidden" name="x{$BASEID}_tpl_file" value="{$DATA.tpl_file}" />
<input type="hidden" name="x{$BASEID}_id" value="{$DATA.node_id}" />
<input type="hidden" name="x{$BASEID}_node_id" value="{$DATA.node_id}" />
<input type="hidden" name="x{$BASEID}_node_pid" />
<input type="hidden" name="x{$BASEID}_node_perm_pid" />
<input type="hidden" name="x{$BASEID}_node_perm_id" />
<input type="hidden" name="x{$BASEID}_position" />
<input type="hidden" name="x{$BASEID}_active" value="{$DATA.active}" />
<input type="hidden" name="x{$BASEID}_based_on_tpl" value="{$DATA.based_on_tpl}" />
<input type="hidden" name="x{$BASEID}_entry_id" />
<input type="hidden" name="x{$BASEID}_entry_pos" value="0" />
<input type="hidden" name="x{$BASEID}_entry_mode" value="after" />
<input type="hidden" name="x{$BASEID}_entry_position" />
<input type="hidden" name="x{$BASEID}_target_module" value="" />
<input type="hidden" name="x{$BASEID}_field" />
<input type="hidden" name="x{$BASEID}_rewrite_name" value="{$DATA.rewrite_name}" />
<input type="hidden" name="x{$BASEID}_pagetitle" value="{$DATA.pagetitle}" />

<input type="hidden" name="TPL" value="{$TPL}" />
<input type="hidden" name="x{$BASEID}_save_lang" value="{$ACTIVE_LANG}" />
{yoffset}
</form>
