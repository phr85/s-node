<div>
	<h1 class="pollTitle">{$xt8000_viewer.polltitle}</h1>
	<p class="description">{$xt8000_viewer.description}</p>
	{if $xt8000_viewer.totalvotes == 0}
	<p>{"no votes yet"|livetranslate}</p>
	{else}
	<p>{"number of total votings"|livetranslate}: {$xt8000_viewer.totalvotes}</p>
	{/if}
	{if $xt8000_error !=""}
		<p class="error">{$xt8000_error}<br /><br /><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_id={$xt8000_viewer.id}">{"goback"|livetranslate}</a></p>
	{/if}
	
	{foreach from=$xt8000_viewer.answers item="ANSWER" name="ANSWER"}
		<div class="single_resultwrapper">
			<span class="answer_title">{$ANSWER.title}</span><span class="number_of_votes">  {"number of votings"|livetranslate}:&nbsp;{$ANSWER.votes} / {$ANSWER.inpercent}%</span>
			<br clear="all" />
			<div class="bar_wrapper">
				<div class="bar_wrapper_inner" style="width:{$ANSWER.inpercent}%;">&nbsp;</div>
			</div>
		</div>
	{/foreach}
	<p>&nbsp;</p>
	<a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_id={$xt8000_viewer.id}">{"back to voting"|livetranslate}</a>
</div>