{if $smarty.get.adminmode ==1 || $SHOWTABS ==1}
<table cellspacing="0" cellpadding="0" width="100%" style="background-color: white;">
 <tr><td class="top_head" colspan="10">{$TPL_REAL_TITLE|htmlspecialchars}</td></tr>
 <tr>
  <td class="tab_container" style="padding: 0px; height: 22px;" valign="top">
   <form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="post" name="tabs"><input type="hidden" name="module" value="" />
   <input type="hidden" name="showtabs" value="{$SHOWTABS}" />
   <table cellspacing="0" cellpadding="0" align="left">
    <tr>
     {foreach from=$TABS key=KEY item=TAB name=TABLOOP}
      {if $TAB.visible}
       {if $KEY eq $MODULE}
       <td class="tab_active" onclick="document.forms['tabs'].x{$BASEID}_action.value='';document.forms['tabs'].module.value='{$KEY}';document.forms['tabs'].submit();">{$TAB.title}</td>
       {else}
        <td class="tab" onclick="document.forms['tabs'].x{$BASEID}_action.value='';document.forms['tabs'].module.value='{$KEY}';document.forms['tabs'].submit();">{$TAB.title}</td>
       {/if}
      {/if}
     {/foreach}
    </tr>
   </table><a name="top">&nbsp;</a><input type="hidden" name="x{$BASEID}_action" value="" /></form>
  </td>
 </tr>
</table>
{/if}
