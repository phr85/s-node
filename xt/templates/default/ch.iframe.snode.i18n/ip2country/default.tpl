<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="POST" name="ip2country">
<input type="text" name="x{$BASEID}_ipstring" value="{$DATA.ip}" class="field" />
<input type="submit" value="search" />
<h2>Country:</h2>
 {$DATA.country.0.country}

<h2>Query:</h2>
{$DATA.query}
</form>