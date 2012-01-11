{if sizeof($DATA) > 0}
	{foreach from=$DATA item=map name=N}
		{if $map.level ==1}
				<a class="sitemaptop" href="{if $map.ext_link}{$map.ext_link}{else}{$smarty.server.PHP_SELF}?TPL={$map.id}{/if}">{$map.title}</a>
			{subplugin package="ch.iframe.snode.navigation" module="tree" style="sitemap_sub.tpl" node=$map.id open_depth=1}
		{/if}
	{/foreach}
{/if}