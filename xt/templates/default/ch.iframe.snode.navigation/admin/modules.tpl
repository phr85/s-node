<table cellspacing="0" cellpadding="0" width="100%" class="admin_table">
 {foreach from=$DATA key=KEY item=MODULE}
     <tr class="header"><td colspan="3" class="header">{$MODULE.name} ( ID: {$KEY} )</td></tr>
     <tr class="row">

      <td colspan="1" valign="top" width="280" class="screenshot" align="center">
       <img src="{$XT_IMAGES}screenshots/{$MODULE.screenshot}" alt="" style="margin: 5px; margin-right: 0px; border: 1px solid #CCCCCC;" /><br />
      </td>

      <td colspan="2" class="row" valign="top">
       {$MODULE.desc}
      </td>
     </tr>
    </table>
    <table cellpadding="0" cellspacing="0" width="100%" class="admin_table" style="border-top: 0px;">
     <tr class="header">
      <td class="header" width="125">{$LABEL_PARAMNAME}</td>
      <td class="header" width="130">{$LABEL_DEFAULT}</td>
      <td class="header">{$LABEL_DESC}</td>
     </tr>
     {foreach from=$MODULE.params key=PARAMNAME item=PARAM}
     <tr class="{cycle values="row_a,row_b"}">
      <td class="row" valign="top"><b>{$PARAMNAME}</b></td>
      <td class="row" valign="top">{$PARAM.default}</td>
      <td class="row" valign="top">{$PARAM.desc}</td>
     </tr>
     {/foreach}
 {/foreach}
</table>
