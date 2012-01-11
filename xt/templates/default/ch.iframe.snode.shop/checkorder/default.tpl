{if $smarty.get.agb_error == 1}<br /><div style="background-color: #DEACAC; padding: 10px; color: white;">{"Please accept our AGB to continue"|translate}</div>{/if}
<br /><div class="titlebar">{"Your basket"|translate}</div>
<div class="subtitlebar">{translate_replace string="Sie haben <b>%1</b> Artikel mit einem wert von <b>%2</b> %3 in ihrem warenkorb" t1=$BASKET.articles t2=$BASKET.sum t3=$BASECURRENCY }</div><br />

<table style="width: 100%; text-align: left;" border="0" cellpadding="0" cellspacing="0">
<tbody>
{if $ERRORMESSAGE != ""}
<tr>
<td colspan="6" align="left" valign="top" style="font-size:20px; color:#FA8829;">{$ERRORMESSAGE}
</td>
</tr>

{/if}
<tr>
<td class="cathead" align="left" valign="top" width="90">{"article"|translate}</td>
<td class="cathead" align="left" valign="top" width="60">{"quantity"|translate}</td>
<td class="cathead" align="left" valign="top">{"bezeichnung"|translate}</td>
<td class="cathead" valign="top" width="80" align="right">{"singleprice"|translate}</td>
<td class="cathead" valign="top" width="90" align="right">{"totalprice"|translate}</td>
</tr>

{foreach from=$BASKETARTICLES name=ARTICLELIST item=ARTICLE key=ARTICLEID}
<tr>
<td class="catbasketrow" align="left" valign="top">{image
               id=$ARTICLE.image_id
               version=0
               title=$ARTICLE.title
               alt=$ARTICLE.title }
</td>
<td class="catbasketrow" align="left" valign="top"><b>{$ARTICLE.quantity} x</b></td>
<td class="catbasketrow" align="left" valign="top">{if $ARTICLE.art_nr!=""}{$ARTICLE.art_nr} : {/if}{$ARTICLE.title}</td>
<td class="catbasketrow" align="right" valign="top">{$BASECURRENCY} {$ARTICLE.price|round5}<br />
{if $ARTICLE.pricediscount > 0}
<i>- {$BASECURRENCY} {$ARTICLE.pricediscount|round5}</i></td>
{/if}
<td class="catbasketrow" align="right" valign="top">{$BASECURRENCY} {$ARTICLE.asum|round5}<br />
{if $ARTICLE.discount > 0}
<i>- {$BASECURRENCY} {$ARTICLE.discount|round5}</i>
{/if}
</td>
</tr>
{/foreach}

<tr>
<td class="catbasketrowbtop" align="right" valign="top" colspan="2">&nbsp;</td>
<td class="catbasketrowbtop" colspan="2" align="right" valign="top">{"sum"|translate}</td>
<td class="catbasketrowbtop" colspan="2" align="right" valign="top">{$BASECURRENCY} {$TOTALPRICE|round5}</td>
</tr>
{if $DISCOUNTPRICE > 0}
<tr>
<td class="cathead" align="left" valign="top"><br /></td>
<td class="cathead" align="left" valign="top"><br /></td>
<td class="cathead" colspan="2" align="right" valign="top">{"discount"|translate}</td>
<td class="cathead" colspan="2" align="right" valign="top">- {$BASECURRENCY} {$DISCOUNTPRICE|round5}</td>
</tr>
{/if}
<tr>
<td class="cathead" align="left" valign="top"><br /></td>
<td class="cathead" align="left" valign="top"><br /></td>
<td class="cathead" colspan="2" align="right" valign="top">{"transport"|translate}</td>
<td class="cathead" colspan="2" align="right" valign="top">{$BASECURRENCY} {$TRANSPORTCOST|round5}</td>
</tr>

<tr>
<td class="catbasketrowbtop" align="left" valign="top"><br /></td>
<td class="catbasketrowbtop" align="left" valign="top"><br /></td>
<td class="catbasketrowbtop" colspan="2" align="right" valign="top">{"totalsum"|translate}</td>
<td class="catbasketrowbtop" colspan="2" style="font-weight: bold; font-size: 14px;" align="right" valign="top">{$BASECURRENCY} {$ENDPRICE|round5}</td>
</tr>

<tr style="background-color: #C4DFF5;">
<td class="cathead" align="left" valign="top"><br /></td>
<td class="cathead" align="left" valign="top"><br /></td>
<td class="cathead" style="text-align: right;" colspan="4" rowspan="1" valign="top">{"all prices are inc taxes"|translate} ({$BASECURRENCY} {$TAXES|round5})
</td>
</tr>
</tbody>
</table>
<input type="hidden" name="x{$BASEID}_article_id" value="" />
<input type="hidden" name="x{$BASEID}_key" value="" />
<input type="hidden" name="x{$BASEID}_action" value="" />



{if $DISPLAYGIFT == 1}
{include file="ch.iframe.snode.shop/checkorder/default/gift.tpl"}
{/if}


<form name="checkorder" method="POST">
{include file="ch.iframe.snode.shop/checkorder/default/address.tpl"}

<br /><div class="titlebar">{"AGB"|translate}</div><br />
<table border="0" cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td>
  <textarea style="width: 100%; height: 100px;" rows="5" cols="80">{include file="ch.iframe.snode.shop/agb.txt"}</textarea></td>
 </tr>
 <tr>
  <td>
  <br />
  <input id="agb" type="checkbox" name="x{$BASEID}_agb" value="1"> {"Ich habe die AGB gelesen und akzeptiere diese."|translate}

  </td>
 </tr>
</table>
</form>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
 <td align="left"><br />
 {actionLink
     action  = "back"
     form    = "checkorder"
     text   = "back"|translate
   }
</td>
<td align="right"><br />
<a onclick="{literal}if(!window.document.forms['checkorder'].agb.checked){alert('{/literal}{"AGB gelesen?"|translate}{literal}'); return false;}
else
{document.forms['checkorder'].x2400_action.value='orderOk';document.forms['checkorder'].submit();}{/literal}">{"next step"|translate}</a>
</td>
</tr>
</table>