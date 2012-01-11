<script type="text/javascript">
{literal}
function ocframe(framename) {
	if (document.getElementById(framename).style.display=='inline'){
	document.getElementById(framename).style.display='none';
	} else {
	document.getElementById(framename).style.display='inline';
	}
}
{/literal}
setTimeout("document.manager.submit();",60000);
</script>

{if $xt8100_manager.data|@count == 0}
{"There are no running tickets. Enjoy your free time!"|translate}
{else}
<form method="post" name="manager" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">

<table cellspacing="0" cellpadding="0" width="100%">
  {foreach item=TICKET from=$xt8100_manager.data}
  <tr class="{cycle values="row_a,row_b"}" {if $TICKET.timer.status == 1}style="background-color: #FFCEB8;"{/if} {if $TICKET.timer.status == 2}style="background-color: #FFEA6F;"{/if}>
  <td class="button" width="40">
   <img src="images/icons/tickets/priority_{$TICKET.priority}.png" alt=""/>
   {math equation="x - y" x=$TICKET.date y=$smarty.now assign="TIMEDIFF"}
	{if $TIMEDIFF <= 0}
	<img src="images/icons/tickets/due.png" alt="{"due"|translate}"/>
	{elseif $TIMEDIFF < 21600}
	<img src="images/icons/tickets/6h.png" alt="{"6h"|translate}"/>
	{elseif $TIMEDIFF < 86400}
	<img src="images/icons/tickets/24h.png" alt="{"24h"|translate}"/>
	{else}
	<img src="images/icons/tickets/morethan1day.png" alt="{"more than one day"|translate}"/>
	{/if}
   </td>
  <td class="row"><b>{$TICKET.title}</b>
  <div id="f{$TICKET.id}" style="{if $TICKET.timer.status > 0 OR $TICKET.status_comment != ""}display:inline;{else}display:none;{/if}" class="frame"><br/>
  	{$TICKET.description}<br/>--<br/>
	<i>{xt_getaddresses assign="CLIENT" id=$TICKET.client_id}
	{$CLIENT.title|default:""} {if $CLIENT.user_id > 0}({$CLIENT.user_id|xt_getUserProperties:"username"}){/if}<br/>
	{$CLIENT.firstName|default:""} {$CLIENT.lastName}<br/>
	{if $CLIENT.email != ""}<a href="mailto:{$CLIENT.email}">{$CLIENT.email}</a>{/if}</i>
  	<fieldset><legend>{"Effort"|translate}</legend>
  	{if $TICKET.timer.status > 0}{print_data array=$xt8100_manager.comment}
  	{"Worktime"|translate} {$TICKET.timer.time} {"Seconds"|translate} ({math equation="x/60" x=$TICKET.timer.time format="%.0f"} {"Minutes"|translate}) 
	<textarea id="x{$BASEID}_comment" name="x{$BASEID}_comment[{$TICKET.id}]" rows="6" cols="50" onkeyup="{literal}tmpstr = this.value.replace (/^\s+/, '').replace (/\s+$/, '');; if(tmpstr.length < 4){ document.getElementById('submitbutton_{/literal}{$TICKET.id}{literal}').style.display='none'; }else{document.getElementById('submitbutton_{/literal}{$TICKET.id}{literal}').style.display='inline';}{/literal}">{$TICKET.timer.comment}</textarea>
  	{if $TICKET.timer.status == 1}{actionIcon
           action="pause"
           icon="alarmclock_pause.png"
           form=0
           title="Pause"
           ticket_id=$TICKET.id
       }{actionLink
           action="pause"
           text="Pause"
           ticket_id=$TICKET.id
           form=0
       }
       {/if}
       {if $TICKET.timer.status == 2}{actionIcon
           action="resume"
           icon="alarmclock_run.png"
           form=0
           title="Resume"
           ticket_id=$TICKET.id
       }{actionLink
           action="resume"
           text="Resume"
           ticket_id=$TICKET.id
           form=0
       }
       {/if}
  	<div id="submitbutton_{$TICKET.id}" {if $TICKET.timer.comment == ""}style="display:none;"{else}style="display:inline;"{/if}>
  		 {actionIcon
           action="stopp"
           icon="alarmclock_stop.png"
           form=0
           ticket_id=$TICKET.id
           title="Stopp"
       }{actionLink
           action="stopp"
           text="Stopp working"
           ticket_id=$TICKET.id
           form=0
       } 
  	</div>
  	</fieldset>
  	{else}
  	 {actionIcon
           action="start"
           icon="alarmclock_run.png"
           form=0
           ticket_id=$TICKET.id
           title="start"
       }
       {actionLink
           action="start"
           text="Start working"
           form=0
           ticket_id=$TICKET.id
           title="start"
       }
       </fieldset>
  	<fieldset><legend>{"Status"|translate}</legend>
  	{"1. Comment the statuschange"|translate}<br/>
  <textarea name="x{$BASEID}_status_comment_{$TICKET.id}" rows="4" cols="45" onkeyup="{literal}tmpstr = this.value.replace (/^\s+/, '').replace (/\s+$/, '');; if(tmpstr.length < 4){ document.getElementById('newstatus_{/literal}{$TICKET.id}{literal}').style.display='none'; }else{document.getElementById('newstatus_{/literal}{$TICKET.id}{literal}').style.display='inline';}{/literal}">{$TICKET.status_comment}</textarea><br/>
  <div id="newstatus_{$TICKET.id}" style="{if $TICKET.status_comment|count_characters >3}display:inline;{else}display:none;{/if}" >
  {"2. Choose the new status"|translate}<br/>
  <select name="newstatus" onchange="this.form.x{$BASEID}_status.value=this.options[this.selectedIndex].value;this.form.x{$BASEID}_action.value='managerStatusChange';this.form.x{$BASEID}_ticket_id.value='{$TICKET.id}';this.form.submit();">
  	<option value="">{"--"|translate}</option>
	<option value="2">{"status_2"|translate}</option>
	<option value="3">{"status_3"|translate}</option>
	<option value="4">{"status_4"|translate}</option>
	<option value="5">{"status_5"|translate}</option>
  </select>
  </div>
  </fieldset>
  	{/if}
  </div>
  </td>
  <td class="button" width="20">
   {if $TICKET.timer.status == 0}<img src="images/icons/view.png" alt="" style="cursor:pointer;cursor:hand;" onclick="ocframe('f{$TICKET.id}');"/>{/if}
   </td>
  </tr>
  {/foreach}
</table>
{include file="includes/buttons.tpl" data=$BUTTONS withouthidden=true}
<input type="hidden" name="x{$BASEID}_action" value="nothing"/>
<input type="hidden" name="x{$BASEID}_status" value=""/>
<input type="hidden" name="x{$BASEID}_ticket_id" value=""/>
</form>
{/if}