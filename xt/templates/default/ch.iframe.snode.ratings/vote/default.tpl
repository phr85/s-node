<br />
{if $ERRORMESSAGE}
	{$ERRORMESSAGE}
{else}
	{"Thanks for rating"|translate}<br /><br />
	<b>{"You rated"|translate}:</b> {$xt8400_rated}<br />
	{"Number of ratings casted"|translate}: {$xt8400_viewer.voters}<br />
	{"Average rating"|translate}: {$xt8400_viewer.curval}<br />
{/if}
<br />
{if $UPDATE}
	{$UPDATE}
{/if}