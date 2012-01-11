<dl> 
<dt>subject</dt>
<dd><input type="text" name="x{$BASEID}_reply[subject]" value="RE: {$xt50_comp_messages.message.subject}" /></dd>

<dt>text</dt>
<dd><textarea name="x{$BASEID}_reply[text]">{$xt50_comp_messages.write.text}</textarea></dd>
 
</dl>

<input type="hidden" name="x{$BASEID}_reply[to]" value="{$xt50_comp_messages.message.sender}" />
<input type="hidden" name="x{$BASEID}_reply[msgflow]" value="{$xt50_comp_messages.message.id}" />


