<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="POST" name="edit_node">
 {include file="includes/buttons.tpl" data=$EDIT_NODE_BUTTONS}
 {include file="includes/lang_selector_submit.tpl" form="edit_node" action="saveNode"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" colspan="2">{"Node data"|translate}</td>
  </tr>
  <tr>
   <td class="left">{"name"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_title" value="{$NODE.title}" size="42"></td>
  </tr>





  <tr>
  <td class="left">{"display in product overview"|translate}</td>
  <td class="right" onclick="showhideCheckbox('x{$BASEID}_use_description','x{$BASEID}_udblock1');showhideCheckbox('x{$BASEID}_use_description','x{$BASEID}_udblock2');"><input type="checkbox" name="x{$BASEID}_use_description" value="1" {if $NODE.use_description == 1}checked{/if}></td>
 </tr>
 <tr id="x{$BASEID}_udblock1" style="display: {if $NODE.use_description == 1}table-row{else}none{/if};">
   <td class="left">{"Subtitle"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_subtitle" value="{$NODE.subtitle}" size="42"></td>
 </tr>
  <tr id="x{$BASEID}_udblock2" style="display: {if $NODE.use_description == 1}table-row{else}none{/if};">
   <td class="left">{"description"|translate}</td>
   <td class="right"><textarea name="x{$BASEID}_description" cols="50">{$NODE.description}</textarea></td>
  </tr>
 </table>
 <input type="hidden" name="x{$BASEID}_node_id" value="{$NODE_ID}">
 <input type="hidden" name="x{$BASEID}_save_lang" value="{$ACTIVE_LANG}">
</form>



