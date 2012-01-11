{foreach from=$xt8000_list.polls item="POLL" name="POLL"}
<div class="listWrapper">
	<div>
	  	<h3 class="pollTitle"><a href="./index.php?TPL={$xt8000_list.viewertpl}&x{$BASEID}_id={$POLL.id}">{$POLL.title}</a></h3>
	</div>
</div>
	<br clear="all" />
{/foreach}