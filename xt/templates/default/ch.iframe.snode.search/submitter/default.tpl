<form method="post" action="{$smarty.server.PHP_SELF}?TPL=10028">
{get_value param='term' assign="TERM"}
<input type="text" name="x{$BASEID}_term" class="submitter" value="{if $TERM}{$TERM}{else}Suchen{/if}" onclick="this.select();" />
</form>