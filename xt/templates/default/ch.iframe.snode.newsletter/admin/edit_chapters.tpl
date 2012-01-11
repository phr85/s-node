{foreach from=$CHAPTERS key=FIELD item=ROW}
<h2><span class="light">{"Chapter"|translate}:</span> {$ROW.title}</h2>
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"Controls"|translate}<a id="chapter_{$ROW.level}" name="chapter_{$ROW.level}">&nbsp;</a></td>
  <td class="right">
  {if $COPY != true}
  {actionIcon
       action="saveNewsletter"
       icon="disk_blue.png"
       perm="edit"
       form="edit"
       yoffset=1
       title="Save"
        
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
   
   {actionIcon
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
   }
   {else}
   {actionIcon
       action="cancelCopyChapter"
       icon="cancel.png"
       perm="edit"
       form="edit"
       yoffset=1
       title="cancel"
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
       title="Paste the selected chapter over this chapter-position"
       yoffset=1
   }
   {
   actionIcon
       action="cuttedChapter"
       newlevel=$ROW.level
       chapter=$FIELD
       origlevel=$COPY
       icon="explorer/arrow_down_green.png"
       form="edit"
       title="Paste the selected chapter under this chapter-position"
       yoffset=1
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
  <td class="right"><b><input type="text" name="x{$BASEID}_subtitle{$FIELD}" value="{$ROW.subtitle|htmlspecialchars}" size="40" /></b><a name="x{$FIELD}">&nbsp;</a></td>
 </tr>
 <tr>
  <td class="left">{"Link"|translate}</td>
  <td class="right"><b><input type="text" name="x{$BASEID}_link{$FIELD}" value="{$ROW.link}" size="40" /></b><a name="x{$FIELD}">&nbsp;</a></td>
 </tr>   

  
 <tr>
  <td class="left">{"Text"|translate}</td>
  <td class="right">{toggle_editor id="maintext" suffix=$FIELD}
   <textarea id="x{$BASEID}_maintext{$FIELD}" name="x{$BASEID}_maintext{$FIELD}" rows="8" cols="65">{$ROW.maintext}</textarea>
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
       level=$ROW.level
       icon="delete.png"
       form="edit"
       title="Delete Image"
       yoffset=1
       ask="Are you sure that you want to delete this image relation"
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
</table>
 {/foreach}  
 
 
 <table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  
  <td class="right">{actionIcon
       action="addChapter"
       icon="add.png"
       perm="edit"
       form="edit"
       yoffset=1
       title="Add Chapter"
       label="Add Chapter"
   }</td>
 </tr>
 </table>