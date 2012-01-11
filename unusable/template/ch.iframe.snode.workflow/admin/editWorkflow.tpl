<form method="POST" name="editform">
{include file="includes/buttons.tpl" data=$CREATE_BUTTONS}
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="table_header" colspan="2">{"Create a new workflow"|translate}</td>
 </tr>
 <tr>
  <td class="left">{"Title"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_title" size="42" value="{$WORKFLOW.title}"></td>
 </tr>
 <tr>
  <td class="left">{"Workflow description"|translate}</td>
  <td class="right"><textarea name="x{$BASEID}_description" cols="50" rows="4">{$WORKFLOW.description}</textarea></td>
 </tr>
</table>
<br>
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="table_header" colspan="2">{"Alerting"|translate}</td>
 </tr>
 <tr>
  <td class="left">{"Maximum run time"|translate}</td>
  <td class="right">
   <input type="text" size="4" name="x{$BASEID}_max_duration" disabled>
   <select name="x{$BASEID}_max_duration_mode" disabled>
    <option value="3600" {if $DATA.max_duration_mode == 3600}selected{/if}>{"Hours"|translate}</option>
    <option value="86400" {if $DATA.max_duration_mode == 86400}selected{/if}>{"Days"|translate}</option>
    <option value="2592000" {if $DATA.max_duration_mode == 2592000}selected{/if}>{"Month"|translate}</option>
    <option value="31536000" {if $DATA.max_duration_mode == 31536000}selected{/if}>{"Years"|translate}</option>
   </select>
  </td>
 </tr>
</table>
<br>
{include file="includes/buttons.tpl" data=$ADD_ELEMENTS withouthidden=1}
{foreach from=$PHASES item=PHASE}
<img src="{$XT_IMAGES}icons/arrow_down_blue.png" alt="" style="margin: 10px;">
<table cellspacing="0" cellpadding="0">
 <tr>
  <td style="width: 120px; padding: 5px; border: 2px solid #DDDDDD; background-color: #DDDDDD;">{$PHASE.title}</td>
  <td style="padding-left: 8px;"><a href="javascript:ask('Are you sure to delete this phase with all her steps ?','{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_action=deletePhase&x{$BASEID}_phase_id={$PHASE.phase_id}');"><img src="{$XT_IMAGES}icons/delete.png" title="{'Delete this phase'|translate}" alt="{'Delete this phase'|translate}"></a></td>
 </tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" style="padding: 10px; border: 2px solid #DDDDDD; background-color: #EEEEEE; margin-bottom: 10px; ">
 <tr>
  <td>
 {foreach from=$STEPS[$PHASE.phase_id] item=STEP}
 <table cellspacing="0" cellpadding="0" style="width: 180px; border: 2px solid #ACB7C4; background-color: #EEEEEE; margin-right: 10px;" align="left">
   <tr><td colspan="2" style="color: white; background-image: url({$XT_IMAGES}admin/title_gradient.gif); padding: 5px; border-bottom: 1px solid #ACB7C4">{$STEP.title|truncate:25:"...":true}</td></tr>
   {if sizeof($MEMBERS[$STEP.id]) > 0}
       {foreach from=$MEMBERS[$STEP.id] item=MEMBER}
       <tr>
        <td style="padding: 3px; width: 16px; border-top: 1px solid #DDDDDD;"><img src="{$XT_IMAGES}icons/member{$MEMBER.executer_mode}.png"></td>
        <td style="padding: 5px; border-top: 1px solid #DDDDDD;">{$MEMBER.title}</td>
       </tr>
       {/foreach}
   {else}
       <tr>
        <td style="padding: 3px; width: 16px; border-top: 1px solid #DDDDDD;" valign="top"><img src="{$XT_IMAGES}icons/warning.png"></td>
        <td style="padding: 5px; border-top: 1px solid #DDDDDD;">{"No executioners defined"|translate}</td>
       </tr>
   {/if}
   <tr>
    <td colspan="2" style="padding: 5px; border-top: 1px solid #DDDDDD;"><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_action=editStep&x{$BASEID}_step_id={$STEP.id}"><img src="{$XT_IMAGES}icons/pencil.png" alt="{'Edit this step'|translate}" title="{'Edit this step'|translate}" class="icon"></a><a href="javascript:ask('Are you sure to delete this step ?','{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_action=deleteStep&x{$BASEID}_step_id={$STEP.id}');"><img src="{$XT_IMAGES}icons/delete.png" alt="{'Delete this step'|translate}" title="{'Delete this step'|translate}"></a></td>
   </tr>
 </table>
 {/foreach}
  </td>
 </tr>
</table>
{/foreach}
<input type="hidden" name="module" value="e">
<input type="hidden" name="x{$BASEID}_phase_id" value="">
</form>
