{XT_load_js file="jquery-plugins/jquery.cycle.js"}
{XT_load_js file="ch.iframe.snode.banner/activate.cycle.js"}
{XT_load_css file="live/jquery.cycle.css"}

<div id="s1" class="pics">
	{foreach from=$ZONE key="key" item="BANNER"}
	<a target="{$BANNER.target}" href="http://{$smarty.server.SERVER_NAME}/{$smarty.server.PHP_SELF}?TPL=138&amp;x{$BASEID}_banner_id={$BANNER.id}&amp;x{$BASEID}_zone_id={$BANNER.zone_id}&amp;x{$BASEID}_link={if $BANNER.link_type == 1}{$smarty.server.PHP_SELF}?TPL={$BANNER.link}{else}{$BANNER.link}{/if}">
		<img src="download.php?file_id={$BANNER.image}&file_version=orig" />
	</a>
	{/foreach}
</div>