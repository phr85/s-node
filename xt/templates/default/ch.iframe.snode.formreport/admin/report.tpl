{literal}
<script type="text/javascript"><!--
if(window.parent.frames['master']){
    window.parent.frames['master'].document.forms[1].x{/literal}{$BASEID}_lang_filter.value='{$ACTIVE_LANG}';{literal}
    window.parent.frames['master'].document.forms[1].submit();
}
//-->
</script>
{/literal}
<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="post" name="edit" onSubmit="window.document.forms['editpoll'].x{$BASEID}_yoffset.value= window.pageYOffset;">

<h2><span class="light">{"Form report"|translate}:</span> {$POLLDATA.0.title}</h2>
{include file="includes/buttons.tpl" data=$EDIT_BUTTONS}<!--leer-->


<div style="border-bottom: 2px solid #7da5e0; height: 50px; float: left; width: 100%; padding: 10px;">
	
		<img src="/images/icons/member2.png" alt="teilnehmer" />&nbsp;{"Number of votes:"|translate}&nbsp;{$ANZAHL}<br/>
		<img src="/images/icons/alarmclock_run.png" alt="time" />&nbsp;{"Time span:"|translate}&nbsp;{$POLLDATA.0.time_start|date_format:"%d.%m.%Y"}-{$POLLDATA.0.time_end|date_format:"%d.%m.%Y"}

</div>
<br /><br />
<!--hier wird geprüft ob teilnehmer den poll ausgefüllt haben-->
{if $ANZAHL == 0}
	<div style="font-weight: bold; ">
		<div style="padding:20px;"><br />
			<img src="/images/icons/delete2.png" alt="nichts" />&nbsp;{"Reporting not possible because there are no votes at the moment."|translate}
		</div>
	</div>
{else}
<!-- ab hier werden die polldaten gelistet-->
{foreach from=$QUESTIONS key=element_id item=Q}
	<hr /><br /><br /><font style="font-weight: bold; font-size: 12px; padding-left: 20px;">{$Q.label}</font><br /><br />
	{if $Q.element_type == 1 OR $Q.element_type == 11}
		{foreach from=$ANSWERS.$element_id  key=label item=A}
			<div style="padding-left: 40px; padding-bottom: 3px; width: 650px; height: 15px;">
				<div style="float: left;color: #575859">{$label}</div>	
			</div>	
		{/foreach}
	{else}
		{foreach from=$ANSWERS.$element_id  key=label item=A}
			<div style="padding-left: 40px; padding-bottom: 3px; width: 650px; height: 15px;">
				<div style="float: left; width: 180px;color: #575859"><div style="width: 100px; float:left;">{$label|truncate:15:"...":true}</div><div style="width: 75px;float: left;color: #979797;">
					{if $A == ''}keine stimme
					
					{else}
						{math equation="y * 100 / x" x=$ANZAHL y=$A format="%.2f"}%
					{/if}
					</div></div>
				<div style="width: 400px;">
					<div style="width: 200px;float: left; height: 15px; border: 1px solid #cfd0d0;">
						<div style="width: {math equation="2* y * 100 / x" x=$ANZAHL y=$A format="%0.0f"}px; float:left; height:15px; background-color: #b4d3fb; "></div>
					</div>						
				</div>
			</div>	
		{/foreach}
	{/if}
{/foreach}
</div>
</div>
<br />
<br />
<br />
{/if}
<!--hidenfield damit daten übergeben werden können -->
<input type="hidden" name="x{$BASEID}_poll_id" value="" />
<input type="hidden" name="x{$BASEID}_id" value="" />
<input type="hidden" name="x{$BASEID}_node_pid" value="" />
<input type="hidden" name="x{$BASEID}_node_id" value="" />
<input type="hidden" name="x{$BASEID}_position" value="" />
<input type="hidden" value="{$smarty.server.HTTP_REFERER}" name="x{$BASEID}_request" />
{yoffset}
</form>
