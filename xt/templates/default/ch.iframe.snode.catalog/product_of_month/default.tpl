<table style="width: 100%;" border="0" cellpadding="0" cellspacing="0">
   <tr><td class="border_dotted" colspan="2">&nbsp;</td></tr>
</table>
    
 <br />
{foreach from=$DATA item=PROD name=plist}

<div style="width: 235px; float:left;">
<h1 class="product"><a href="/index.php?TPL=10034&amp;x1200_article_id={$PROD.id}&amp;x1200_node={$NODES[$PROD.id].0}">{$PROD.title}</a></h1>

{if $PROD.image > 0}
{if $PROD.image_type == 2}
<div>
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" 
width="200" >
<param name="movie" value="{$XT_WEB_ROOT}download.php?file_id={$PROD.id}" />
<param name="quality" value="high" />
<param name="wmode" value="transparent">
<embed src="{$XT_WEB_ROOT}download.php?file_id={$PROD.image}" quality="high" width="200" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" wmode="transparent" />
</object>
</div>
{else}
{image
id=$PROD.image
version=3
title=$PROD.title
alt=$PROD.title
align = left
hspace = 10
vspace = 10
}
{/if}

{else}
<br />
{$PROD.lead}
{/if}
</div>

{/foreach}
