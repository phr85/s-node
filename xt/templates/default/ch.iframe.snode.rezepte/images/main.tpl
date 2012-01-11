{if count($IMAGES) > 0}
{if $IMAGES.0.type == 2}
<div class="left">
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="200" height="{math equation=200/(width/height) width=$IMAGES.0.width height=$IMAGES.0.height}">
<param name="movie" value="{$XT_WEB_ROOT}download.php?file_id={$IMAGES.0.id}" />
<param name="quality" value="high" />
<embed src="{$XT_WEB_ROOT}download.php?file_id={$IMAGES.0.id}" quality="high" width="200" height="{math equation=200/(width/height) width=$IMAGES.0.width height=$IMAGES.0.height}" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed>
</object>
</div>
{else}
<a href="/download.php?file_id={$IMAGES.0.id}&amp;file_version=4&amp;lw=is.jpg" class="thickbox" rel="lightbox-art{$DATA.recipe.id}" title="{$IMAGES.0.description}">
{image
id=$IMAGES.0.id
version=$VERSION
title=$IMAGES.0.description
alt=$IMAGES.0.description
}</a>{/if}
{/if}