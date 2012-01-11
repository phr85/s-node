<!--das hier ist der master-->
<form method="post" name="o" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
{include file="includes/buttons.tpl" data=$OVERVIEW_BUTTONS}
{include file="includes/lang_selector_simple.tpl" form="o"}
<table cellpadding="0" cellspacing="0" width="100%">
 {foreach from=$NODES item=NODE}
 <tr class="{cycle values="row_a,row_b"}">
   <td>
    <table cellspacing="0" cellpadding="0" width="100%">
     <tr>
      {if $NODE.l != 1}
      	<td class="row" style="padding-left: {$NODE.level*20-32}px; width: 1px;">
      		{if $NODE.subs > 0 || $REPORTS[$NODE.id] > 0}
      			{if $NODE.itw}
      				<a href="javascript:document.forms['o'].x{$BASEID}_open.value={$NODE.pid};document.forms['o'].submit();">
      					<img src="{$XT_IMAGES}icons/minus.gif" alt="" />
      				</a>
      			{else}
      				<a href="javascript:document.forms['o'].x{$BASEID}_open.value={$NODE.id};document.forms['o'].submit();">
      					<img src="{$XT_IMAGES}icons/plus.gif" alt="" />
      				</a>
      			{/if}
      		{else}
      			<img src="{$XT_IMAGES}spacer.gif" width="9" />
      		{/if}
      	</td>
      {/if}
      <td class="row" style="padding: 5px; padding-right: 0px;width: 16px">
       <a href="javascript:window.parent.frames['master'].document.forms[1].x{$BASEID}_action.value='';window.parent.frames['master'].document.forms[1].x{$BASEID}_open.value={$NODE.id};window.parent.frames['master'].document.forms[1].submit();document.forms['o'].x{$BASEID}_open.value={$NODE.id};document.forms['o'].submit();">
       	{if $NODE.itw}
       		{if $NODE.subs > 0}
       			<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />
       		{else}
       			<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />
       		{/if}
       	{else}
       		{if $NODE.subs > 0}
       			<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="" />
       		{else}
       			<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="" />
       		{/if}
       	{/if}
       </a><br />
      </td>
      <td class="row">
      	<a href="javascript:window.parent.frames['master'].document.forms[1].x{$BASEID}_action.value='';window.parent.frames['master'].document.forms[1].x{$BASEID}_open.value={$NODE.id};window.parent.frames['master'].document.forms[1].submit();document.forms['o'].x{$BASEID}_open.value={$NODE.id};document.forms['o'].submit();">{if $NODE.itw}<span style="color: black;">{if $NODE.selected}<b>{$NODE.title}</b>{else}{$NODE.title}{/if}</span>{else}{$NODE.title}{/if}&nbsp;</a></td>
      <td class="button" align="right">
      {if $NODE.id > 1}
	      {if $CTRL}
		      {if $NODE.id != 1 && $CTRLENTRY == 0}
			      {actionIcon
			                action="insertNode"
			                icon="explorer/arrow_down_green.png"
			                form="0"
			                node_perm="add"
			                node_pid=$NODE.pid
			                node_id=$NODE.id
			                target="slave1"
			                position="after"
			                title="Insert after this node"
			       }
			       {actionIcon
			                action="insertNode"
			                icon="explorer/arrow_up_green.png"
			                form="0"
			                node_perm="add"
			                node_pid=$NODE.pid
			                node_id=$NODE.id
			                target="slave1"
			                position="before"
			                title="Insert before this category"
			        }
		        {/if}
		        {if $CTRLENTRY}
			        {actionIcon
			                action="insertNode"
			                icon="explorer/folder_into.png"
			                form="1"
			                node_perm="add"
			                node_pid=$NODE.pid
			                node_id=$NODE.id
			                target="master"
			                position="into"
			                title="Insert into this category"
			         }
		         {else}
		         	{actionIcon
			                action="insertNode"
			                icon="explorer/folder_into.png"
			                form="0"
			                node_perm="add"
			                node_pid=$NODE.pid
			                node_id=$NODE.id
			                target="slave1"
			                position="into"
			                title="Insert into this category"
			
			         }
		         {/if}
		         {else}
		         {actionIcon
		                action="editNode"
		                icon="pencil.png"
		                form="0"
		                target="slave1"
		                node_id=$NODE.id
		                node_pid=$NODE.pid
		                node_perm="edit"
		                title="Edit this category"
		
		          }
		          
		          {actionIcon
		                action="deleteNode"
		                icon="delete.png"
		                form="o"
		                node_id=$NODE.id
		                node_pid=$NODE.pid
		                node_perm="delete"
		                title="Delete this category"
		                ask="Are you sure you want to delete this category?"
		          }
		          {/if}
	      {else}
	          {$ICONSPACER}
          {/if}
      </td>
     </tr>
    </table>
   </td>
   {if $NODE.itw && $CTRL == 0}
  {foreach from=$REPORTS[$NODE.id] item=REPORT}
  <tr>
   <td>
    <table cellspacing="0" cellpadding="0" width="100%">
     <tr>
      <td class="row" style="padding-left: 40px; width: 1px;">
      {if $REPORT.time_end < $smarty.now}
      	<img src="{$XT_IMAGES}icons/alarmclock_stop.png" alt="" width="16" />
      {/if}
      {if $REPORT.time_end > $smarty.now}
      	<img src="{$XT_IMAGES}icons/alarmclock_run.png" alt="" width="16" />
      {/if}
      </td>
      <td class="row" style="padding: 5px 0px 5px 0px; padding-right: 0px;width: 1px;">&nbsp;</td>
      <td class="row">{$REPORT.id}&nbsp;&nbsp;{actionLink
            action="viewReport"
            form="0"
            target="slave1"
            id=$REPORT.id
            perm="edit"
            title="Show this report"
            text=$REPORT.title|truncate:45:"...":true
            }
            von: {$REPORT.time_start|date_format:"%d.%m.%Y"}&nbsp;-&nbsp;bis: {$REPORT.time_end|date_format:"%d.%m.%Y"}
       </td>
      <td class="button" width="120" align="right">
      {actionIcon
            action="viewReport"
            icon="document_chart.png"
            form="0"
            target="slave1"
            id=$REPORT.id
            title="Show this report"
       }
       {actionIcon
            action="exportReport"
            icon="download.png"
            form="0"
            target="slave1"
            id=$REPORT.id
            title="Export this report"
       }
       {actionIcon
            action="exportReport2"
            icon="filetypes/xls.gif"
            form="0"
            target="slave1"
            id=$REPORT.id
            title="Export this report"
       }
       {actionIcon
            action="deleteReport"
            icon="delete.png"
            form="o"
            id=$REPORT.id
            node_id=$NODE.id
            node_pid=$NODE.pid
            node_perm="delete"
            title="Delete this report"
            ask="Are you sure you want delete this report?"
       }</td>
     </tr>
    </table>
   </td>
  </tr>  
  {/foreach}
{/if}
 {/foreach}
</table>
{if $CTRL}{actionIcon
    action="insertNode"
    icon="explorer/folder_into.png"
    form="0"
    node_perm="managePermissions"
    node_pid=0
    node_id=1
    target="slave1"
    position="into"
    title="Insert into this node"
}{/if}
<input type="hidden" name="x{$BASEID}_id" value="" />
<input type="hidden" name="x{$BASEID}_poll_id" value="" />
<input type="hidden" name="x{$BASEID}_position" value="" />
<input type="hidden" name="x{$BASEID}_node_id" value="" />
<input type="hidden" name="x{$BASEID}_node_pid" value="" />
<input type="hidden" name="x{$BASEID}_open" value="" />
<input type="hidden" name="x{$BASEID}_source_node_id" value="" />
{yoffset}
</form>