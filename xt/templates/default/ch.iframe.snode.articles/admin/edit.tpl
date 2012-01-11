{literal}
<script type="text/javascript"><!--
if(window.parent.frames['master']){
    window.parent.frames['master'].document.forms[1].x{/literal}{$BASEID}_lang_filter.value='{$ACTIVE_LANG}';{literal}
    window.parent.frames['master'].document.forms[1].submit();
}
//-->
</script>
{/literal}
<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="post" name="edit" onSubmit="window.document.forms['editArticle'].x{$BASEID}_yoffset.value= window.pageYOffset;">
<h2><span class="light">{"Article"|translate}:</span> {$ARTICLE.title}</h2>
{include file="includes/buttons.tpl" data=$EDIT_BUTTONS}
{include file="includes/buttons.tpl" data=$EDIT2_BUTTONS withouthidden="1" yoffset=true}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"Status"|translate}</td>
  <td class="right"><input type="hidden" name="x{$BASEID}_published" value="{$ARTICLE.published}" />{if $ARTICLE.published == 1}<span style="color: green;">{"This revision is published"|translate}</span>{else}<span style="color: red;">{"This is a revision in edit. It is not published"|translate}</span>{/if}</td>
 </tr>
 <tr>
  <td class="left">{"Language"|translate}</td>
  <td class="right"><img src="{$XT_IMAGES}lang/{$ACTIVE_LANG}.png" alt="{$ACTIVE_LANG}" /></td>
 </tr>

 <tr>
  <td class="left">{"Title"|translate}</td>
  <td class="right">
  	<input type="text" name="x{$BASEID}_title" value="{$ARTICLE.title|htmlspecialchars}" size="42" style="font-weight: bold;" />
  	<input type="checkbox" name="x{$BASEID}_hide_title" {if $ARTICLE.hide_title==1} checked="checked" {/if} />{"hide title"|translate}
  </td>
 </tr>

 <tr>
  <td class="left">{"Subtitle"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_subtitle" value="{$ARTICLE.subtitle|htmlspecialchars}" size="42" /></td>
 </tr>

 <tr>
  <td class="left">{"Date"|translate} (d.m.y)</td>
  <td class="right"><input type="text" name="x{$BASEID}_articledate_str" id="x{$BASEID}_articledate_str" value="{$ARTICLE.date|date_format:"%d.%m.%Y"}" size="12" />
  <input type="hidden" name="x{$BASEID}_articledate" value="{$ARTICLE.date}" />
      {include file="includes/widgets/datepicker.tpl" relative="articledate_str"}
  </td>
 </tr>

  <tr>
  <td class="left">{"Author"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_autor" value="{$ARTICLE.autor|htmlspecialchars}" size="42" /></td>
 </tr>
 <tr>
  <td class="left">{"Introduction"|translate}</td>
  <td class="right">{toggle_editor id="introduction"}
  <textarea id="x{$BASEID}_introduction" name="x{$BASEID}_introduction" rows="4" cols="65">{$ARTICLE.introduction}</textarea></td>
 </tr>
   {if $DISPLAY.text}
 <tr>
  <td class="left">{"Text"|translate}</td>
  <td class="right">{toggle_editor id="maintext"}
  <textarea id="x{$BASEID}_maintext" name="x{$BASEID}_maintext" rows="12" cols="65">{$ARTICLE.maintext}</textarea></td>
 </tr>
 {/if}
{if $DISPLAY.relations}
 {include file="includes/widgets/relations.tpl" cid=$ARTICLE.id ctitle=$ARTICLE.title}
{/if}
{if $DISPLAY.properties}
  {include file="includes/widgets/properties.tpl" content_id=$ARTICLE.id content_type=$BASEID formname="edit" universal=true lang=$ACTIVE_LANG}
{/if}
</table>

<h2>{"Main image"|translate}</h2>
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"Image"|translate}<a name="image" /></td>
  <td class="right">{actionPopUp
    icon="pick_photo.png"
    title="Pick an image"|translate
    TPL=$IMAGE_PICKER_TPL
    BASEID=$IMAGE_PICKER_BASE_ID
    fieldBaseId=$BASEID
    fieldName="image"
    form="edit"
    name="picker"
    anker="image"
}{
   actionIcon
       action="deleteImage"
       icon="delete.png"
       form="edit"
       yoffset=1
       title="Delete Image"
       ask="Are you sure that you want to delete this image relation"
       article_id=$ARTICLE.id
   }<br />
   {if $ARTICLE.image < 1}
   <img name="x{$BASEID}_image_view" src="{$XT_IMAGES}spacer.gif" alt="" />
   {else}
   {if $ARTICLE.image_type == 2}
   <div style="border: 1px solid black; margin-top: 5px; width: 200px;">
   <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="200" height="{math equation=200/(width/height) width=$ARTICLE.width height=$ARTICLE.height}">
   <param name="movie" value="{$XT_WEB_ROOT}download.php?file_id={$ARTICLE.image}" />
   <param name="quality" value="high" />
   <embed src="{$XT_WEB_ROOT}download.php?file_id={$ARTICLE.image}" quality="high" width="200" height="{math equation=200/(width/height) width=$ARTICLE.width height=$ARTICLE.height}" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed>
   </object>
   </div>
   <img name="x{$BASEID}_image_view" src="{$XT_IMAGES}spacer.gif" alt="" />
   {else}
   <img name="x{$BASEID}_image_view" src="{$XT_WEB_ROOT}download.php?file_id={$ARTICLE.image}&amp;file_version=1" alt="" class="picked" />
   {/if}
   {/if}
  </td>
 </tr>
 <tr>
  <td class="left">{"Image link"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_image_link" {if $ARTICLE.image_zoom == 1}disabled{/if} id="image_link" value="{$ARTICLE.image_link}" size="42" /></td>
 </tr>
 <tr>
  <td class="left">{"Image link target"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_image_link_target" id="image_link_target" {if $ARTICLE.image_zoom == 1}disabled{/if}>
    <option value="_self"   {if $ARTICLE.image_link_target == '_self'}selected{/if}>{"Same window"|translate} (_self)</option>
    <option value="_blank"  {if $ARTICLE.image_link_target == '_blank'}selected{/if}>{"New window"|translate} (_blank)</option>
    <option value="_parent" {if $ARTICLE.image_link_target == '_parent'}selected{/if}>{"Parent window"|translate} (_parent)</option>
    <option value="_top"    {if $ARTICLE.image_link_target == '_top'}selected{/if}>{"Top window"|translate} (_top)</option>
   </select>
  </td>
 </tr>
 <tr>
  <td class="left">{"Zoom Popup available?"|translate}</td>
  <td class="right"><input onclick="switchLinkType(this,'');" type="checkbox" name="x{$BASEID}_image_zoom" value="1" {if $ARTICLE.image_zoom == 1}checked{/if} />
  </td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$BUTTONSDOWN withouthidden="1" yoffset=true}
{include file="includes/buttons.tpl" data=$EDIT2_BUTTONS withouthidden="1" yoffset=true}
{if ($CHAPTERSTHERE == true)}
<input type="hidden" name="x{$BASEID}_maxlevel" value="{$MAXLEVEL}" />
 {foreach from=$ARTICLECHAPTER key=FIELD item=ROW}
 <h2><span class="light">{"Chapter"|translate}:</span> {$ROW.title}</h2>
 <table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"Controls"|translate}<a id="chapter_{$ROW.level}" name="chapter_{$ROW.level}">&nbsp;</a></td>
  <td class="right">{if $COPY != true}{if $ROW.active
  }{actionIcon
       action="deactivateChapter"
       perm="edit"
       icon="active.png"
       form="edit"
       yoffset=1
       title="Deactivate the chapter"
       level=$ROW.level
   }{else}{actionIcon
       action="activateChapter"
       icon="inactive.png"
       perm="edit"
       form="edit"
       yoffset=1
       title="Activate the chapter"
       level=$ROW.level
   }{/if}{actionIcon
       action="saveArticle"
       icon="disk_blue.png"
       perm="edit"
       form="edit"
       yoffset=1
       title="Save"
       article_id=$ROW.level
   }{actionIcon
       action="cutChapter"
       icon="cut.png"
       perm="edit"
       form="edit"
       yoffset=1
       title="Cut chapter"
       level=$ROW.level
   }{actionIcon
       action="copyChapter"
       icon="copy.png"
       perm="edit"
       form="edit"
       yoffset=1
       title="Copy chapter"
       level=$ROW.level
   }{actionIcon
       action="deleteChapter"
       icon="delete.png"
       perm="edit"
       form="edit"
       yoffset=1
       title="Delete"
       ask="Are you sure to delete this entry?"
       level=$ROW.level
   }
   {else}
    {
   actionIcon
       action="editArticle"
       chapter=$FIELD
       icon="cancel.png"
       form="edit"
       title="Cancel"
       yoffset=1
       id=$ROW.id
   }
   {assign var=foo value=$ROW.level-1}
   {
   actionIcon
       action="cuttedChapter"
       newlevel=$foo
       chapter=$FIELD
       origlevel=$COPY
       icon="explorer/arrow_up_green.png"
       form="edit"
       title="Paste the selected chapter over this chapter"
       yoffset=1
       article_id=$ROW.id
   }
   {
   actionIcon
       action="cuttedChapter"
       newlevel=$ROW.level
       chapter=$FIELD
       origlevel=$COPY
       icon="explorer/arrow_down_green.png"
       form="edit"
       title="Paste the selected chapter under this chapter"
       yoffset=1
       article_id=$ROW.id
   }
   {/if}
   </td>
 </tr>
 {if $COPY == true && $ROW.level == $COPY}
 <tr>
  <td class="left_active"><b>{"Title"|translate}</b><a name="x{$FIELD}">&nbsp;</a></td>
  <td class="right_active"><input type="text" name="x{$BASEID}_title{$FIELD}" value="{$ROW.title}" size="40" /></td>
 </tr>
 {else}
 <tr>
  <td class="left">{"Title"|translate}</td>
  <td class="right"><b><input type="text" name="x{$BASEID}_title{$FIELD}" value="{$ROW.title|htmlspecialchars}" size="40" /></b><a name="x{$FIELD}">&nbsp;</a></td>
 </tr>
 {/if}

 <tr>
  <td class="left">{"Subtitle"|translate}</td>
  <td class="right">
   <input type="text" name="x{$BASEID}_subtitle{$FIELD}" value="{$ROW.subtitle|htmlspecialchars}" size="40" />
  </td>
 </tr>
 <tr>
  <td class="left">{"Text"|translate}</td>
  <td class="right">{if $ROW.layout != "bbcode.tpl"}{toggle_editor id="maintext" suffix=$FIELD}{else}{"HTML editor is not available for this template"|translate}<br/>{/if}
   <textarea id="x{$BASEID}_maintext{$FIELD}" name="x{$BASEID}_maintext{$FIELD}" rows="8" cols="65">{$ROW.maintext}</textarea>
  </td>
 </tr>
 <tr>
  <td class="left">{"Layout"|translate}</td>
  <td class="right">
   <a href="#x{$FIELD}" onclick="document.getElementById('layout{$FIELD}').value='image_left.tpl';"><img src="/images/icons/ch.iframe.snode.articles/img_left{if $ROW.layout == 'image_left.tpl'}_o{/if}.png" alt="{'Image left'|translate}" style="margin-bottom: 5px;" /></a>
   <a href="#x{$FIELD}" onclick="document.getElementById('layout{$FIELD}').value='image_right.tpl';"><img src="/images/icons/ch.iframe.snode.articles/img_right{if $ROW.layout == 'image_right.tpl'}_o{/if}.png" alt="{'Image right'|translate}" style="margin-bottom: 5px;" /></a>
   <a href="#x{$FIELD}" onclick="document.getElementById('layout{$FIELD}').value='image_top.tpl';"><img src="/images/icons/ch.iframe.snode.articles/img_top{if $ROW.layout == 'image_top.tpl'}_o{/if}.png" alt="{'Image top'|translate}" style="margin-bottom: 5px;" /></a>
   <a href="#x{$FIELD}" onclick="document.getElementById('layout{$FIELD}').value='image_float.tpl';"><img src="/images/icons/ch.iframe.snode.articles/float{if $ROW.layout == 'image_float.tpl'}_o{/if}.gif" alt="{'Floating image'|translate}" style="margin-bottom: 5px;" /></a>

   <br />
   <select name="tplselect{$FIELD}" onchange="document.getElementById('layout{$FIELD}').value=this.value;">
   <option value="">{"Please select"|translate}</option>
   {foreach from=$USERTPL key="avTPL" item="avTPLTheme"}
    <option value="{$avTPL}"{if $avTPL==$ROW.layout} selected="selected"{/if}>{$avTPL}  ({$avTPLTheme})</option>
   {/foreach}
   </select>


   <br />
   <input id="layout{$FIELD}" name="x{$BASEID}_layout{$FIELD}" size="42" value="{$ROW.layout}" />
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
    form="edit"
    name="picker"
    anker="image"|cat:$FIELD
}{
   actionIcon
       action="deleteChapterImage"
       chapter=$FIELD
       icon="delete.png"
       form="edit"
       title="Delete Image"
       yoffset=1
       ask="Are you sure that you want to delete this image relation"
       article_id=$ROW.id
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
  </td>
 </tr>
 <tr>
  <td class="left">{"Image link"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_image{$FIELD}_link" {if $ROW.image_zoom == 1}disabled{/if} id="image{$FIELD}_link" value="{$ROW.image_link}" size="42" /></td>
 </tr>
 <tr>
  <td class="left">{"Image link target"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_image{$FIELD}_link_target" id="image{$FIELD}_link_target" {if $ROW.image_zoom == 1}disabled{/if}>
    <option value="_self"   {if $ROW.image_link_target == '_self'}selected{/if}>{"Same window"|translate} (_self)</option>
    <option value="_blank"  {if $ROW.image_link_target == '_blank'}selected{/if}>{"New window"|translate} (_blank)</option>
    <option value="_parent" {if $ROW.image_link_target == '_parent'}selected{/if}>{"Parent window"|translate} (_parent)</option>
    <option value="_top"    {if $ROW.image_link_target == '_top'}selected{/if}>{"Top window"|translate} (_top)</option>
   </select>
  </td>
 </tr>
 <tr>
  <td class="left">{"Zoom Popup available?"|translate}</td>
  <td class="right"><input onclick="switchLinkType(this,{$FIELD});" type="checkbox" name="x{$BASEID}_image{$FIELD}_zoom" value="1" {if $ROW.image_zoom == 1}checked{/if} />
  </td>
 </tr>
 {if $CUT == true}
  <tr><td class="table_header" style="padding: 0px; height: 2px;" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></tr>
  {elseif $COPY == true}
  <tr><td class="left" style="border: 0px;"></td><td class="right" style="border: 0px;">
   <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_action=copyChapter&amp;x{$BASEID}_newlevel={$ROW.level}&amp;x{$BASEID}_origlevel={$COPY}"><img src="{$XT_IMAGES}icons/explorer/arrow_right_green.png" alt="{'Copy here'|translate}" align="middle" title="{'Copy the selected file to this position'|translate}" />&nbsp;{'Copy here'|translate}</a>&nbsp;
   <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_action=copyChapter&amp;x{$BASEID}_newlevel=0&amp;x{$BASEID}_origlevel={$COPY}"><img src="{$XT_IMAGES}icons/explorer/arrow_up_green.png" alt="{'Copy as first'|translate}" align="middle" title="{'Copy the selected file to the first chapter-position'|translate}" />&nbsp;{'Copy as first'|translate}</a>&nbsp;
   <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_action=copyChapter&amp;x{$BASEID}_newlevel={$MAXLEVEL}&amp;x{$BASEID}_origlevel={$COPY}"><img src="{$XT_IMAGES}icons/explorer/arrow_down_green.png" alt="{'Copy as last'|translate}" align="middle" title="{'Copy the selected file to the last chapter-position'|translate}" />&nbsp;{'Copy as last'|translate}</a>&nbsp;
   <a href="index.php?TPL={$TPL}&amp;x{$BASEID}_action=editArticle&amp;x{$BASEID}_id={$ROW.id}#chapter_{$ROW.level}"><img src="{$XT_IMAGES}icons/delete.png" alt="{'Cancel Copy'|translate}" align="middle" title="{'Cancel the copy-operation'|translate}" />&nbsp;{'Cancel'|translate}</a>
  </td></tr>
  <tr><td class="table_header" style="padding: 0px; height: 2px;" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></tr>
 {/if}
 </table>
 {include file="includes/buttons.tpl" data=$BUTTONSDOWN withouthidden="1" yoffset=true}
 {include file="includes/buttons.tpl" data=$EDIT2_BUTTONS withouthidden="1" yoffset=true}
 {/foreach}
{/if}

{include file="ch.iframe.snode.articles/admin/time.tpl"}

{if sizeof($LANGS) > 1}
<h2>{"Languages"|translate}</h2>
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"Copy into"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_copyToLang">
   {foreach from=$LANGS key=KEY item=LANG}
    {if $KEY != $ACTIVE_LANG}
    <option value="{$KEY}">{$LANG.name|translate}</option>
    {/if}
   {/foreach}
   </select>
   {actionIcon
       action="copyToLang"
       form="edit"
       icon="explorer/arrow_right_green.png"
       title="Copy to this language"
   }
  </td>
 </tr>
</table>
{/if}

{if $DISPLAY.trackback}
<table cellspacing="0" cellpadding="0" width="100%">
  {include file="includes/widgets/trackback.tpl" url="http://`$smarty.server.SERVER_NAME``$smarty.server.PHP_SELF`?TPL=113&x`$BASEID`_id=`$ARTICLE.id`" title="`$ARTICLE.title`" excerpt="`$ARTICLE.introduction`"}
</table>
{/if}

<h2>{"Versioning"|translate} ({"Last"|translate} 10)</h2>
<table cellspacing="0" cellpadding="0" width="100%">

 {foreach from=$HISTORY name=H item=VERSION}
 <tr>
  <td class="left">{actionIcon icon="breakpoint_into.png" form="edit" title="reuse this revision" action="reuseRevision" reuse_rid=$VERSION.rid }{$VERSION.creation_date|date_format:"%d.%m.%Y %H:%I:%S"}&nbsp;</td>
  <td class="right" width="20">{$VERSION.rid}</td>
  <td class="right">{$VERSION.title}&nbsp;</td>
  <td class="right" width="80">{$VERSION.creation_user}&nbsp;</td>
 </tr>
 {/foreach}
</table>

<input type="hidden" name="x{$BASEID}_image" value="{$ARTICLE.image}" />
<input type="hidden" name="x{$BASEID}_image_version" value="{$ARTICLE.image_version}" />
<input type="hidden" name="x{$BASEID}_article_id" value="" />
<input type="hidden" name="x{$BASEID}_id" value="" />
<input type="hidden" name="x{$BASEID}_node_pid" value="" />
<input type="hidden" name="x{$BASEID}_node_id" value="" />
<input type="hidden" name="x{$BASEID}_position" value="" />
<input type="hidden" name="x{$BASEID}_rid" value="{$ARTICLE.rid}" />
<input type="hidden" name="x{$BASEID}_reuse_rid" value="" />
<input type="hidden" name="x{$BASEID}_chapter" value="" />
<input type="hidden" name="x{$BASEID}_level" value="" />
<input type="hidden" name="x{$BASEID}_newlevel" value="" />
<input type="hidden" name="x{$BASEID}_origlevel" value="" />
<input type="hidden" name="x{$BASEID}_liveedit" value="{$LIVEEDIT}" />
<input type="hidden" name="x{$BASEID}_active" value="{$ARTICLE.active}" />
<input type="hidden" value="{$smarty.server.HTTP_REFERER}" name="x{$BASEID}_request" />
<input type="hidden" name="x{$BASEID}_module" value="{$ADMINMODULE}" />
{yoffset}
</form>
{include file="includes/editor.tpl"}
{literal}
<script type="text/javascript"><!--
function switchLinkType(element,id){
    if(id != '' || id == 0){
        if(element.checked){
            document.getElementById('image' + id + '_link').value='';
            document.getElementById('image' + id + '_link').disabled=true;
            document.getElementById('image' + id + '_link_target').disabled=true;
        } else {
            document.getElementById('image' + id + '_link').disabled=false;
            document.getElementById('image' + id + '_link_target').disabled=false;
        }
    } else {
        if(element.checked){
            document.getElementById('image_link').value='';
            document.getElementById('image_link').disabled=true;
            document.getElementById('image_link_target').disabled=true;
        } else {
            document.getElementById('image_link').disabled=false;
            document.getElementById('image_link_target').disabled=false;
        }
    }
}
//-->
</script>
{/literal}