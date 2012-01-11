<div class="article">
<h1>{$CHAPTER.title}</h1>
{if $CHAPTER.subtitle != ''}<div class="subtitle">{$CHAPTER.subtitle}<br /></div>{else}<br />{/if}
{if $CHAPTER.image > 0}{if $CHAPTER.image_zoom == 1}<a href="#" onclick="popup('{$smarty.server.PHP_SELF}?TPL={$IMAGE_POPUP_TPL}&x{$FILEMANAGER_BASEID}_file_id={$ARTICLE.image}');">{else}{if $ARTICLE.image_link != ''}<a target="{$ARTICLE.image_link_target}" href="{$ARTICLE.image_link}">{/if}{/if}
{if $CHAPTER.image_type == 2}
<div class="left">
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="200" height="{math equation=200/(width/height) width=$CHAPTER.width height=$CHAPTER.height}">
<param name="movie" value="{$XT_WEB_ROOT}download.php?file_id={$CHAPTER.image}" />
<param name="quality" value="high" />
<embed src="{$XT_WEB_ROOT}download.php?file_id={$CHAPTER.image}" quality="high" width="200" height="{math equation=200/(width/height) width=$CHAPTER.width height=$CHAPTER.height}" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed>
</object>
</div>
{else}
{image
    id=$CHAPTER.image
    version=3
    title=$CHAPTER.title
    alt=$CHAPTER.title
    class="left"
}{/if}{if $CHAPTER.image_zoom == 1 || $CHAPTER.image_link != ''}</a>{/if}{/if}
{if $CHAPTER.maintext != ''}{$CHAPTER.maintext}{/if}
<br />
<div class="chapter"></div>
<br />
<div align="right" style="float: right;"><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_step={$NEXT_CHAPTER.level}"><h1><span style="font-size: 13px;">{if $NEXT_CHAPTER.title != ''}{$NEXT_CHAPTER.title}{else}{"Back to start"|translate}{/if}</span> &raquo;</h1></a></div>
<h2>{"Parts of this guided tour"|translate}</h2>
<a href="{$smarty.server.PHP_SELF}?TPL={$TPL}">&laquo; {"Back to start"|translate}</a><br /><br />
{foreach from=$CHAPTERS item=CHAP name=C}
{$smarty.foreach.C.iteration}. {if $CHAPTER.level != $CHAP.level}<a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_step={$CHAP.level}">{/if}<b>{$CHAP.title}</b>{if $ACTIVE_CHAPTER.id != $CHAP.id}</a>{/if}<br />
{/foreach}
</div>
<br />
<!-- <span style="color: #999999;">{"Last update"|translate}: {$ARTICLE.creation_date|date_format:"%a, %d. %b. %Y %H:%I"}</span> -->