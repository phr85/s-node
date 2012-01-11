{XT_load_css file="googlemaps.css"}
{if $xt9100_error}
	<div id="mapError">{$xt9100_error}</div>
{else}
	{foreach from=$xt9100_list.maps item="MAP" name="MAP"}
	<div class="listWrapper">
		<div>
		  	<h3 class="MAPTitle"><a href="./index.php?TPL={$xt9100_list.viewertpl}&x{$BASEID}_id={$MAP.id}">{$MAP.title}</a></h3>
		</div>
	</div>
		<br clear="all" />
	{/foreach}
{/if}