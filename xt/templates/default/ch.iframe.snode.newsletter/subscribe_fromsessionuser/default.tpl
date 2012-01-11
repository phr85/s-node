<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
	<div>
		{foreach from=$xt5300_subscribe_fromaddressdb.categories item=CAT}
			<input type="checkbox" value="{$CAT.id}" name="x{$BASEID}_categories[{$CAT.id}]" {if $CAT.subscr == 1}checked="checked"{/if} />
			{$CAT.title}<br />
		{/foreach}
		<br />
		<input type="hidden" name="x{$BASEID}_subscribe" value="true" />
		<input type="submit" value="{'Submit'|translate}" />
	</div>
</form>
