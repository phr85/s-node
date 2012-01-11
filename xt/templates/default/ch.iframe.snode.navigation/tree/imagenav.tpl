{if sizeof($DATA) > 0}
	{foreach from=$DATA item=NAV name=N}
		<a class="nav" {if $NAV.selected}onmouseout="document.navimage_{$NAV.id}.src='/download.php?file_id={$NAV.nav_image_active}&download=true&file_version=6';" onmouseover="navimage_{$NAV.id}.src='/download.php?file_id={$NAV.nav_image_active_rollover}&download=true&file_version=6';" {else}onmouseout="navimage_{$NAV.id}.src='/download.php?file_id={$NAV.nav_image}&download=true&file_version=6';" onmouseover="navimage_{$NAV.id}.src='/download.php?file_id={$NAV.nav_image_rollover}&download=true&file_version=6';"{/if} {if $NAV.target != ''}target="{$NAV.target}"{/if} href="{if $NAV.ext_link}{$NAV.ext_link}{else}{$smarty.server.PHP_SELF}?TPL={$NAV.id}{/if}">
		<span class="link_image">
			{if $NAV.selected}
				<img id="navimage" name="navimage_{$NAV.id}" src="/download.php?file_id={$NAV.nav_image_active}&download=true&file_version=6" alt="{$NAV.title}" />
			{else}
				<img id="navimage" name="navimage_{$NAV.id}" src="/download.php?file_id={$NAV.nav_image}&download=true&file_version=6" alt="{$NAV.title}" />
			{/if}
		</span>
		<span class="link_text">{$NAV.title}</span></a>
	{/foreach}
{/if}