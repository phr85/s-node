<form method="post" name="editBooking">
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header">
   <span class="title_light">{"Room"|translate}:</span> <span class="title">{$ROOM.title}</span><br />
   {"Display entries from"|translate} {$DATERANGE.0|date_format} - {$DATERANGE.1|date_format} <br />
   {"Entries in"|translate} {"week"|translate}:{$COUNTS.week}, {"month"|translate}:{$COUNTS.month}, {"year"|translate}:{$COUNTS.year}
  </td>
 </tr>
 <tr>
  <td class="view_separator"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$BUTTONS withouthidden=1}
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td class="date_title" style="width:15%;">{"Mo"|translate}</td>
        <td class="date_title" style="width:15%;">{"Tu"|translate}</td>
        <td class="date_title" style="width:15%;">{"We"|translate}</td>
        <td class="date_title" style="width:15%;">{"Th"|translate}</td>
        <td class="date_title" style="width:15%;">{"Fr"|translate}</td>
        <td class="date_title" style="width:13%;">{"Sa"|translate}</td>
        <td class="date_title" style="width:12%;">{"Su"|translate}</td>
    </tr>
    {foreach from=$DAYS item=DAY}
    <tr style="height:110px;">
        {foreach from=$DAY item=day name=d}
        <td style="{if $SELECTED_DAY == $day}background-color: yellow;{/if} font-size:10px; vertical-align:top;text-align:left;" class="date_box{if $smarty.foreach.d.iteration > 5}_marked{/if}">
        <div style="background-color:#EFEFEF;">{if $day == ""}&nbsp;{else}{$day}{/if}</div>
        {foreach from=$BOOKINGS[$day] item=ENTRY}
            {$ENTRY.date_from|date_format:"%H:%M"} {actionLink
            action="editBooking"
            form="0"
            target="slave1"
            id=$ENTRY.id
            room_id=$ENTRY.room_id
            perm="edit"
            title=$ENTRY.title
            text=$ENTRY.title|truncate:17:"."
            }<br />
        {/foreach}
        </td>
        {/foreach}
    </tr>
    {/foreach}
</table>
<input type="hidden" name="autorefresh" value="true" />
{include file="ch.iframe.snode.roombooking/admin/hiddenValues.tpl"}
</form>