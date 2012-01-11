<style>
{literal}
.TipCls1 {
	width:300px;
	background-color: #FFF3CF;
	border: 1px solid #DDDDDD;
	padding:5px;
	color:black;
}
{/literal}
</style>
<script type="text/javascript" src="tools/wz_tooltip/wz_tooltip.js"></script>
<form method="post" name="o" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="80">&nbsp;</td>
   <td class="table_header" width="45">{"ID"|translate}</td>
   <td class="table_header">{"Title"|translate}</td>
   <td class="table_header" width="45">{"Time"|translate}</td>
   <td class="table_header" width="65">{"Effort"|translate}</td>
  </tr>
</table>
<div class="toolbar"><b>{"5 newest tickets in Pool"|translate}</b></div>
<table cellspacing="0" cellpadding="0" width="100%">
  {foreach item=TICKET from=$xt8100_admin.pool}
{capture name=tooltipp}
 onmouseover="Tip('<div class=&quot;TipCls1&quot;><b>{$TICKET.title|htmlentities}</b><br/>{"To do until"|translate}: <i>{$TICKET.date|date_format:"%d.%m.%Y %H:%M"}</i><br/><br/>{$TICKET.description|htmlentities}</div>',BORDERWIDTH, '',BORDERWIDTH, '',BGCOLOR, '',PADDING,'')" onmouseout="UnTip()"
{/capture}
  <tr class="{cycle values="row_a,row_b"}" ondblclick="window.parent.frames['slave1'].document.forms['0'].x{$BASEID}_id.value='{$TICKET.id}';window.parent.frames['slave1'].document.forms['0'].x{$BASEID}_action.value='edit';window.parent.frames['slave1'].focus();window.parent.frames['slave1'].document.forms['0'].submit();">
   <td class="button" width="80">
   {if $TICKET.status == 0}<img src="images/icons/tickets/open.png" alt="{"status_0"|translate}" title="{"status_0"|translate}"/>{/if}
   {if $TICKET.status == 1}<img src="images/icons/tickets/running.png" alt="{"status_1"|translate}" title="{"status_1"|translate}"/>{/if}
   {if $TICKET.status == 2}<img src="images/icons/tickets/onhold.png" alt="{"status_2"|translate}" title="{"status_2"|translate}"/>{/if}
   {if $TICKET.status == 4}<img src="images/icons/tickets/stopped.png" alt="{"status_4"|translate}" title="{"status_4"|translate}"/>{/if}
   {if $TICKET.status == 3}<img src="images/icons/tickets/rejected.png" alt="{"status_3"|translate}" title="{"status_3"|translate}"/>{/if}
   {if $TICKET.status == 5}<img src="images/icons/tickets/done.png" alt="{"status_5"|translate}" title="{"status_5"|translate}"/>{/if}
   <img src="images/icons/tickets/priority_{$TICKET.priority}.png" alt="{"Priority"|translate}: {$TICKET.priority}" title="{"Priority"|translate}: {$TICKET.priority}"/>
   {actionIcon
           action="edit"
           icon="view.png"
           form=0
           target="slave1"
           id=$TICKET.id
           title="Edit / view ticket"
       }
   </td>
   <td class="row" width="45" {$smarty.capture.tooltipp}>{$TICKET.id}</td>
   <td class="row" {$smarty.capture.tooltipp}>{$TICKET.title}</td>
   <td class="row" width="20" {$smarty.capture.tooltipp}>
	{math equation="x - y" x=$TICKET.date y=$smarty.now assign="TIMEDIFF"}
	{if $TIMEDIFF <= 0}
	<img src="images/icons/tickets/due.png" alt="{"due"|translate}" title="{"due"|translate}"/>
	{elseif $TIMEDIFF < 21600}
	<img src="images/icons/tickets/6h.png" alt="{"6h"|translate}" title="{"6h"|translate}"/>
	{elseif $TIMEDIFF < 86400}
	<img src="images/icons/tickets/24h.png" alt="{"24h"|translate}" title="{"24h"|translate}"/>
	{else}
	<img src="images/icons/tickets/morethan1day.png" alt="{"more than one day"|translate}" title="{"more than one day"|translate}"/>
	{/if}
   </td>
   <td class="row" width="65" {$smarty.capture.tooltipp}>{$TICKET.work_time} {"Minutes"|translate}</td>
  </tr>
  {/foreach}
</table>
<div class="toolbar"><b>{"My most pressing 5 Tickets"|translate}</b></div>
<table cellspacing="0" cellpadding="0" width="100%">
  {foreach item=TICKET from=$xt8100_admin.my_tickets}
{capture name=tooltipp}
 onmouseover="Tip('<div class=&quot;TipCls1&quot;><b>{$TICKET.title|htmlentities}</b><br/>{"To do until"|translate}: <i>{$TICKET.date|date_format:"%d.%m.%Y %H:%M"}</i><br/><br/>{$TICKET.description|htmlentities}</div>',BORDERWIDTH, '',BORDERWIDTH, '',BGCOLOR, '',PADDING,'')" onmouseout="UnTip()"
{/capture}
  <tr class="{cycle values="row_a,row_b"}" ondblclick="window.parent.frames['slave1'].document.forms['0'].x{$BASEID}_id.value='{$TICKET.id}';window.parent.frames['slave1'].document.forms['0'].x{$BASEID}_action.value='edit';window.parent.frames['slave1'].focus();window.parent.frames['slave1'].document.forms['0'].submit();">
   <td class="button" width="80">
   {if $TICKET.status == 0}<img src="images/icons/tickets/open.png" alt="{"status_0"|translate}" title="{"status_0"|translate}"/>{/if}
   {if $TICKET.status == 1}<img src="images/icons/tickets/running.png" alt="{"status_1"|translate}" title="{"status_1"|translate}"/>{/if}
   {if $TICKET.status == 2}<img src="images/icons/tickets/onhold.png" alt="{"status_2"|translate}" title="{"status_2"|translate}"/>{/if}
   {if $TICKET.status == 4}<img src="images/icons/tickets/stopped.png" alt="{"status_4"|translate}" title="{"status_4"|translate}"/>{/if}
   {if $TICKET.status == 3}<img src="images/icons/tickets/rejected.png" alt="{"status_3"|translate}" title="{"status_3"|translate}"/>{/if}
   {if $TICKET.status == 5}<img src="images/icons/tickets/done.png" alt="{"status_5"|translate}" title="{"status_5"|translate}"/>{/if}
   <img src="images/icons/tickets/priority_{$TICKET.priority}.png" alt="{"Priority"|translate}: {$TICKET.priority}" title="{"Priority"|translate}: {$TICKET.priority}"/>
   {actionIcon
           action="edit"
           icon="view.png"
           form=0
           target="slave1"
           id=$TICKET.id
           title="Edit / view ticket"
       }
   </td>
   <td class="row" width="45" {$smarty.capture.tooltipp}>{$TICKET.id}</td>
   <td class="row" {$smarty.capture.tooltipp}>{$TICKET.title}</td>
   <td class="row" width="20" {$smarty.capture.tooltipp}>
	{math equation="x - y" x=$TICKET.date y=$smarty.now assign="TIMEDIFF"}
	{if $TIMEDIFF <= 0}
	<img src="images/icons/tickets/due.png" alt="{"due"|translate}" title="{"due"|translate}"/>
	{elseif $TIMEDIFF < 21600}
	<img src="images/icons/tickets/6h.png" alt="{"6h"|translate}" title="{"6h"|translate}"/>
	{elseif $TIMEDIFF < 86400}
	<img src="images/icons/tickets/24h.png" alt="{"24h"|translate}" title="{"24h"|translate}"/>
	{else}
	<img src="images/icons/tickets/morethan1day.png" alt="{"more than one day"|translate}" title="{"more than one day"|translate}"/>
	{/if}
   </td>
   <td class="row" width="65" {$smarty.capture.tooltipp}>{$TICKET.work_time} {"Minutes"|translate}</td>
  </tr>
  {/foreach}
</table>
<div class="toolbar"><b>{"My done 5 Tickets"|translate}</b></div>
<table cellspacing="0" cellpadding="0" width="100%">
  {foreach item=TICKET from=$xt8100_admin.my_old_tickets}
{capture name=tooltipp}
 onmouseover="Tip('<div class=&quot;TipCls1&quot;><b>{$TICKET.title|htmlentities}</b><br/>{"To do until"|translate}: <i>{$TICKET.date|date_format:"%d.%m.%Y %H:%M"}</i><br/><br/>{$TICKET.description|htmlentities}</div>',BORDERWIDTH, '',BORDERWIDTH, '',BGCOLOR, '',PADDING,'')" onmouseout="UnTip()"
{/capture}
  <tr class="{cycle values="row_a,row_b"}" ondblclick="window.parent.frames['slave1'].document.forms['0'].x{$BASEID}_id.value='{$TICKET.id}';window.parent.frames['slave1'].document.forms['0'].x{$BASEID}_action.value='edit';window.parent.frames['slave1'].focus();window.parent.frames['slave1'].document.forms['0'].submit();">
   <td class="button" width="80">
   {if $TICKET.status == 0}<img src="images/icons/tickets/open.png" alt="{"status_0"|translate}" title="{"status_0"|translate}"/>{/if}
   {if $TICKET.status == 1}<img src="images/icons/tickets/running.png" alt="{"status_1"|translate}" title="{"status_1"|translate}"/>{/if}
   {if $TICKET.status == 2}<img src="images/icons/tickets/onhold.png" alt="{"status_2"|translate}" title="{"status_2"|translate}"/>{/if}
   {if $TICKET.status == 4}<img src="images/icons/tickets/stopped.png" alt="{"status_4"|translate}" title="{"status_4"|translate}"/>{/if}
   {if $TICKET.status == 3}<img src="images/icons/tickets/rejected.png" alt="{"status_3"|translate}" title="{"status_3"|translate}"/>{/if}
   {if $TICKET.status == 5}<img src="images/icons/tickets/done.png" alt="{"status_5"|translate}" title="{"status_5"|translate}"/>{/if}
   <img src="images/icons/tickets/priority_{$TICKET.priority}.png" alt="{"Priority"|translate}: {$TICKET.priority}" title="{"Priority"|translate}: {$TICKET.priority}"/>
   {actionIcon
           action="edit"
           icon="view.png"
           form=0
           target="slave1"
           id=$TICKET.id
           title="Edit / view ticket"
       }
    {if $TICKET.status == 4 && $TICKET.supervisor == $xt8100_admin.my_userid}
    {actionIcon
           action="deleteTicket"
           icon="delete.png"
           form=1
           target="master"
           id=$TICKET.id
           ask="Are you sure to delete this ticket?"
    }
   {/if}
   </td>
   <td class="row" width="45" {$smarty.capture.tooltipp}>{$TICKET.id}</td>
   <td class="row" {$smarty.capture.tooltipp}>{$TICKET.title}</td>
   <td class="row" width="20" {$smarty.capture.tooltipp}>
	{math equation="x - y" x=$TICKET.date y=$smarty.now assign="TIMEDIFF"}
	{if $TIMEDIFF <= 0}
	<img src="images/icons/tickets/due.png" alt="{"due"|translate}" title="{"due"|translate}"/>
	{elseif $TIMEDIFF < 21600}
	<img src="images/icons/tickets/6h.png" alt="{"6h"|translate}" title="{"6h"|translate}"/>
	{elseif $TIMEDIFF < 86400}
	<img src="images/icons/tickets/24h.png" alt="{"24h"|translate}" title="{"24h"|translate}"/>
	{else}
	<img src="images/icons/tickets/morethan1day.png" alt="{"more than one day"|translate}" title="{"more than one day"|translate}"/>
	{/if}
   </td>
   <td class="row" width="65" {$smarty.capture.tooltipp}>{$TICKET.work_time} {"Minutes"|translate}</td>
  </tr>
  {/foreach}
</table>
<input type="hidden" name="x{$BASEID}_id" value="" />
<input type="hidden" name="module" value="{$smarty.request.module}" />
<input type="hidden" name="showtabs" value="1" />
</form>