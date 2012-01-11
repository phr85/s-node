{if sizeof($DATA) > 0}
	{foreach from=$DATA item=NAV name=N}
		<a class="nav" style="padding-left:{$NAV.level*15-15}px;" href="{$smarty.server.PHP_SELF}?TPL={get_param param='details_tpl'}&amp;x{$BASEID}_node={$NAV.id}">{$NAV.title}</a>&nbsp;{if !$smarty.foreach.N.last}<img style="margin-top: 1px;" src="/images/default/vertdot.gif" alt="" align="top" />&nbsp;{/if}
	{/foreach}
{/if}