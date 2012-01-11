<form method="POST">
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr class="row_a">
  <td class="row"><textarea name="x{$BASEID}_tpl_content" style="width: 100%" rows="30">{$TPL_CONTENT}</textarea></td>
 </tr>
</table>
<input type="hidden" name="x{$BASEID}_tpl_file" value="{$TPL_FILE}" />
<input type="hidden" name="x{$BASEID}_node_id" value="{$NODE_ID}" />
<input type="hidden" name="x{$BASEID}_lang" value="{$ACTIVE_LANG}" />
<input type="hidden" name="x{$BASEID}_node_pid" />
<input type="hidden" name="x{$BASEID}_node_perm_pid" />
<input type="hidden" name="x{$BASEID}_node_perm_id" />
<input type="hidden" name="x{$BASEID}_position" />
<input type="hidden" name="x{$BASEID}_target_module" value="" />
<input type="hidden" name="TPL" value="{$TPL}" />
</form>
