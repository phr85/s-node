{foreach from=$BANNERS item=BANNER name="bannerloop"}
{if ($ALLBANNER == false && $smarty.foreach.bannerloop.first == true) OR $ALLBANNER == true}
{strip}
{if $BANNER.image != ""}
{if $BANNER.type == 1}{if $BANNER.link != ''}<a target="{$BANNER.target}" href="http://{$smarty.server.SERVER_NAME}/{$smarty.server.PHP_SELF}?TPL=138&amp;x{$BASEID}_banner_id={$BANNER.id}&amp;x{$BASEID}_zone_id={$BANNER.zone_id}&amp;x{$BASEID}_link={if $BANNER.link_type == 1}{$smarty.server.PHP_SELF}?TPL={$BANNER.link}{else}{$BANNER.link}{/if}">{/if}{if $BANNER.image_type == 2}
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="{if $BANNER.bannerwidth > 0}{$BANNER.bannerwidth}{else}200{/if}" {if $BANNER.bannerheight > 0}height="{$BANNER.bannerheight}"{/if}>
<param name="movie" value="http://{$smarty.server.SERVER_NAME}/download.php?file_id={$BANNER.image}" />
<param name="quality" value="high" />
<embed src="http://{$smarty.server.SERVER_NAME}/download.php?file_id={$BANNER.image}" quality="high" width="{if $BANNER.bannerwidth > 0}{$BANNER.bannerwidth}{else}200{/if}" {if $BANNER.bannerheight > 0}height="{$BANNER.bannerheight}"{/if} type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed>
</object>
{else}
<img src="http://{$smarty.server.SERVER_NAME}/download.php?file_id={$BANNER.image}&amp;file_version={$VERSION}" alt="{$BANNER.title}"  {if $BANNER.bannerwidth > 0}width="{$BANNER.bannerwidth}"{/if} {if $BANNER.bannerheight > 0}height="{$BANNER.bannerheight}"{/if} />{/if}
{if $BANNER.link != ''}</a>{/if}{else}{$BANNER.code}{/if}
{else}
<img src="http://{$smarty.server.SERVER_NAME}{$XT_IMAGES}spacer.gif" alt="No banner found">
{/if}
{/strip}
{/if}
{/foreach}