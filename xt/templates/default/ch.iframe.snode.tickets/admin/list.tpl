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
<form method="POST" name="list"  action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
{include file="includes/buttons.tpl" data=$BUTTONS withouthidden="true"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="row">{"Client"|translate}:</td>
  <td class="row">
   <select name="x{$BASEID}_client_filter" onChange="this.form.submit();">
    <option value="0" {if $xt8100_admin.client_filter < 1}selected{/if}>{"all"|translate}</option>
    {foreach from=$xt8100_admin.all_clients item=ALL_CLIENTS}
    {xt_getaddresses assign="CLIENT" id=$ALL_CLIENTS}
    {if $ALL_CLIENTS > 0 AND $CLIENT.title != ""}
    <option value="{$ALL_CLIENTS}" {if $xt8100_admin.client_filter == $ALL_CLIENTS}selected{/if}>{$CLIENT.title}</option>
    {/if}
    {/foreach}
   </select>
  </td>
 </tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%">
{capture name=header}
  <tr>
   <td class="table_header" width="65">&nbsp;</td>
   <td class="table_header" width="25" onclick="document.forms['list'].x{$BASEID}_order_by.value='id';document.forms['list'].x{$BASEID}_order_by_dir.value='{if $xt8100_admin.order_by_dir == 'ASC'}DESC{else}ASC{/if}';document.forms['list'].submit();">{"ID"|translate}{if $xt8100_admin.order_by == 'id'}<img src="{$XT_IMAGES}admin/header_arrow_{if $xt8100_admin.order_by_dir == 'DESC'}down{else}up{/if}.gif" alt=""/>{/if}</td>
   <td class="table_header" onclick="document.forms['list'].x{$BASEID}_order_by.value='title';document.forms['list'].x{$BASEID}_order_by_dir.value='{if $xt8100_admin.order_by_dir == 'ASC'}DESC{else}ASC{/if}';document.forms['list'].submit();">{"Title"|translate}{if $xt8100_admin.order_by == 'title'}<img src="{$XT_IMAGES}admin/header_arrow_{if $xt8100_admin.order_by_dir == 'DESC'}down{else}up{/if}.gif" alt=""/>{/if}</td>
   <td class="table_header" width="85" onclick="document.forms['list'].x{$BASEID}_order_by.value='client_id';document.forms['list'].x{$BASEID}_order_by_dir.value='{if $xt8100_admin.order_by_dir == 'ASC'}DESC{else}ASC{/if}';document.forms['list'].submit();">{"Client"|translate}{if $xt8100_admin.order_by == 'client_id'}<img src="{$XT_IMAGES}admin/header_arrow_{if $xt8100_admin.order_by_dir == 'DESC'}down{else}up{/if}.gif" alt=""/>{/if}</td>
   <td class="table_header" width="85" onclick="document.forms['list'].x{$BASEID}_order_by.value='date';document.forms['list'].x{$BASEID}_order_by_dir.value='{if $xt8100_admin.order_by_dir == 'ASC'}DESC{else}ASC{/if}';document.forms['list'].submit();">{"Time"|translate}{if $xt8100_admin.order_by == 'date'}<img src="{$XT_IMAGES}admin/header_arrow_{if $xt8100_admin.order_by_dir == 'DESC'}down{else}up{/if}.gif" alt=""/>{/if}</td>
   <td class="table_header" width="65">{"Effort"|translate}</td>
  </tr>
{/capture}
{$smarty.capture.header}
  {foreach item=TICKET from=$xt8100_admin.data_worker}
{capture name=tooltipp}
{xt_getaddresses assign="CLIENT" id=$TICKET.client_id}
 onmouseover="Tip('<div class=&quot;TipCls1&quot;><b>{$TICKET.title|htmlentities}</b><br/>{"To do until"|translate}: <i>{$TICKET.date|date_format:"%d.%m.%Y %H:%M"}</i><br/><br/> <i>{$CLIENT.title|default:""} {if $CLIENT.user_id > 0}({$CLIENT.user_id|xt_getUserProperties:"username"}){/if}<br/>{$CLIENT.firstName|default:""} {$CLIENT.lastName}<br/>{if $CLIENT.email != ""}<a href=&quot;mailto:{$CLIENT.email}&quot;>{$CLIENT.email}</a>{/if}</i> <br/><br/>{$TICKET.description|htmlentities}</div>',BORDERWIDTH, '',BORDERWIDTH, '',BGCOLOR, '',PADDING,'')" onmouseout="UnTip()"
{/capture}
  <tr class="{cycle values="row_a,row_b"}" ondblclick="window.parent.frames['slave1'].document.forms['0'].x{$BASEID}_id.value='{$TICKET.id}';window.parent.frames['slave1'].document.forms['0'].x{$BASEID}_action.value='edit';window.parent.frames['slave1'].focus();window.parent.frames['slave1'].document.forms['0'].submit();">
   <td class="button">
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
   <td class="row" {$smarty.capture.tooltipp}>{$TICKET.id}</td>
   <td class="row" {$smarty.capture.tooltipp}>{$TICKET.title}</td>
   <td class="row" {$smarty.capture.tooltipp}>{$CLIENT.title|default:""} {if $CLIENT.user_id > 0}({$CLIENT.user_id|xt_getUserProperties:"username"}){/if}</td>
   <td class="row" {$smarty.capture.tooltipp}>
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
	{$TICKET.date|date_format:"%d.%m.%y"}
   </td>
   <td class="row" {$smarty.capture.tooltipp}>{$TICKET.work_time} {"Minutes"|translate}</td>
  </tr>
  {/foreach}
</table>
{if $xt8100_admin.data_supervisor|@count>0}
<div class="toolbar"><b>{"Supervisor Tickets"|translate}</b></div>
<table cellspacing="0" cellpadding="0" width="100%">
 {$smarty.capture.header}
  {foreach item=TICKET from=$xt8100_admin.data_supervisor}
{capture name=tooltipp}
{xt_getaddresses assign="CLIENT" id=$TICKET.client_id}
 onmouseover="Tip('<div class=&quot;TipCls1&quot;><b>{$TICKET.title|htmlentities}</b><br/>{"To do until"|translate}: <i>{$TICKET.date|date_format:"%d.%m.%Y %H:%M"}</i><br/><br/> <i>{$CLIENT.title|default:""} {if $CLIENT.user_id > 0}({$CLIENT.user_id|xt_getUserProperties:"username"}){/if}<br/>{$CLIENT.firstName|default:""} {$CLIENT.lastName}<br/>{if $CLIENT.email != ""}<a href=&quot;mailto:{$CLIENT.email}&quot;>{$CLIENT.email}</a>{/if}</i> <br/><br/>{$TICKET.description|htmlentities}</div>',BORDERWIDTH, '',BORDERWIDTH, '',BGCOLOR, '',PADDING,'')" onmouseout="UnTip()"
{/capture}
  <tr class="{cycle values="row_a,row_b"}" ondblclick="window.parent.frames['slave1'].document.forms['0'].x{$BASEID}_id.value='{$TICKET.id}';window.parent.frames['slave1'].document.forms['0'].x{$BASEID}_action.value='edit';window.parent.frames['slave1'].focus();window.parent.frames['slave1'].document.forms['0'].submit();">
   <td class="button">
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
   <td class="row" {$smarty.capture.tooltipp}>{$TICKET.id}</td>
   <td class="row" {$smarty.capture.tooltipp}>{$TICKET.title}</td>
   <td class="row" {$smarty.capture.tooltipp}>{$CLIENT.title|default:""} {if $CLIENT.user_id > 0}({$CLIENT.user_id|xt_getUserProperties:"username"}){/if}</td>
   <td class="row" {$smarty.capture.tooltipp}>
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
	{$TICKET.date|date_format:"%d.%m.%y"}
   </td>
   <td class="row" {$smarty.capture.tooltipp}>{$TICKET.work_time} {"Minutes"|translate}</td>
  </tr>
  {/foreach}
</table>
{/if}
 {include file="includes/navigator.tpl" form="list"}
 <input type="hidden" name="x{$BASEID}_id" value="" />
 <input type="hidden" name="x{$BASEID}_order_by" value="{$xt8100_admin.order_by}" />
 <input type="hidden" name="x{$BASEID}_order_by_dir" value="{$xt8100_admin.order_by_dir}" />
 <input type="hidden" name="x{$BASEID}_action" value="" />
 <input type="hidden" name="module" value="{$smarty.request.module}" />
<input type="hidden" name="showtabs" value="1" />