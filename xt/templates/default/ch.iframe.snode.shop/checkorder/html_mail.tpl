{literal}
<style type="text/css">
TD.basket_borderbottom { border-bottom: 2px solid #D7E9F8; }

DIV.titlebar {
    padding: 4px;
    text-align: center;
    font-size: 14px;
    font-weight: bold;
    color: #6F94B2;
    background-color: #D6E8F7;
}

DIV.subtitlebar {
    padding: 10px;
    color: #6F94B2;
    background-color: #E1EDF8;
}

TD.producttitle {
    font-size: 14px;
    text-align: center;
    font-weight: bold;
    padding: 10px 0px;
}

TD.form_separator { padding: 5px; padding-top: 20px; color: #6F94B2; font-weight: bold; border-bottom: 4px solid #D6E8F7; }
TD.form_left { padding: 5px; border-bottom: 1px solid #9CB9E1; width: 150px; vertical-align: top; }
TD.form_right { padding: 5px; border-bottom: 1px solid #9CB9E1;}

TD.basket, TD.basket_bordertop, TD.basket_borderbottom { padding: 4px; }
TD.basket_bordertop { border-top: 3px solid #C4DFF5; }
TD.basket_borderbottom { border-bottom: 2px solid #D7E9F8; }
BODY {
    margin: 15px;
    background-color: #E9F2FA;
}

A {
    text-decoration: none;
    color: #5A7CB6;
}

A:hover {
    text-decoration: none;
    color: #B1341F;
}

BODY, TD, INPUT, SELECT, TEXTAREA {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 11px;
    color: #00458D;
}

</style>
{/literal}

<table cellpadding="0" cellspacing="0" width="600">
<tr>
<td>

<div class="titlebar">{"Besten Dank f&uuml;r Ihre Bestellung"}</div><br />
{$ORDER_TIME|date_format:"%d.%m.%Y um %H:%I"} Uhr im {$SHOPNAME} Online Shop.<br />
<br />
Die Bearbeitungsnummer dieser Bestellung lautet: <b>{$ORDER_NR}</b><br />
<br />
<div class="titlebar">{"Ihre Bestellung:"}</div><br />

<table style="text-align: left;" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr style="background-color: #D7E9F8;">
 <td class="basket" align="left" valign="top" width="60">{"quantity"|translate}</td>
 <td class="basket" align="left" valign="top">{"bezeichnung"|translate}</td>
 <td class="basket" valign="top" width="90" align="right">{"singleprice"|translate}</td>
 <td class="basket" valign="top" width="120" align="right">{"totalprice"|translate}</td>
</tr>
{foreach from=$ITEMS item=ITEM}
<tr>
  <td class="basket_borderbottom" align="left" valign="top">{$ITEM.quantity}x</td>
  <td class="basket_borderbottom" align="left" valign="top">{$ITEM.title}</td>
  <td class="basket_borderbottom" align="right" valign="top">{$BASECURRENCY} {$ITEM.single_price|round5}</td>
  <td class="basket_borderbottom" align="right" valign="top">{$BASECURRENCY} {$ITEM.total_price|round5}</td>
</tr>
{/foreach}

<tr style="background-color: #D7E9F8;">
<td class="basket_bordertop" align="right" valign="top" colspan="2">&nbsp;</td>
<td class="basket_bordertop" align="right" valign="top">{"sum"|translate}</td>
<td class="basket_bordertop" align="right" valign="top">{$BASECURRENCY} {$TOTALPRICE|round5}</td>
</tr>
{if $DISCOUNT > 0}
<tr>
<td class="basket" align="left" valign="top"><br /></td>
<td class="basket" align="left" valign="top"><br /></td>
<td class="basket" align="right" valign="top">{"discount"|translate}</td>
<td class="basket" align="right" valign="top">- {$BASECURRENCY} {$DISCOUNT|round5}</td>
</tr>
{/if}
<tr style="background-color: #D7E9F8;">
<td class="basket" align="left" valign="top"><br /></td>
<td class="basket" align="left" valign="top"><br /></td>
<td class="basket" align="right" valign="top">{"transport"|translate}</td>
<td class="basket" align="right" valign="top">{$BASECURRENCY} {$TRANSPORT|round5}</td>
</tr>

<tr style="background-color: #D7E9F8;">
<td class="basket_bordertop" align="left" valign="top"><br /></td>
<td class="basket_bordertop" align="left" valign="top"><br /></td>
<td class="basket_bordertop" align="right" valign="top">{"totalsum"|translate}</td>
<td class="basket_bordertop" style="font-weight: bold; font-size: 14px;" align="right" valign="top">{$BASECURRENCY} {$ENDPRICE|round5}</td>
</tr>

<tr style="background-color: #C4DFF5;">
<td class="basket" align="left" valign="top"><br /></td>
<td class="basket" align="left" valign="top"><br /></td>
<td class="basket" style="text-align: right;" colspan="4" rowspan="1" valign="top">{"all prices are inc taxes"|translate} ({$BASECURRENCY} {$TAXES|round5})
</td>
</tr>
</tbody>
</table>

{if $DISPLAYGIFT == 1}
<br /><div class="titlebar">{"Your gifts"|translate}</div>
<div class="subtitlebar">{"Als Dank für Ihren Einkauf erhalten Sie die folgenden Dankeschöngeschenke <b>kostenlos</b> dazu"|translate}</div>
<table style="width: 100%; text-align: left;" border="0" cellpadding="0" cellspacing="1">
<tr>
<td valign="bottom" style="padding:5px;">
</td>
</tr>

{foreach from=$SELECTEDGIFTS key=key item=PRODUCT}
<tr>
 <td class="basket_borderbottom"><b>1 x</b> {$PRODUCT.title}</td>
</tr>
{/foreach}

</table>
{/if}

<br />
<div class="titlebar">{"Die Lieferung erfolgt in den n&auml;chsten Tagen an folgende Adresse:"}</div><br />
<table style="text-align: left; width: 100%;" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td class="form_left">{"Name"|translate}</td>
      <td class="form_right">{$ADDRESS.shipping_firstName} {$ADDRESS.shipping_lastName}</td>
    </tr>
    <tr>
      <td class="form_left">{"Street / Nr."|translate}</td>
      <td class="form_right">{$ADDRESS.shipping_street} {$ADDRESS.shipping_street_nr}</td>
    </tr>
    <tr>
      <td class="form_left">PLZ/ Ort</td>
      <td class="form_right">CH - {$ADDRESS.shipping_cityCode} {$ADDRESS.shipping_city}</td>
    </tr>
</table>

<br /><div class="titlebar">{"Die Rechnung wird an folgenden Empf&auml;nger gesendet:"}</div><br />
<table style="text-align: left; width: 100%;" border="0" cellpadding="0" cellspacing="0">
    {if $ADDRESS.cnr != ''}
    <tr>
      <td class="form_left">{"Customer Nr."|translate}</td>
      <td class="form_right"><b>{$ADDRESS.cnr}</b></td>
    </tr>
    {/if}
    <tr>
      <td class="form_left">{"Name"|translate}</td>
      <td class="form_right">{$ADDRESS.firstName} {$ADDRESS.lastName}</td>
    </tr>
    <tr>
      <td class="form_left">{"Street / Nr."|translate}</td>
      <td class="form_right">{$ADDRESS.street} {$ADDRESS.street_nr}</td>
    </tr>
    <tr>
      <td class="form_left">PLZ/ Ort</td>
      <td class="form_right">CH - {$ADDRESS.cityCode} {$ADDRESS.city}</td>
    </tr>
    <tr>
      <td class="form_left">{"E-Mail"|translate}</td>
      <td class="form_right">{$ADDRESS.email}</td>
    </tr>
</table>

<br /><div class="titlebar">{"Sie k&ouml;nnen weitere Bestellungen mit folgendem Benutzernamen durchf&uuml;hren:"}</div><br />
<table style="text-align: left; width: 100%;" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td class="form_left">{"Benutzername:"}</td>
      <td class="form_right"><b>{$USERNAME}</b></td>
    </tr>
    {if $ADDRESS.cnr != ''}
    <tr>
      <td class="form_left">{"Ihre Kundenummer:"}</td>
      <td class="form_right"><b>{$ADDRESS.cnr}</b></td>
    </tr>
    {/if}
</table>
<br /><br />

Hinweise und Informationen zum Bestell- und Liefervorgang werden per
Mail an {$ADDRESS.email} gesendet.<br />
<br />
Freundliche Gr&uuml;sse<br />
</td></tr></table>