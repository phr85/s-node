{get_param param="overview_tpl" assign="overview_tpl"}
<table style="width: 100%;" border="0" cellpadding="0" cellspacing="0">
  <tr>
   <td>{"Art. Nr."|translate} {$DATA.art_nr},quantity:{$DATA.quantity} unit:{$DATA.unit} 
   </td>
  </tr>
  <tr>
   <td><h2 class="proddetail">{$DATA.title}</h2></td>
  </tr>
  {if $DATA.subtitle != ""}
  <tr>
   <td><h3 class="proddetail">{$DATA.subtitle}</h3></td>
  </tr>
  {/if}
  <tr>
   <td>
      {subplugin package="ch.iframe.snode.catalog" module="product_images" style="main.tpl" show="main" version=3}
      {if $DATA.lead!=""}<b>{$DATA.lead}</b><br />{/if}
      {$DATA.description} 
   </td>
  </tr>
</table>
      <A href="{$smarty.server.PHP_SELF}?TPL={$overview_tpl}">{"back to overview"|translate}</A><br />
      