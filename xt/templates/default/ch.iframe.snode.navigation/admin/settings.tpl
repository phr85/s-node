<table cellspacing="0" cellpadding="0" width="100%" class="admin_table" style="margin-bottom: 6px;">
 <tr class="header"><td colspan="3" class="header">{$LABEL_TABLES}</td></tr>
 {foreach from=$TABLES item=TABLE}
 <tr class="{cycle values="row_a,row_b"}">
  <td class="row" width="16"><img src="images/icons/data_table.png" alt="" /><br /></td>
  <td class="row" width="230">{$TABLE.name}</td>
  <td class="row">{$TABLE.desc}</td>
 </tr>
 {/foreach}
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="admin_table" style="margin-bottom: 6px;">
 <tr class="header"><td colspan="4" class="header">{$LABEL_CONFIG}</td></tr>
 {foreach from=$CONFIG key=KEY item=VALUE}
 <tr class="{cycle values="row_a,row_b"}">
  <td class="row" width="16"><img src="images/icons/nut_and_bolt.png" alt="" /><br /></td>
  <td class="row" width="235">{$KEY}</td>
  <td width="200"><input type="text" value="{$VALUE.value}" name="config_{$KEY}" size="30"></td>
  <td class="row">{$VALUE.desc}</td>
 </tr>
 {/foreach}
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="admin_table" style="margin-bottom: 6px;">
 <tr class="header"><td colspan="4" class="header">{$LABEL_TRANSLATIONS}</td></tr>
 {foreach from=$TRANSLATIONS key=KEY item=VALUE}
 <tr class="{cycle values="row_a,row_b"}">
  <td class="row" width="16"><img src="images/icons/earth.png" alt="" /><br /></td>
  <td class="row" width="235">{$KEY}</td>
  <td><input type="text" value="{$VALUE}" name="trans_{$KEY}" size="50"></td>
 </tr>
 {/foreach}
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="admin_table">
 <tr class="header"><td colspan="4" class="header">{$LABEL_ACTIONS}</td></tr>
 {foreach from=$ACTIONS key=KEY item=VALUE}
 <!--
 <tr class="{cycle values="row_a,row_b"}">
  <td class="row" width="16"><img src="images/icons/box.png" alt="" /><br /></td>
  <td class="row" colspan="2"><b>{$KEY}</b></td>
 </tr>
 -->
 {foreach from=$VALUE key=KEY item=DESC}
 <tr class="{cycle values="row_a,row_b"}">
  <td class="row" width="16"><br /></td>
  <td class="row" width="230">{$KEY}</td>
  <td class="row">{$DESC}</td>
 </tr>
 {/foreach}
 {/foreach}
</table>
