{literal}
<script language="JavaScript"><!--
window.parent.frames['master'].document.forms[1].submit();

//-->
</script>
{/literal}
<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="POST" name="edit_node">
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="view_header" colspan="2">
    <span class="title_light">{"Folder"|translate}:</span> <span class="title">{$NODE.title}</span>
   </td>
  </tr>
  <tr>
   <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt=""></td>
  </tr>
 </table>
 {include file="includes/buttons.tpl" data=$EDIT_NODE_BUTTONS}
 {include file="includes/lang_selector_submit.tpl" form="edit_node" action="saveNode"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="left">{"name"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_title" value="{$NODE.title|htmlspecialchars}" size="42"></td>
  </tr>
  <tr>
   <td class="left">{"description"|translate}</td>
   <td class="right">{toggle_editor id="description"}
   <textarea id="x{$BASEID}_description" name="x{$BASEID}_description" cols="65" rows="4">{$NODE.description}</textarea></td>
  </tr>
  <tr>
   <td class="left">{"feed"|translate}</td>
   <td class="right"><input type="checkbox" name="x{$BASEID}_feed"{if $NODE.feed} checked{/if}></td>
  </tr>
 </table>
 <input type="hidden" name="x{$BASEID}_node_id" value="{$NODE_ID}">
 <input type="hidden" name="x{$BASEID}_module" value="{$ADMINMODULE}">
 <input type="hidden" name="x{$BASEID}_save_lang" value="{$ACTIVE_LANG}">
 <input type="hidden" name="x{$BASEID}_node_pid">
 <input type="hidden" name="x{$BASEID}_position">
 <input type="hidden" name="x{$BASEID}_file_id">
 <input type="hidden" name="x{$BASEID}_active" value="{$NODE.active}">
 <input type="hidden" name="x{$BASEID}_id">
 {include file="includes/editor.tpl"}
</form>



