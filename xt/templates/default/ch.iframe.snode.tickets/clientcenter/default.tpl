<script type="text/javascript" src="tools/wz_tooltip/wz_tooltip.js"></script>
<h1>{"Ticket Center"|translate}</h1>
<p>Zurzeit sind {$xt8100_clientcenter.running|@count} Tickets in Bearbeitung. Wir haben bereits {$xt8100_clientcenter.closed|@count} Tickets für Sie bearbeitet.</p>
<div id="tc_left">
{if $xt8100_clientcenter.running|@count > 0}
<h2>{"Running tickets"|translate}</h2>
<table cellspacing="0" cellpadding="0" width="100%" class="embed">
  <tr>
  	<td width="20" class="row">{"Status"|livetranslate}</td>
  	<td class="row">{"Title"|livetranslate}</td>
  	<td width="50" class="row">{"Startet at"|livetranslate}</td>
  	<td width="100" class="row">{"Time left"|livetranslate}</td>
  </tr>
  {foreach from=$xt8100_clientcenter.running item=TICKET}
  {xt_getaddresses assign="SUPERVISOR_DETAILS" id=$TICKET.supervisor_address}
  {xt_getaddresses assign="WORKER_DETAILS" id=$TICKET.worker_address}
  <tr class="{cycle values="row_a,row_b"}" onmouseover="Tip('<div class=&quot;TipCls1&quot;><b>{$TICKET.title|escape}</b><br/> <i>{"Supervisor"|translate}:</i> {$SUPERVISOR_DETAILS.firstName|escape} {$SUPERVISOR_DETAILS.lastName|escape}<br/> <i>{"Worker"|translate}:</i> {$WORKER_DETAILS.firstName|escape} {$WORKER_DETAILS.lastName|escape}<br/><br/>{$TICKET.description|escape}</div>',BORDERWIDTH, '',BGCOLOR, '',PADDING,'')" onmouseout="UnTip()">
   <td class="button">
    {if $TICKET.status == 1}<img src="images/icons/tickets/running.png" alt="{"status_1"|translate}"/>{/if}
   </td>
   <td class="row">{$TICKET.title}</td>
   <td class="row">{$TICKET.date|date_format:"%d.%m.%Y"}</td>
   <td class="row">
   {math equation="x - y" x=$TICKET.date y=$smarty.now assign="TIMEDIFF"}
	{if $TIMEDIFF <= 0}
	<img src="images/icons/tickets/due.png" alt="{"past-due"|translate}"/>
	{elseif $TIMEDIFF < 21600}
	<img src="images/icons/tickets/6h.png" alt="{"6h"|translate}"/>
	{elseif $TIMEDIFF < 86400}
	<img src="images/icons/tickets/24h.png" alt="{"24h"|translate}"/>
	{else}
	<img src="images/icons/tickets/morethan1day.png" alt="{"more than one day"|translate}"/>
	{/if}
	{if $TIMEDIFF <= 0}
		<span style="color:red;">-
	{/if}
	{if $TICKET.time_left.hours > 0}{$TICKET.time_left.hours} {"Hours"|livetranslate}{else}{$TICKET.time_left.minutes} {"Minutes"|livetranslate}{/if}
	{if $TIMEDIFF <= 0}
	</span>
	{/if}
   </td>
   </tr>
   {/foreach}
</table>
{/if}
{if $xt8100_clientcenter.closed|@count > 0}
<h2>{"Closed tickets"|translate}</h2>
<table cellspacing="0" cellpadding="0" width="100%" class="embed">
  <tr>
  	<td width="20" class="row">{"Status"|livetranslate}</td>
  	<td class="row">{"Title"|livetranslate}</td>
  	<td width="50" class="row">{"Startet at"|livetranslate}</td>
  	<td width="100" class="row">{"Done by"|livetranslate}</td>
  </tr>
  {foreach from=$xt8100_clientcenter.closed item=TICKET}
  {xt_getaddresses assign="SUPERVISOR_DETAILS" id=$TICKET.supervisor_address}
  {xt_getaddresses assign="WORKER_DETAILS" id=$TICKET.worker_address}
  <tr class="{cycle values="row_a,row_b"}" onmouseover="Tip('<div class=&quot;TipCls1&quot;><b>{$TICKET.title|escape}</b><br/> <i>{"Supervisor"|translate}:</i> {$SUPERVISOR_DETAILS.firstName|escape} {$SUPERVISOR_DETAILS.lastName|escape}<br/> <i>{"Worker"|translate}:</i> {$WORKER_DETAILS.firstName|escape} {$WORKER_DETAILS.lastName|escape}<br/><br/>{$TICKET.description|escape}</div>',BORDERWIDTH, '',BGCOLOR, '',PADDING,'')" onmouseout="UnTip()">
   <td class="button">
    {if $TICKET.status == 5}<img src="images/icons/tickets/done.png" alt="{"status_5"|translate}"/>{/if}
   </td>
   <td class="row">{$TICKET.title}</td>
   <td class="row">{$TICKET.date|date_format:"%d.%m.%Y"}</td>
   <td class="row">
   {$WORKER_DETAILS.firstName} {$WORKER_DETAILS.lastName}
   </td>
   </tr>
   {/foreach}
</table>
{/if}
</div>
<div id="tc_right">
{if $xt8100_clientcenter.unchecked|@count > 0}
<h2>{"Tickets to check"|translate}</h2>
<form method="post" name="clientcheck">
<table cellspacing="0" cellpadding="0" width="100%" class="embed">
  <tr>
  	<td width="20" class="row">{"Status"|livetranslate}</td>
  	<td class="row">{"Title"|livetranslate}</td>
  	<td width="50" class="row">{"Startet at"|livetranslate}</td>
  	<td width="20" class="row">&nbsp;<td/>
  </tr>
  {foreach from=$xt8100_clientcenter.unchecked item=TICKET}
  {xt_getaddresses assign="SUPERVISOR_DETAILS" id=$TICKET.supervisor_address}
  {xt_getaddresses assign="WORKER_DETAILS" id=$TICKET.worker_address}
  <tr class="{cycle values="row_a,row_b"}" onmouseover="Tip('<div class=&quot;TipCls1&quot;><b>{$TICKET.title|escape}</b><br/> <i>{"Supervisor"|translate}:</i> {$SUPERVISOR_DETAILS.firstName|escape} {$SUPERVISOR_DETAILS.lastName|escape}<br/> <i>{"Worker"|translate}:</i> {$WORKER_DETAILS.firstName|escape} {$WORKER_DETAILS.lastName|escape}<br/><br/>{$TICKET.description|escape}</div>',BORDERWIDTH, '',BGCOLOR, '',PADDING,'')" onmouseout="UnTip()">
   <td class="button">
    {if $TICKET.status == 5}<img src="images/icons/tickets/done.png" alt="{"status_5"|translate}"/>{/if}
   </td>
   <td class="row">{$TICKET.title}</td>
   <td class="row">{$TICKET.date|date_format:"%d.%m.%Y"}</td>
	<td width="20" class="row">
 {actionIcon
           action="userCheck"
           icon="haken.gif"
           form="clientcheck"
           id=$TICKET.id
           title="Edit / view ticket"
           ask="Would you like to approve this ticket?"
       }
	</td>
   </tr>
   {/foreach}
</table>

<input type="hidden" name="x{$BASEID}_id" value=""/>
<input type="hidden" name="x{$BASEID}_action" value="userCheck"/>
</form>
{/if}
{if $xt8100_clientcenter.employer_on_running_tickets|@count > 0}
<h2>{"Working for you"|translate}</h2>
		<!--
Skype 'Skype Me™!' button
http://www.skype.com/go/skypebuttons
-->
<script type="text/javascript" src="http://download.skype.com/share/skypebuttons/js/skypeCheck.js"></script>
<table cellspacing="0" cellpadding="0" width="100%" class="embed">
{foreach from=$xt8100_clientcenter.employer_on_running_tickets item=EMPLOYEE}
{xt_getaddresses assign="EMPLOYEE_DETAILS" id=$EMPLOYEE}
	<tr>
		<td width="50" class="employee">
				<a href="/download.php?file_id={$EMPLOYEE_DETAILS.image}&amp;file_version=5&amp;lw=is.jpg" class="thickbox" rel="lightbox[art{$EMPLOYEE_DETAILS.image}]" title="{$EMPLOYEE_DETAILS.firstName} {$EMPLOYEE_DETAILS.lastName}">{image id=$EMPLOYEE_DETAILS.image version=1 width=50}</a></td>
		</td>
		<td class="employee">
			{$EMPLOYEE_DETAILS.firstName} {$EMPLOYEE_DETAILS.lastName}<br/>
			<a href="mailto:{$EMPLOYEE_DETAILS.email}">{$EMPLOYEE_DETAILS.email}</a> <a href="#" onclick="{literal}if(document.getElementById('fastcontact_{/literal}{$EMPLOYEE_DETAILS.id}{literal}').style.display!='inline') {document.getElementById('fastcontact_{/literal}{$EMPLOYEE_DETAILS.id}{literal}').style.display='inline';}else{document.getElementById('fastcontact_{/literal}{$EMPLOYEE_DETAILS.id}{literal}').style.display='none'}{/literal}"><img src="images/icons/tickets/comment.png"/ alt=""></a><br/><br/>
			{"Tel G"|translate}: {$EMPLOYEE_DETAILS.tel}<br/>
			{"Mobile"|translate}: {$EMPLOYEE_DETAILS.tel_mobile}<br/>
		</td>
		<td class="employee">
			{if $EMPLOYEE_DETAILS.skype != ""}<a href="skype:{$EMPLOYEE_DETAILS.skype}?call"><img src="http://mystatus.skype.com/smallicon/{$EMPLOYEE_DETAILS.skype}" style="border: none;" width="16" height="16" alt="My status" /> Skype</a>{/if}
		</td>
	</tr>
	<tr>
		<td colspan="2" style="padding:3px;">
		<div id="fastcontact_{$EMPLOYEE_DETAILS.id}" style="display:none;">
		<form method="post">
			<textarea name="x{$BASEID}_comment" style="width:100%; height:80px; margin-bottom:3px;"></textarea><br/>
			<input type="submit" value="{"Send"|translate}"/>
			<input type="hidden" name="x{$BASEID}_contact_id" value="{$EMPLOYEE_DETAILS.user_id}"/>
			<input type="hidden" name="x{$BASEID}_action" value="clientContact"/>
		</form>
		</div>
		</td>
	</tr>
{/foreach}
</table>
{/if}
</div>