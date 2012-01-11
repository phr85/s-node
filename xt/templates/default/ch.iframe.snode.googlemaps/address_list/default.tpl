{XT_load_css file="googlemaps.css"}
{if $xt9100_error}
	<div id="mapError">{$xt9100_error}</div>
{else}
	{foreach from=$xt9100_address_list.address item="ADDRESS" name="ADDRESS"}
	<div class="listWrapper">
		<div>
		  	<h3 class="MAPTitle"><a href="./index.php?TPL={$xt9100_address_list.directiontpl}&x{$BASEID}_addr_id={$ADDRESS.id}">{$ADDRESS.title}</a></h3>
		</div>
	</div>
		<br clear="all" />
	{/foreach}
{/if}