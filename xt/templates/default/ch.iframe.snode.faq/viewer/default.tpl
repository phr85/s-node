<div class="questionWrapper">
		{if sizeof($xt1400_question) > 0}
			{foreach from=$xt1400_question item="QUESTION" name="QUESTION"}
				<div class="questionImage">&nbsp;
					{if $QUESTION.image_zoom}<a href="/download.php?file_id={$QUESTION.image}&file_version=3&download=true" rel="lightbox">{/if}
						{image id=$QUESTION.image version=1 title=$QUESTION.title alt=$QUESTION.title class="right"}
					{if $QUESTION.image_zoom}</a>{/if}
				</div>
				<div class="questionContent">
					<div class="questionText">
						<h2 class="">{"Question"|translate}: {$QUESTION.title}</h2>
						{if $QUESTION.description}
					  	 	<br />
					  	 	{$QUESTION.description}
					  	{/if}
					</div>
					<br clear="all" />
					<br clear="all" />
				  	<div class="answerText">
					  	<h2 class="">{"Answer"|translate}: {$QUESTION.answer_title}</h2>
					  	{if $QUESTION.answer_name}
					  		<p class="answeredBy">{"Answered by"|translate}: {$QUESTION.answer_name}</p>
					  	{/if}
					  	 	<br />
					  		{$QUESTION.answer}
					</div>
				</div>
			{/foreach}
		{else}
			{"Please select an active question"|translate}
		{/if}
<br clear="all" />
{if $xt1400_category_list_tpl != ""}
<br clear="all" /><a href="{$smarty.server.PHP_SELF}?TPL={$xt1400_category_list_tpl}&amp;x{$BASEID}_cat_id={$xt1400_selected.id}">{"Go back to the previous category"|livetranslate}</a>
{/if}
</div>