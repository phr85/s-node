
<div class="interface1">
<b>{$DIPLAYDATE.0|date_format}</b> -
<b>{$DIPLAYDATE.1|date_format}</b>
<table border="0" cellpadding="0" cellspacing="0">
 <tr>
 <td class="listlabel">{$LABEL}</td>
  {foreach from=$WEEK item=wday}
    <td class="listlabel">{$TIMESHEMA.0.day[$wday.day].label}</td>
  {/foreach}
 </tr>

{foreach from=$TIMESHEMA item=timerow}
 <tr>
 <td class="vertlabel{if $timerow.actual_block==1} actual_block{/if}">{$timerow.date|date_format:"%H:%M"} - {$timerow.date+$BLOCKSIZE|date_format:"%H:%M"}</td>
 {foreach from=$timerow.day item=rooms key=room_id}
 <td class="{if $rooms.booked==0}freeroom{else}bookedroom{/if}{if $timerow.actual_block==1} actual_block{/if}{if $rooms.data.creation_user == $USER_ID && $USER_ID!=0} own_block{/if}">
 {if $rooms.booked==0 && "useRBSLivePart"|permcheck}<a href="javascript:popup('index.php?TPL={"create_tpl"|getConfigValue}&amp;x{$BASEID}_starttime={$rooms.date}&amp;x{$BASEID}_room_id={$ROOMID}&amp;x{$BASEID}_opener={$NAME}',300,200,'create');" class="additem" >&nbsp;</a>{else}
    {if $rooms.data.creation_user == $USER_ID && $rooms.data.comment!=""}
 <span title="{$rooms.data.comment}"><img src="/images/icons/orange.png" alt="" /></span>{else}&nbsp;{/if}
  {/if}
 </td>
 {/foreach}
 </tr>
 {/foreach}
</table>
</div>