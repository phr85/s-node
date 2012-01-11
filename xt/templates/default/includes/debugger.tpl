<div style="position:absolute; bottom: 95px; right: 10px; background-color: #D0D4DA; padding: 4px 8px 5px 8px; cursor: hand; cursor: pointer;" onclick="document.getElementById('debugger').style.visibility='visible';document.getElementById('debugger').style.display='inline'">
{"Debugger"|translate}
</div>
<div id="debugger" style="background-color:#FFFF99; position:absolute; top: 125px; right: 10px; display:none; visibility: hidden; margin-bottom: 10px;">
 <table cellpadding="0" cellspacing="0" width="600" style="border: 1px solid black;">
  <tr><td class="table_header" style="background-image: url({$XT_IMAGES}admin/title_gradient.gif);" colspan="2">GET</td></tr>
  {foreach from=$smarty.get key=SESSION_VAR_KEY item=SESSION_VAR}
  <tr>
   <td class="left" valign="top">{$SESSION_VAR_KEY}</td>
   {if is_array($SESSION_VAR)}
    <td>
     <table cellpadding="0" cellspacing="0" width="100%">
      {foreach from=$SESSION_VAR key=PART_KEY item=VAR_PART}
      <tr><td class="right" style="width: 50%;">{$PART_KEY}</td><td class="right" style="width: 50%;">{$VAR_PART}&nbsp;</td></tr>
      {/foreach}
     </table>
    </td>
   {else}
   <td class="right">{$SESSION_VAR}</td>
   {/if}
  </tr>
  {/foreach}
  <tr><td class="table_header" style="background-image: url({$XT_IMAGES}admin/title_gradient.gif);" colspan="2">POST</td></tr>
  {foreach from=$smarty.post key=SESSION_VAR_KEY item=SESSION_VAR}
  <tr>
   <td class="left" valign="top">{$SESSION_VAR_KEY}</td>
   {if is_array($SESSION_VAR)}
    <td>
     <table cellpadding="0" cellspacing="0" width="100%">
      {foreach from=$SESSION_VAR key=PART_KEY item=VAR_PART}
      <tr><td class="right" style="width: 50%;">{$PART_KEY}</td><td class="right" style="width: 50%;">{$VAR_PART}&nbsp;</td></tr>
      {/foreach}
     </table>
    </td>
   {else}
   <td class="right">{$SESSION_VAR}</td>
   {/if}
  </tr>
  {/foreach}
  <tr><td class="table_header" style="background-image: url({$XT_IMAGES}admin/title_gradient.gif);" colspan="2">SESSION</td></tr>
  {foreach from=$smarty.session key=SESSION_VAR_KEY item=SESSION_VAR}
  <tr>
   <td class="left" valign="top">{$SESSION_VAR_KEY}</td>
   {if is_array($SESSION_VAR)}
    <td>
     <table cellpadding="0" cellspacing="0" width="100%">
      {foreach from=$SESSION_VAR key=PART_KEY item=VAR_PART}
      <tr><td class="right" style="width: 50%;">{$PART_KEY}</td><td class="right" style="width: 50%;">{$VAR_PART}&nbsp;</td></tr>
      {/foreach}
     </table>
    </td>
   {else}
   <td class="right">{$SESSION_VAR}</td>
   {/if}
  </tr>
  {/foreach}
 </table>
 <br />
</div>