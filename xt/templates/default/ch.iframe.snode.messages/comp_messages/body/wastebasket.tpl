<table cellpadding="0" cellspacing="0" width="100%" class="msglist" summary="messages">
<tr class="head">
<td>&nbsp;</td>
<td>sender</td>
<td>subject / text</td>
<td>date</td>
</tr>

{foreach from=$MESSAGES item="MSG"}
<tr id="row{$MSG.id}" {if $MSG.read_date == 0}class="unreaded"{/if}>
<td><input type="checkbox" name="x{$BASEID}_message_ids[]" value="{$MSG.id}" /> </td>
<td class="sender">{$MSG.sender|xt_getUserProperties:"username"}</td>
<td class="subjectandtext"><span><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_mode=read_deleted&amp;x{$BASEID}_message_id={$MSG.id}">{$MSG.subject}</a></span><br />
{$MSG.text}...</td>
<td class="date">{$MSG.send_date|date_format:"%d.%m.%Y %H:%I"}</td>
</tr>

{/foreach}
</table>

{include file="ch.iframe.snode.messages/comp_messages/components/paginator.tpl" METADATA=$xt50_comp_messages.metadata MODE=$xt50_comp_messages.mode}