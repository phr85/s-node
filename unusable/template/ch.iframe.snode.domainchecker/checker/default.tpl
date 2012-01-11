<fieldset>
<legend>{"Check free domain"|livetranslate}</legend>
<form method="post">
 <input type="text" name="x{$BASEID}_domain">
 <select name="x{$BASEID}_ext">
 {foreach from=$SERVERS key=EXT item=SERVER}
  <option>{$EXT}</option>
 {/foreach}
 </select>
 <input type="submit" value="{'Check free domain'|translate}">
</form>
</fieldset>