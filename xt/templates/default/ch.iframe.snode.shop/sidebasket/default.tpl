<table cellpadding="0" cellspacing="0" width="100%" style="background-color: #C4DFF5;">
 <tr>
  <td style="border-color: #B8CFE8; border-width: 1px 1px 0px 1px; border-style: solid; padding: 3px;">
   <table cellspacing="0" cellpadding="0" width="100%">
    <tr>
     <td><img src="{$XT_IMAGES}default/basket.gif" alt="" align="middle" /></td>
     <td style="font-style: italic; font-size: 12px;"><b>{$SHOPNAME} Warenkorb</b></td>
    </tr>
   </table>
  </td>
 </tr>
 <tr>
  <td style="{if $HIGHLIGHT}background-color: #7DA5E0; color: white;{/if}; border-color: #B8CFE8; border-width: 1px; border-style: solid; padding: 3px; padding-left: 28px;">
   {translate_replace string="%1 Artikel <br />Summe %3 %2" t1=$BASKET.articles t2=$BASKET.sum|round5 t3=$BASECURRENCY }
  </td>
 </tr>
 <tr>
  <td style="border-color: #B8CFE8; border-width: 0px 1px 1px 1px; border-style: solid; padding: 3px;" align="right">
   <a href="{$smarty.server.PHP_SELF}?TPL={$BASKETTPL}"><b>{"Checkout"|translate}</b></a>
  </td>
 </tr>
</table>
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td>&nbsp;</td>
 </tr>
 <tr>
  <td>
   <table cellpadding="0" cellspacing="0" style="margin-left: 5px;">
    <tr style="height: 25px;">
     <td><img src="{$XT_IMAGES}default/next.gif" alt="" /></td>
     <td style="font-size: 12px; font-weight: bold; font-style: italic; padding-left: 5px;"><a href="{$smarty.server.PHP_SELF}?TPL={$SIDENAV.register.TPL}">{$SIDENAV.register.txt|translate}</a></td>
    </tr>
   </table>
  </td>
 </tr>
 <tr style="height: 25px;">
  <td>
   <table cellpadding="0" cellspacing="0" style="margin-left: 5px;">
    <tr>
     <td><img src="{$XT_IMAGES}default/next.gif" alt="" /></td>
     <td style="font-size: 12px; font-weight: bold; font-style: italic; padding-left: 5px;"><a href="{$smarty.server.PHP_SELF}?TPL={$SIDENAV.login.TPL}">{$SIDENAV.login.txt|translate}</a></td>
    </tr>
   </table>
  </td>
 </tr>
</table>



