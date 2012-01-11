<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" name="overview">
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
   <td class="table_header" width="50" onclick="document.forms['overview'].x{$BASEID}_order_by.value='p.id';document.forms['overview'].x{$BASEID}_order_by_dir.value='{if $ORDER_BY_DIR == 'ASC' && $ORDER_BY == 'p.id'}DESC{else}ASC{/if}';document.forms['overview'].submit();">{"ID"|translate} {if $ORDER_BY == 'p.id'}<img src="{$XT_IMAGES}admin/header_arrow_{if $ORDER_BY_DIR == 'DESC'}down{else}up{/if}.gif" alt=""/>{/if}</td>
   <td class="table_header" colspan="3" onclick="document.forms['overview'].x{$BASEID}_order_by.value='pd.title';document.forms['overview'].x{$BASEID}_order_by_dir.value='{if $ORDER_BY_DIR == 'ASC' && $ORDER_BY == 'pd.title'}DESC{else}ASC{/if}';document.forms['overview'].submit();">{"Title"|translate} {if $ORDER_BY == 'pd.title'}<img src="{$XT_IMAGES}admin/header_arrow_{if $ORDER_BY_DIR == 'DESC'}down{else}up{/if}.gif" alt=""/>{/if}</td>
  </tr>
  <tr class="{cycle values="row_a,row_b"}">
   <td class="row">&nbsp;</td>
   <td class="button" width="20"><img src="{$XT_IMAGES}icons/box_white.png" alt="" /></td>
   <td class="row" style="padding-left: 0px;">{
   actionLink
       action="openPackage"
       target="slave1"
       form="0"
       package_id="global"
       package_title="Global translations"|translate
       text="Global translations"|translate
   }&nbsp;</td>
   <td class="row">
   {actionIcon
           action="exportPrivateTranslations"
           form="overview"
           icon="download.png"
           title="Export private translations"
       }
   <select name="x{$BASEID}_exportlang">
   {foreach from=$LANGS item=LANGDESC key=LANG}
   		<option value="{$LANG}">{$LANGDESC.name}</option>
   {/foreach}
   </select>
   </td>
  </tr>
  {foreach from=$PACKAGES item=PACKAGE}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="row">{$PACKAGE.id}</td>
       <td class="button" width="20"><img src="{$XT_IMAGES}icons/box.png" alt="" /></td>
       <td class="row" style="padding-left: 0px;"><span title="{$PACKAGE.package}">{
       actionLink
           action="openPackage"
           target="slave1"
           form="0"
           package_id=$PACKAGE.package
           package_title=$PACKAGE.title
           text=$PACKAGE.title
       }&nbsp;</span></td>
       <td class="row">&nbsp;</td>
      </tr>
  {/foreach}
 </table>
</table>
<input type="hidden" name="x{$BASEID}_order_by" />
<input type="hidden" name="x{$BASEID}_order_by_dir" />
</form>