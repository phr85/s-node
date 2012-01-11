<form method="post" name="editBooking">
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header">
   <span class="title_light">{"Room"|translate}:</span> <span class="title">{$ROOM.title}</span><br />
   {"Display entries from"|translate} {$DATERANGE.0|date_format:"%d.%m.%Y %H:%M"} - {$DATERANGE.1|date_format:"%d.%m.%Y %H:%M"} <br />
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
    <tr style="height:110px;">
    {foreach from=$DAYS  key=day item=date}
    <td class="date_box{if $day > 4}_marked{/if}" style="vertical-align:top; text-align:left; padding-left:1px; {if $day == $SELECTED_DAY}background-color:yellow;{/if}">
    {$date|date_format}<br /><br />

        {foreach from=$BOOKINGS[$day] item=ENTRY}
        <div style="position:relative; margin-bottom:4px; font-size:10px; border-top:1px solid #777777; min-height:{$ENTRY.duration/120}px; background-color:#CDCDCD; padding-left:1px; color:#000000;">
        <div style="background-color:#FAFAFA;">{$ENTRY.date_from|date_format:"%H:%M"}</div>
            {actionLink
            action="editBooking"
            form="0"
            target="slave1"
            id=$ENTRY.id
            room_id=$ENTRY.room_id
            perm="edit"
            text=$ENTRY.title
            }<br />
            {$ENTRY.comment|default:"no comment"}<br />
            <a href="mailto:{$ENTRY.email}">{$ENTRY.username}</a><br />
            <br />
            <div style="position:absolute; bottom:0px;background-color:#888888; color:#FFFFFF; width:100%;">
             {$ENTRY.date_to|date_format:"%H:%M"}
            </div>
         </div>
        {/foreach}
        </td>
    {/foreach}
    </tr>
 </table>

<input type="hidden" name="autorefresh" value="true" />
{include file="ch.iframe.snode.roombooking/admin/hiddenValues.tpl"}
</form>