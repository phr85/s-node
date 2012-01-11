<form method="post" name="do" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
{foreach from=$ERRORS item=ERROR}
<div class="catDoError">{$ERROR}</div><br />
{/foreach}
<table cellpadding="0" cellspacing="0" width="100%" summary="directorder">
 <tr>
  <td class="cathead">Art. Nr.</td>
  <td class="cathead" width="60"></td>
  <td class="cathead">Bezeichnung</td>
  <td class="cathead">Menge</td>
  <td class="cathead" width="100">Einzelpreis</td>
  <td class="cathead">&nbsp;</td>
 </tr>
 {foreach from=$DIRECT key=KEY item=ITEM}
 <tr>
  <td class="catbasketrow"><input class="field" type="text" size="8" name="x{$BASEID}_artnr[]" value="{$ITEM.art_nr}" onkeypress="return submitenter(this,event)" /></td>
  <td class="catbasketrow">{
  LiveActionIcon
      action="getProduct"
      form="do"
      icon="../default/arrow_right.gif"
      title="Produkt holen"
  }</td>
  <td class="catbasketrow"><input type="text" class="field" size="35" name="x{$BASEID}_artdesc[]" disabled="disabled" value="{$ITEM.title}" /></td>
  <td class="catbasketrow"><input type="text" size="6" name="x{$BASEID}_quantity[]" value="{$ITEM.quantity}" /></td>
  <td class="catbasketrow"><input type="text" size="6" name="x{$BASEID}_single_price[]" disabled="disabled" value="{if $ITEM.price > 0}{$ITEM.price|round5}{/if}" /></td>
  <td class="catbasketrow">{
  LiveActionIcon
      action="removeProduct"
      form="do"
      icon="../default/delete_o.gif"
      title="Position entfernen"
      rollover="../default/delete.gif"
      id=$KEY
  }</td>
 </tr>
 {/foreach}
</table>


{actionLink
     action  = "doOrder"
     form    = "do"
     text   = "Weiter"
   }<br /><br />


<input type="hidden" name="x{$BASEID}_action" value="getProduct" />
<input type="hidden" name="x{$BASEID}_id" value="" />
</form>
{literal}
<script type="text/javascript">
function submitenter(myfield,e)
{
    var keycode;
    if (window.event) keycode = window.event.keyCode;
    else if (e) keycode = e.which;
    else return true;

    if (keycode == 13)
       {
       myfield.form.submit();
       return false;
       }
    else
       return true;
}
</script>
{/literal}