<div class="titlebar">{"Your gifts"|translate}</div>
<div class="subtitlebar">{"Vielen Dank, dass Sie unser Online-Angebot nutzen. Sie erhalten zu Ihrem Einkauf eines der folgenden Dankesch�ngeschenke <b>kostenlos</b> dazu"|translate}</div>
<table  border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td valign="bottom" style="padding:5px;">
</td>
</tr>
</table>

<table cellpadding="0" cellspacing="0" width="100%">
{foreach from=$SELECTEDGIFTS key=key item=PRODUCT}
<tr>
 <td class="catbasketrow"><b>1 x</b> {$PRODUCT.title}</td>
 <td class="catbasketrow" align="right">{actionIcon
     action  = "unSetGift"
     icon    = "../default/delete_o.gif"
     form    = "basket"
     title   = "select gift"
     key = $key
     rollover = "../default/delete.gif"
 }</td>
</tr>
{/foreach}
</table>


{if $PRESENT}
<br /><div class="titlebar">{"Please choose your gifts"|translate}</div>
{/if}
<table cellpadding="0" cellspacing="0" width="100%">
{foreach from=$PRESENT item=PRODUCT}
<tr>
    <td valign="bottom" style="border-top: 1px solid #D6E8F7; border-right: 1px solid #D6E8F7; border-left: 1px solid #D6E8F7; padding:5px;">
        <table style="width: 100%;" border="0" cellpadding="0" cellspacing="0">
         <tr>
         <td colspan="1" rowspan="2" valign="top" align="left" width="88" style="padding-right:6px;">
         {image
           id=$PRODUCT.image_id
           version=0
           title=$PRODUCT.field_text
           alt=$PRODUCT.field_text
           }</td>
          <td colspan="2" rowspan="1" valign="bottom">
           <b>{$PRODUCT.title}</b>
           <br />
           {$PRODUCT.lead|nl2br}
          </td>
         </tr>
         <tr>
          <td valign="bottom">{$PRODUCT.quantity} {$PRODUCT.unit}<br />{"art_nr"|translate}: {$PRODUCT.art_nr}</td>
          <td valign="bottom" width="80" align="right">{if $HIDEADD==0}{actionIcon
     action  = "setGift"
     icon    = "check.png"
     form    = "basket"
     title   = "select gift"
     article_id = $PRODUCT.id
   }{else}&nbsp;{/if}
          <br />
          </td>
         </tr>
        </table>
    </td>
</tr>
{/foreach}
</table>
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td class="basket" style="text-align: right;" colspan="4" rowspan="1" valign="top"><br />{actionLink
     action  = "nextStep"
     form    = "basket"
     text   = "next step"|translate
   }<br /><br />
</td>
</tr>
</table>