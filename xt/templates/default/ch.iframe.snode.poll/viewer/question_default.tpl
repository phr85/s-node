<div>
	<div class="pollWrapper">
		<h1 class="pollTitle">{$xt8000_viewer.title}</h1>
		{if $xt8000_viewer.description != ""}
			<p class="pollDescription">{$xt8000_viewer.description}</p>
		{/if}
		{if $xt8000_viewer.image != ""}
			{if $xt8000_viewer.image_zoom}
				<a href="/download.php?file_id={$xt8000_viewer.image}&file_version=orig&lightwindowparam=.jpg" class="thickbox">
			{/if}
				<img src="/download.php?file_id={$xt8000_viewer.image}&file_version={$xt8000_viewer.image_version}" alt="{$xt8000_viewer.title}" class="pollImg" />
			{if $xt8000_viewer.image_zoom}
				</a>
				{/if}
		{/if}
		<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_id={$xt8000_viewer.id}" name="poll" class="poll">
			{foreach from=$xt8000_viewer.answers item="ANSWER"}
					{if $xt8000_viewer.multiple}
						<input type="checkbox" name="x{$BASEID}_answer[]" value="{$ANSWER.id}" />
					{else}
						<input type="radio" name="x{$BASEID}_answer[]" value="{$ANSWER.id}" />
					{/if}
				<label>{$ANSWER.title}</label>
				<br /><br />
			{/foreach}
			<br clear="all" />
			<input type="button" name="x{$BASEID}_submit" value="{"Vote"|translate}" {literal}onclick="this.form.submit();"{/literal} />
			<input type="hidden" name="x{$BASEID}_id" value="{$xt8000_viewer.id}">
			<input type="hidden" name="x{$BASEID}_id" value="{$xt8000_viewer.answers.id}">
			<input type="hidden" name="x{$BASEID}_multiple" value="{$xt8000_viewer.multiple}">
			<input type="hidden" name="x{$BASEID}_pseudoaction" value="vote">
		</form>
		<br clear="all" />
		<a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_view_result=true&x{$BASEID}_id={$xt8000_viewer.id}">{"viewresults"|livetranslate}</a>
		<br /><br />
		{if $xt8000_viewer.listtpl != ""}
		<a href="{$smarty.server.PHP_SELF}?TPL={$xt8000_viewer.listtpl}&x{$BASEID}_view_result=true&x{$BASEID}_id={$xt8000_viewer.id}">{"backtopolllist"|livetranslate}</a>
		{/if}
	</div>
</div>