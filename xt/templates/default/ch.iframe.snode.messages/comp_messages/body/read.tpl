
<dl>
<dt>date</dt>
<dd>{$xt50_comp_messages.message.send_date|date_format:"%d.%m.%Y %H:%I"}</dd>

<dt>from</dt>
<dd>{$xt50_comp_messages.message.sender|xt_getUserProperties:"username"}</dd>

<dt>subject</dt>
<dd class="bold">{$xt50_comp_messages.message.subject}</dd>

<dt>text</dt>
<dd>{$xt50_comp_messages.message.text|nl2br}</dd>
 
</dl>



<input type="hidden"  value="{$xt50_comp_messages.message.id}" name="x50_message_ids[]" />
<input type="hidden"  value="{$xt50_comp_messages.message.id}" name="x50_message_id" />