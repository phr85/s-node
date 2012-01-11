<fieldset>
<legend>{"Check free domain"|livetranslate}</legend>
<b>{$DOMAIN}.{$EXTENSION}</b> <span style="color: red; font-weight: bold;">{"is not available"|livetranslate}</span><br /><br />
<form method="post">
 <input type="text" name="x{$BASEID}_domain" value="{$DOMAIN}">
 <select name="x{$BASEID}_ext">
 {foreach from=$SERVERS key=EXT item=SERVER}
  <option {if $EXTENSION == $EXT}selected{/if}>{$EXT}</option>
 {/foreach}
 </select>
 <input type="submit" value="{'Check free domain'|translate}">
</form>
</fieldset>