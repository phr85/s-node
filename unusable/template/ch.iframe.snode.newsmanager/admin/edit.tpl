{literal}
<script language="JavaScript"><!--
if(window.parent.frames['master']){
    window.parent.frames['master'].document.forms[1].submit();
}
//-->
</script>
{/literal}
<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="POST" name="edit" onSubmit="window.document.forms['editArticle'].x{$BASEID}_yoffset.value= window.pageYOffset;">
<h2><span class="light">{"News"|translate}:</span> {$NEWS.title}</h2>
{include file="includes/buttons.tpl" data=$EDIT_BUTTONS}
{include file="includes/buttons.tpl" data=$EDIT2_BUTTONS withouthidden="1"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"Status"|translate}</td>
  <td class="right"><input type="hidden" name="x{$BASEID}_published" value="{$NEWS.published}">{if $NEWS.published == 1}<span style="color: green;">{"This revision is published"|translate}</span>{else}<span style="color: red;">{"This is a revision in edit. It is not published"|translate}</span>{/if}</td>
 </tr>
 <tr>
  <td class="left">{"Language"|translate}</td>
  <td class="right"><img src="{$XT_IMAGES}lang/{$ACTIVE_LANG}.png" alt="{$ACTIVE_LANG}" /></td>
 </tr>
 <tr>
  <td class="left">{"Revision"|translate}</td>
  <td class="right">{$NEWS.rid}</td>
 </tr>
 <tr>
  <td class="left">{"Title"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_title" value="{$NEWS.title|htmlspecialchars}" size="42" style="font-weight: bold;"></td>
 </tr>
 <tr>
  <td class="left">{"Subtitle"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_subtitle" value="{$NEWS.subtitle|htmlspecialchars}" size="42"></td>
 </tr>
 <tr>
  <td class="left">{"Author"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_autor" value="{$NEWS.autor|htmlspecialchars}" size="42"></td>
 </tr>
 <tr>
  <td class="left">{"Introduction"|translate}</td>
  <td class="right">{toggle_editor id="introduction"}
  <textarea id="x{$BASEID}_introduction" name="x{$BASEID}_introduction" rows="6" cols="65">{$NEWS.introduction}</textarea></td>
 </tr>
 <tr>
  <td class="left">{"Text"|translate}</td>
  <td class="right">{toggle_editor id="maintext"}
  <textarea id="x{$BASEID}_maintext" name="x{$BASEID}_maintext" rows="12" cols="65">{$NEWS.maintext}</textarea></td>
 </tr>
 {if sizeof($LANGS) > 1}
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Languages"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt=""></td>
 </tr>
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
   }
  </td>
 </tr>
 {/if}
</table>
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Feed options"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt=""></td>
 </tr>
 <tr>
  <td class="left">{"Exclude from feed"|translate}&nbsp;</td>
  <td class="right"><input type="checkbox" name="x{$BASEID}_exclude_from_feed"{if $NEWS.exclude_from_feed ==1} checked{/if}></td>
 </tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Main image"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt=""></td>
 </tr>
 <tr>
  <td class="left">{"Image"|translate}</td>
  <td class="right">
  <a onclick="javascript:popup('{$smarty.server.PHP_SELF}?TPL={$IMAGE_PICKER_TPL}&x{$IMAGE_PICKER_BASE_ID}_field=x{$BASEID}_image&x{$IMAGE_PICKER_BASE_ID}_form=edit',770,470,'picker');" href="#">
   <img src="{$XT_IMAGES}icons/pick_photo.png" title="{"Pick an image"|translate}" alt="{"Pick an image"|translate}"></a>{
   actionIcon
       action="deleteImage"
       icon="delete.png"
       form="edit"
       yoffset=1
       title="Delete Image"
       ask="Are you sure that you want to delete this image relation"
       article_id=$NEWS.id
   }<br>
   {if $NEWS.image == ''}
   <img name="x{$BASEID}_image_view" src="{$XT_IMAGES}spacer.gif" alt="">
   {else}
   <{if $NEWS.image_version == 'embed'}embed{else}img{/if} name="x{$BASEID}_image_view" src="{$XT_WEB_ROOT}download.php?file_id={$NEWS.image}&file_version=2" {if $NEWS.image_version != 'embed'}alt=""{else}width="100%"{/if}>
   {/if}
  </td>
 </tr>
 <tr>
  <td class="left">{"Image link"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_image_link" {if $NEWS.image_zoom == 1}disabled{/if} id="image_link" value="{$NEWS.image_link}" size="42"></td>
 </tr>
 <tr>
  <td class="left">{"Image link target"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_image_link_target" id="image_link_target" {if $NEWS.image_zoom == 1}disabled{/if}>
    <option value="_self"   {if $NEWS.image_link_target == '_self'}selected{/if}>{"Same window"|translate} (_self)</option>
    <option value="_blank"  {if $NEWS.image_link_target == '_blank'}selected{/if}>{"New window"|translate} (_blank)</option>
    <option value="_parent" {if $NEWS.image_link_target == '_parent'}selected{/if}>{"Parent window"|translate} (_parent)</option>
    <option value="_top"    {if $NEWS.image_link_target == '_top'}selected{/if}>{"Top window"|translate} (_top)</option>
   </select>
  </td>
 </tr>
 <tr>
  <td class="left">{"Zoom Popup available?"|translate}</td>
  <td class="right"><input onclick="switchLinkType(this,'');" type="checkbox" name="x{$BASEID}_image_zoom" value="1" {if $NEWS.image_zoom == 1}checked{/if}>
  </td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$BUTTONSDOWN withouthidden=1}
{if ($CHAPTERSTHERE == true)}
<input type="hidden" name="x{$BASEID}_maxlevel" value="{$MAXLEVEL}">
<table cellspacing="0" cellpadding="0" width="100%">
 {foreach from=$NEWSCHAPTER key=FIELD item=ROW}
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Chapter"|translate}:</span> <span class="title">{$ROW.title}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt=""></td>
 </tr>
 <tr>
  <td class="left">{"Controls"|translate}<a name="{$ROW.level}">&nbsp;</a></td>
  <td class="right">{if $ROW.active
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
       action="saveNews"
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
   }</td>
 </tr>
 {if $COPY == true && $ROW.level == $COPY}
 <tr>
  <td class="left_active"><b>{"Title"|translate}</b><a name="x{$FIELD}">&nbsp;</a></td>
  <td class="right_active"><input type="text" name="x{$BASEID}_title{$FIELD}" value="{$ROW.title}" size="40"></td>
 </tr>
 {else}
 <tr>
  <td class="left">{"Title"|translate}<a name="x{$FIELD}">&nbsp;</a></td>
  <td class="right"><b><input type="text" name="x{$BASEID}_title{$FIELD}" value="{$ROW.title}" size="40"></b></td>
 </tr>   
 {/if}
 
 <tr>
  <td class="left">{"Subtitle"|translate}</td>
  <td class="right">
   <input type="text" name="x{$BASEID}_subtitle{$FIELD}" size="40" value="{$ROW.subtitle}">
  </td>
 </tr>
 <tr>
  <td class="left">{"Text"|translate}</td>
  <td class="right">
  {toggle_editor id="maintext" suffix=$FIELD}
   <textarea id="x{$BASEID}_maintext{$FIELD}" name="x{$BASEID}_maintext{$FIELD}" rows="8" cols="65">{$ROW.maintext}</textarea>
  </td>
 </tr>
 <tr>
  <td class="left">{"Layout"|translate}</td>
  <td class="right">
   <a onclick="document.getElementById('layout{$FIELD}').value='image_left.tpl';" href="#x{$FIELD}"><img src="/images/icons/ch.iframe.snode.articles/img_left{if $ROW.layout == 'image_left.tpl'}_o{/if}.png" alt="{'Image left'|translate}" style="margin-bottom: 5px;"/></a>
   <a onclick="document.getElementById('layout{$FIELD}').value='image_right.tpl';" href="#x{$FIELD}"><img src="/images/icons/ch.iframe.snode.articles/img_right{if $ROW.layout == 'image_right.tpl'}_o{/if}.png" alt="{'Image right'|translate}" style="margin-bottom: 5px;"/></a>
   <a onclick="document.getElementById('layout{$FIELD}').value='image_top.tpl';" href="#x{$FIELD}"><img src="/images/icons/ch.iframe.snode.articles/img_top{if $ROW.layout == 'image_top.tpl'}_o{/if}.png" alt="{'Image top'|translate}" style="margin-bottom: 5px;"/></a>
   <br />
   <input id="layout{$FIELD}" name="x{$BASEID}_layout{$FIELD}" size="42" value="{$ROW.layout}" />
  </td>
 </tr>

 <tr>
  <td class="left">{"Image"|translate}</td>
  <td class="right">
  <a href="#x{$FIELD}" onclick="javascript:popup('{$smarty.server.PHP_SELF}?TPL={$IMAGE_PICKER_TPL}&x{$IMAGE_PICKER_BASE_ID}_field=x{$BASEID}_image{$FIELD}&x{$IMAGE_PICKER_BASE_ID}_form=edit',770,470,'picker');">
   <img src="{$XT_IMAGES}icons/pick_photo.png" title="{"Pick an image"|translate}" alt="{"Pick an image"|translate}"></a>{
   actionIcon
       action="deleteChapterImage"
       chapter=$FIELD
       icon="delete.png"
       form="edit"
       title="Delete Image"
       yoffset=1
       ask="Are you sure that you want to delete this image relation"
       article_id=$ROW.id
   }<br>
   {if $ROW.image == ''}
   <img name="x{$BASEID}_image{$FIELD}_view" src="{$XT_IMAGES}spacer.gif" alt="">
   {else}
   <img name="x{$BASEID}_image{$FIELD}_view" 
    src="{$XT_WEB_ROOT}download.php?file_id={$ROW.image}&file_version=2" alt="">
   {/if}
   <input type="hidden" name="x{$BASEID}_image{$FIELD}" value="{$ROW.image}">
   <input type="hidden" name="x{$BASEID}_image{$FIELD}_version" value="{$ROW.image_version}">
  </td>
 </tr>
 <tr>
  <td class="left">{"Image link"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_image{$FIELD}_link" {if $ROW.image_zoom == 1}disabled{/if} id="image{$FIELD}_link" value="{$ROW.image_link}" size="42"></td>
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
  <td class="right"><input onclick="switchLinkType(this,{$FIELD});" type="checkbox" name="x{$BASEID}_image{$FIELD}_zoom" value="1" {if $ROW.image_zoom == 1}checked{/if}>
  </td>
 </tr>
 
 <tr>
  <td class="table_header" style="padding: 0px; height: 2px;" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="">
 </tr>
 {if $CUT == true}.
  <tr><td class="left"></td><td class="right">
   <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_action=cuttedChapter&x{$BASEID}_newlevel={$ROW.level}&x{$BASEID}_origlevel={$COPY}"><img src="{$XT_IMAGES}icons/explorer/arrow_right_green.png" alt="{'Paste here'|translate}" align="middle" title="{'Paste the selected file to this position'|translate}">&nbsp;{'Paste here'|translate}</a>&nbsp;
   <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_action=cuttedChapter&x{$BASEID}_newlevel=0&x{$BASEID}_origlevel={$COPY}"><img src="{$XT_IMAGES}icons/explorer/arrow_up_green.png" alt="{'Paste as first'|translate}" align="middle" title="{'Paste the selected file to the first chapter-position'|translate}">&nbsp;{'Paste as first'|translate}</a>&nbsp;
   <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_action=cuttedChapter&x{$BASEID}_newlevel={$MAXLEVEL}&x{$BASEID}_origlevel={$COPY}"><img src="{$XT_IMAGES}icons/explorer/arrow_down_green.png" alt="{'Paste as last'|translate}" align="middle" title="{'Paste the selected file to the last chapter-position'|translate}">&nbsp;{'Paste as last'|translate}</a>&nbsp;
   <a href="index.php?TPL={$TPL}&x{$BASEID}_action=editArticle&x{$BASEID}_id={$ROW.id}#{$ROW.level}"><img src="{$XT_IMAGES}icons/delete.png" alt="{'Cancel cut and paste'|translate}" align="middle" title="{'Cancel the paste-operation'|translate}">&nbsp;{'Cancel'|translate}</a>
  </td></tr>
  <tr><td class="table_header" style="padding: 0px; height: 2px;" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt=""></tr>
  {elseif $COPY == true}
  <tr><td class="left" style="border: 0px;"></td><td class="right" style="border: 0px;">
   <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_action=copyChapter&x{$BASEID}_newlevel={$ROW.level}&x{$BASEID}_origlevel={$COPY}"><img src="{$XT_IMAGES}icons/explorer/arrow_right_green.png" alt="{'Copy here'|translate}" align="middle" title="{'Copy the selected file to this position'|translate}">&nbsp;{'Copy here'|translate}</a>&nbsp;
   <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_action=copyChapter&x{$BASEID}_newlevel=0&x{$BASEID}_origlevel={$COPY}"><img src="{$XT_IMAGES}icons/explorer/arrow_up_green.png" alt="{'Copy as first'|translate}" align="middle" title="{'Copy the selected file to the first chapter-position'|translate}">&nbsp;{'Copy as first'|translate}</a>&nbsp;
   <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_action=copyChapter&x{$BASEID}_newlevel={$MAXLEVEL}&x{$BASEID}_origlevel={$COPY}"><img src="{$XT_IMAGES}icons/explorer/arrow_down_green.png" alt="{'Copy as last'|translate}" align="middle" title="{'Copy the selected file to the last chapter-position'|translate}">&nbsp;{'Copy as last'|translate}</a>&nbsp;
   <a href="index.php?TPL={$TPL}&x{$BASEID}_action=editArticle&x{$BASEID}_id={$ROW.id}#{$ROW.level}"><img src="{$XT_IMAGES}icons/delete.png" alt="{'Cancel Copy'|translate}" align="middle" title="{'Cancel the copy-operation'|translate}">&nbsp;{'Cancel'|translate}</a>
  </td></tr>
  <tr><td class="table_header" style="padding: 0px; height: 2px;" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt=""></tr>
 {/if}
 {/foreach}  
</table>
{include file="includes/buttons.tpl" data=$BUTTONSDOWN withouthidden=1}
{/if}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="4">
   <span class="title">{"Versioning"|translate} ({"Last"|translate} 3)</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt=""></td>
 </tr>
 {foreach from=$HISTORY name=H item=VERSION}
 <tr>
  <td class="left">{$VERSION.creation_date|date_format:"%d.%m.%Y %H:%I:%S"}&nbsp;</td>
  <td class="right" width="20">{$VERSION.rid}&nbsp;</td>
  <td class="right">{$VERSION.title}&nbsp;</td>
  <td class="right" width="80">{$VERSION.creation_user}&nbsp;</td>
 </tr>
 {/foreach}
</table>
<input type="hidden" name="x{$BASEID}_image" value="{$NEWS.image}">
<input type="hidden" name="x{$BASEID}_image_version" value="{$NEWS.image_version}">
<input type="hidden" name="x{$BASEID}_article_id" value="">
<input type="hidden" name="x{$BASEID}_id" value="">
<input type="hidden" name="x{$BASEID}_node_pid" value="">
<input type="hidden" name="x{$BASEID}_node_id" value="">
<input type="hidden" name="x{$BASEID}_position" value="">
<input type="hidden" name="x{$BASEID}_rid" value="{$NEWS.rid}">
<input type="hidden" name="x{$BASEID}_chapter" value="">
<input type="hidden" name="x{$BASEID}_level" value="">
<input type="hidden" name="x{$BASEID}_active" value="{$NEWS.active}">
<input type="hidden" value="{$smarty.server.HTTP_REFERER}" name="x{$BASEID}_request">
{yoffset}
</form>
{include file="includes/editor.tpl"}
{literal}
<script language="JavaScript"><!--
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