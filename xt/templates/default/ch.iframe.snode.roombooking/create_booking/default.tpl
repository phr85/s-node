{if !$DATECOLLISION}
<h2 title="room {$ROOMID}">Create booking</h2>
{else}
<h2 class="collision" title="room {$ROOMID}">{"error:room already booked"|translate}</h2>
{/if}
<div style="float:left;width:303px;">
<form method="post" name="createBooking">
<table cellspacing="0" cellpadding="2" width="300" border="0">
 <tr>
  <td valign="top">{"Title"|translate}</td>
  <td><input type="text" name="x{$BASEID}_title" size="32" value="{$TITLE|htmlspecialchars}"></td>
 </tr>
 <tr>
  <td valign="top">{"Comment"|translate}</td>
  <td>
  <textarea id="x{$BASEID}_description" name="x{$BASEID}_comment" rows="2" cols="25">{$COMMENT}</textarea></td>
 </tr>

<tr>
<td valign="top">{"From"|translate}</td>
<td>{"Hour"|translate}
   <select name="x{$BASEID}_hstart" class="default">
{foreach from=$TIME.shour key=HOUR item=SHOUR}
   <option value="{$HOUR}" {if $SHOUR}selected="selected"{/if}>{$HOUR}</option>
{/foreach}
   </select>&nbsp;

   {"Minute"|translate}
   <select name="x{$BASEID}_mstart" class="default">
   {foreach from=$TIME.smin key=MIN item=SMIN}
    <option value="{$MIN}" {if $SMIN}selected="selected"{/if}>{$MIN}</option>
   {/foreach}
   </select>
   </td>
</tr>
<tr>
<td valign="top">{"To"|translate}</td>
  <td>{"Hour"|translate}
   <select name="x{$BASEID}_hend" class="default">
   {foreach from=$TIME.ehour key=HOUR item=EHOUR}
   <option value="{$HOUR}" {if $EHOUR}selected="selected"{/if}>{$HOUR}</option>
   {/foreach}
   </select>&nbsp;
   {"Minute"|translate}
   <select name="x{$BASEID}_mend" class="default">
 {foreach from=$TIME.emin key=MIN item=EMIN}
    <option value="{$MIN}" {if $EMIN}selected="selected"{/if}>{$MIN}</option>
   {/foreach}
   </select>

 </td>
 </tr>
 <tr>
 <td valign="top">{"Date"|translate}</td>
 <td>
<input type="hidden" name="x{$BASEID}_action" value="" />
<input type="text" name="x{$BASEID}_day" size="2" value="{$day}" />
<input type="text" name="x{$BASEID}_month" size="2" value="{$month}" />
<input type="text" name="x{$BASEID}_year" size="4" value="{$year}" />
    </td>
 </tr>
 <tr>
 <td colspan="2" valign="top">
 {actionIcon
action="createBooking"
icon="check.png"
title="createBooking"
label="createBooking"
form="createBooking"}
&nbsp;
{actionIcon
action="goToToday"
icon="star_yellow.png"
title="go to today"
label="go to today"
form="createBooking"}</td>
 <td>
 </tr>

</table>

</form>
</div>
<div style="float:left;">
{ajax package="ch.iframe.snode.roombooking" module="datepicker" name="picker1" style="create_booking.tpl" rooms=$ROOMID}
{literal}
<script type="text/javascript" language="javascript">
function updateMeDate(){

    document.forms['createBooking'].x{/literal}{$BASEID}{literal}_day.value= document.forms['dppicker1'].x{/literal}{$BASEID}{literal}_day.value;
    document.forms['createBooking'].x{/literal}{$BASEID}{literal}_month.value= document.forms['dppicker1'].x{/literal}{$BASEID}{literal}_month.value;
    document.forms['createBooking'].x{/literal}{$BASEID}{literal}_year.value= document.forms['dppicker1'].x{/literal}{$BASEID}{literal}_year.value;


    document.forms['dppicker1'].submit();
}
{/literal}
{if $booking_added}
window.opener.location.reload();
window.close();
{/if}
</script>


</div>