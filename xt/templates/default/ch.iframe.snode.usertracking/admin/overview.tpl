<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="table_header">{"Username"|translate}</td>
  <td class="table_header">{"Last action"|translate}</td>
 </tr>
 {foreach from=$TRACKINGS item=ENTRY}
  <tr>
   <td class="left">{$ENTRY.username}</td>
   <td class="right">{$ENTRY.c_time|date_format:"%d.%m.%Y %H:%M:%S"}</td>
  </tr>
 {/foreach}
</table>
<br />
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="table_header">{"Address"|translate}</td>
  <td class="table_header">{"Last action"|translate}</td>
 </tr>
 {foreach from=$TRACKINGS_ANON item=ENTRY}
  <tr>
   <td class="left">{$ENTRY.addr}</td>
   <td class="right">{$ENTRY.call_time|date_format:"%d.%m.%Y %H:%M:%S"}</td>
  </tr>
 {/foreach}
</table>