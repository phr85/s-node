<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title"> {"Shop details"|translate}</span>{inline_navigator_top anchor ="shop_details"}
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
   <td class="left">{"Price"|translate} / {"Taxes"|translate}</td>
   <td class="right">
    <input type="text" size="12" name="x{$BASEID}_price" value="{$DATA[0].price}"> /
    <select name=x{$BASEID}_taxes>
     {html_options options=$TAXES selected=$DATA[0].taxes}
    </select>
   </td>
 </tr>
  <tr>
   <td class="left">{"STAFFELPREISE"|translate}</td>
   <td class="right">
 {foreach from=$STAFFELPREISE item=SP}
 {"pcs"|translate} <input type="text" value="{$SP.pcs}" name="x{$BASEID}_SPpcs[{$SP.id}]" size="3" /> &nbsp;&nbsp;&nbsp;
 {"price"|translate} <input type="text" value="{$SP.price}" name="x{$BASEID}_SPprice[{$SP.id}]" size="10" />
<br />
 {/foreach}
<hr />
 {"pcs"|translate} <input type="text" value="" name="x{$BASEID}_SPpcs[new]" size="3" /> &nbsp;&nbsp;&nbsp;
 {"price"|translate} <input type="text" value="" name="x{$BASEID}_SPprice[new]" size="10" />

    </td>
 </tr>
 <tr>
   <td class="left">{"Gift"|translate}</td>
   <td class="right">
   <input type="radio" name="x{$BASEID}_gift" value="0"{if $DATA[0].gift == 0} checked="checked"{/if}>{"No"|translate}&nbsp;
   <input type="radio" name="x{$BASEID}_gift" value="1"{if $DATA[0].gift == 1} checked="checked"{/if}>{"Present1"|translate}&nbsp;
   <input type="radio" name="x{$BASEID}_gift" value="2"{if $DATA[0].gift == 2} checked="checked"{/if}>{"Present2"|translate}&nbsp;
   </td>
 </tr>
 <tr>
   <td class="left">{"Product of the month"|translate}</td>
   <td class="right">
   <input type="radio" name="x{$BASEID}_product_of_month" value="0"{if $DATA[0].product_of_month == 0} checked="checked"{/if}>{"No"|translate}&nbsp;
   <input type="radio" name="x{$BASEID}_product_of_month" value="1"{if $DATA[0].product_of_month == 1} checked="checked"{/if}>{"Yes"|translate}&nbsp;
   </td>
 </tr>
 <tr>
   <td class="left">{"Product is buyable"|translate}</td>
   <td class="right">
   <input type="radio" name="x{$BASEID}_buyable" value="0"{if $DATA[0].buyable == 0} checked="checked"{/if}>{"No"|translate}&nbsp;
   <input type="radio" name="x{$BASEID}_buyable" value="1"{if $DATA[0].buyable == 1} checked="checked"{/if}>{"Yes"|translate}&nbsp;
   </td>
 </tr>

 </table>
