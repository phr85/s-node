<form method="post">
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Accounting"|translate}</span>
  </td>
 </tr>
   <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"Start date"|translate} (d.m.y)</td>
  <td class="right"><input type="text" name="x{$BASEID}_startdate_str" id="x{$BASEID}_startdate_str" value="{$xt8100_admin.startdate}" size="12" />
    {include file="includes/widgets/datepicker.tpl" relative="startdate_str"}
  </td>
</tr>
 <tr>
  <td class="left">{"End date"|translate} (d.m.y)</td>
  <td class="right"><input type="text" name="x{$BASEID}_enddate_str" id="x{$BASEID}_enddate_str" value="{$xt8100_admin.enddate}" size="12" />
    {include file="includes/widgets/datepicker.tpl" relative="enddate_str"}
  </td>
</tr>
 <tr>
  <td class="left">{"Ignore accounted"|translate}</td>
  <td class="right"><input type="checkbox" name="x{$BASEID}_ignore_accounted"  /> {"Ignore accounted still accounted efforts"|translate}
  </td>
</tr>
 <tr>
  <td class="left">{"Mark as accounted"|translate}</td>
  <td class="right"><input type="checkbox" name="x{$BASEID}_mark_accounted" checked="checked" /> {"Mark exported efforts as accounted"|translate}
  </td>
</tr>
 </table>