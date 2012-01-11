<p>
<i>{"Rate"|translate}</i>
<br />
<script type="text/javascript" src="{$XT_SCRIPTS}jquery.rater.js"></script>
	<div id="ratings{$xt8400_content_id}" class="demo"></div>
	{literal}
		<script type="text/javascript">
				$('#ratings{/literal}{$xt8400_content_id}{literal}').rater('ajax.php?package=ch.iframe.snode.ratings&module=vote{/literal}&x8400_content_id={$xt8400_content_id}&x8400_content_type={$xt8400_content_type}{literal}', {style:'basic', maxvalue:5, curvalue:{/literal}{if $xt8400_viewer.curval}{$xt8400_viewer.curval}{else}0{/if}{literal}});
		</script>
	{/literal}
</p>