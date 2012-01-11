<div class="article">
<h1>{$ARTICLE.title}</h1>
{if $ARTICLE.subtitle != ''}<div class="subtitle">{$ARTICLE.subtitle}<br /><br /></div>{else}<br />{/if}
{if $ARTICLE.introduction != ''}<span class="introduction">{$ARTICLE.introduction}</span><br />{/if}
{if $ARTICLE.image > 0}{if $ARTICLE.image_zoom == 1}<a href="javascript:popup('{$smarty.server.PHP_SELF}?TPL={$IMAGE_POPUP_TPL}&x{$FILEMANAGER_BASEID}_file_id={$ARTICLE.image}');">{else}{if $ARTICLE.image_link != ''}<a target="{$ARTICLE.image_link_target}" href="{$ARTICLE.image_link}">{/if}{/if}
{if $ARTICLE.image_type == 2}
<div class="left">
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="200" height="{math equation=200/(width/height) width=$ARTICLE.width height=$ARTICLE.height}">
<param name="movie" value="{$XT_WEB_ROOT}download.php?file_id={$ARTICLE.image}" />
<param name="quality" value="high" />
<embed src="{$XT_WEB_ROOT}download.php?file_id={$ARTICLE.image}" quality="high" width="200" height="{math equation=200/(width/height) width=$ARTICLE.width height=$ARTICLE.height}" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed>
</object>
</div>
{else}{image
    id=$ARTICLE.image
    version=3
    title=$ARTICLE.title
    alt=$ARTICLE.title
    class="left"
}{/if}{if $ARTICLE.image_zoom == 1 || $ARTICLE.image_link != ''}</a>{/if}{/if}
{if $ARTICLE.maintext != ''}{$ARTICLE.maintext}{/if}
{$CHAPTERCONTENT}
<br />
<div class="chapter"></div>
<br />
<div align="right" style="float: right;"><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_step={$CHAPTERS.0.level}"><h1><span style="font-size: 13px;">{$CHAPTERS.0.title}</span> &raquo;</h1></a></div>
<h2>{"Parts of this guided tour"|translate}</h2>
{foreach from=$CHAPTERS item=CHAPTER name=C}
{$smarty.foreach.C.iteration}. <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_step={$CHAPTER.level}"><b>{$CHAPTER.title}</b></a><br />
{/foreach}
</div>
<br />
<!-- <span style="color: #999999;">{"Last update"|translate}: {$ARTICLE.creation_date|date_format:"%a, %d. %b. %Y %H:%I"}</span> -->