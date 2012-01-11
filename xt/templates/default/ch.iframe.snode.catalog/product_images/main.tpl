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
{image
id=$IMAGES.0.id
version=$VERSION
title=$IMAGES.0.description
alt=$IMAGES.0.description
align = left
hspace = 10
vspace = 10
}{/if}
{/if}