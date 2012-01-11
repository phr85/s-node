{if sizeof($DATA) > 0}
	{foreach from=$DATA item=NAV name=N}
		<a class="sidenav" {if $NAV.target != ''}target="{$NAV.target}"{/if} href="{if $NAV.ext_link}{$NAV.ext_link}{else}{$smarty.server.PHP_SELF}?TPL={$NAV.id}{/if}">{$NAV.title}</a>
	{/foreach}
{/if}