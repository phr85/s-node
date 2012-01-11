<br /><div class="titlebar">{"Your basket"|translate}</div>
<div class="subtitlebar">{translate_replace string="Sie haben <b>%1</b> Artikel mit einem wert von <b>%2</b> %3 in ihrem warenkorb" t1=$BASKET.articles t2=$BASKET.sum|round5 t3=$BASECURRENCY }</div><br />
<form name="basket" method="POST" onSubmit="window.document.forms['basket'].x{$BASEID}_action.value='refresh';">


{if $ERRORMESSAGE != ""}
<div class="catDoError">{$ERRORMESSAGE}</div><br />
{/if}

<table  border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td class="cathead" align="left" valign="top" width="90">{"article"|translate}</td>
<td class="cathead" align="left" valign="top" width="60">{"quantity"|translate}</td>
<td class="cathead" align="left" valign="top">{"bezeichnung"|translate}</td>
<td class="cathead" valign="top" width="80" align="right">{"singleprice"|translate}</td>
<td class="cathead" valign="top" width="90" align="right">{"totalprice"|translate}</td>
</tr>

{foreach from=$BASKETARTICLES name=ARTICLELIST item=ARTICLE key=ARTICLEID}
<tr>
<td class="catbasketrow" align="left" valign="top">{image id=$ARTICLE.image_id version=0 title=$ARTICLE.title}
</td>
<td class="catbasketrow" align="left" valign="top"><input type="text" size="3" value="{$ARTICLE.quantity}" name="x{$BASEID}_quantity[{$ARTICLEID}]" />&nbsp;&nbsp;{actionIcon
     action  = "delete"
     icon    = "../default/delete_o.gif"
     form    = "basket"
     title   = "delete this article from basket"
     article_id = $ARTICLEID
     rollover = "../default/delete.gif"
   }</td>
<td class="catbasketrow" align="left" valign="top">{$ARTICLE.title}</td>
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
<td class="catbasketrowbtop" align="right" valign="top" colspan="2">{actionLink
     action  = "refresh"
     form    = "basket"
     text   = "recalculate"|translate
   }</td>
<td class="catbasketrowbtop" colspan="2" align="right" valign="top">{"sum"|translate}</td>
<td class="catbasketrowbtop" colspan="2" align="right" valign="top">{$BASECURRENCY} {$TOTALPRICE|round5}</td>
</tr>
{if $DISCOUNTPRICE > 0}
<tr>
<td class="catbasketrow" align="left" valign="top"><br /></td>
<td class="catbasketrow" align="left" valign="top"><br /></td>
<td class="catbasketrow" colspan="2" align="right" valign="top">{"discount"|translate}</td>
<td class="catbasketrow" colspan="2" align="right" valign="top">- {$BASECURRENCY} {$DISCOUNTPRICE|round5}</td>
</tr>
{/if}
<tr>
<td class="catbasketrow" align="left" valign="top"><br /></td>
<td class="catbasketrow" align="left" valign="top"><br /></td>
<td class="catbasketrow" colspan="2" align="right" valign="top">{"transport"|translate}</td>
<td class="catbasketrow" colspan="2" align="right" valign="top">{$BASECURRENCY} {$TRANSPORTCOST|round5}</td>
</tr>

<tr>
<td class="catbasketrowbtop" align="left" valign="top"><br /></td>
<td class="catbasketrowbtop" align="left" valign="top"><br /></td>
<td class="catbasketrowbtop" colspan="2" align="right" valign="top">{"totalsum"|translate}</td>
<td class="catbasketrowbtop" colspan="2" style="font-weight: bold; font-size: 14px;" align="right" valign="top">{$BASECURRENCY} {$ENDPRICE|round5}</td>
</tr>

<tr>
<td class="catbasketrow" align="left" valign="top"><br /></td>
<td class="catbasketrow" align="left" valign="top"><br /></td>
<td class="catbasketrow" style="text-align: right;" colspan="4" rowspan="1" valign="top">{"all prices are inc taxes"|translate} ({$BASECURRENCY} {$TAXES|round5})
</td>
</tr>
<tr>
<td class="catbasketrow" align="left" valign="top"><br /></td>
<td class="catbasketrow" align="left" valign="top"><br /></td>
<td class="catbasketrow" style="text-align: right;" colspan="4" rowspan="1" valign="top"><br />{actionLink
     action  = "nextStep"
     form    = "basket"
     text   = "next step"|translate
   }<br /><br />
</td>
</tr>
</tbody>
</table>
<input type="hidden" name="x{$BASEID}_article_id" value="" />
<input type="hidden" name="x{$BASEID}_key" value="" />
<input type="hidden" name="x{$BASEID}_action" value="" />

{if count($GIVENPROMO)>0}
{include file="ch.iframe.snode.shop/basket/promo.tpl"}
{/if}


{if $DISPLAYGIFT == 1}
{include file="ch.iframe.snode.shop/basket/gift.tpl"}
{/if}
</form>



