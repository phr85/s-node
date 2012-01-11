<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" name="themes">
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header">
   <span class="title_light">{"Theme"|translate}</span>: <span class="title">{$smarty.session.theme}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="16">&nbsp;</td>
   <td class="table_header" colspan="2">{"Name"|translate}</td>
  </tr>
  {foreach from=$INSTALLED item=PACKAGE}
  <tr class="{cycle values="row_a,row_b"}">
   <td class="row"><a href="javascript:document.forms['themes'].x{$BASEID}_open.value='{$PACKAGE.id}';document.forms['themes'].submit();">{if $OPEN == $PACKAGE.id}<img src="{$XT_IMAGES}icons/minus.gif" alt="" />{else}<img src="{$XT_IMAGES}icons/plus.gif" alt="" />{/if}</a></td>
   <td class="button" width="20"><img src="{$XT_IMAGES}icons/box_software.png" alt="" /></td>
   <td class="row" style="padding-left: 0px;"><a href="javascript:document.forms['themes'].x{$BASEID}_open.value='{$PACKAGE.id}';document.forms['themes'].submit();"><span title="{$PACKAGE.package}">{$PACKAGE.package} <i>{$PACKAGE.title}</i>&nbsp;</span></a></td>
  </tr>
  {foreach from=$MODULES[$PACKAGE.id] item=MODULE}
  <tr class="{cycle values="row_a,row_b"}">
   <td colspan="3">
    <table cellspacing="0" cellpadding="0" width="100%">
     <tr>
      <td class="row" width="10" style="padding-left: 30px;"><a href="javascript:document.forms['themes'].x{$BASEID}_open_module.value='{$MODULE.module}';document.forms['themes'].submit();"><img src="{$XT_IMAGES}spacer.gif" alt="" width="9"/></a></td>
      <td class="button" width="20">{if $OPEN_MODULE == $MODULE.module}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />{else}<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="" />{/if}</td>
      <td class="row" style="padding-left: 0px;"><a href="javascript:document.forms['themes'].x{$BASEID}_open_module.value='{$MODULE.module}';document.forms['themes'].submit();"><span title="{$MODULE.module}"> <b>{$MODULE.module}</b> <i>{$MODULE.title}</i>&nbsp;</span></a></td>
     </tr>
    </table>
   </td>
  </tr>
  {foreach from=$THEMED_TEMPLATES[$MODULE.module] item=TEMPLATE}
  <tr class="{cycle values="row_a,row_b"}">
   <td colspan="3">
    <table cellspacing="0" cellpadding="0" width="100%">
     <tr>
      <td class="button" width="20" style="padding-left: {$TEMPLATE.level*25+50}px">{if $TEMPLATE.isFolder != 1}<img src="{$XT_IMAGES}icons/pens.png" alt="" />{else}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />{/if}</td>
      <td class="row" style="padding-left: 0px;"><span title="{$MODULE.module}">{$TEMPLATE.title}&nbsp;</span><span style="color: #999999;">(themed)</span></td>
      <td class="button" width="60" align="right">{if $TEMPLATE.isFolder != 1}{
      actionIcon
          action="deleteTemplate"
          icon="delete.png"
          form="themes"
          path=$TEMPLATE.path
          title="Delete template"
          ask="Are you sure, you want to delete this Template?"
      }{
      actionIcon
          action="editThemedTemplate"
          icon="pencil.png"
          form=0
          path=$TEMPLATE.path
          title="Edit template"
          target="slave1"
      }{else}{$ICONSPACER}{/if}</td>
     </tr>
    </table>
   </td>
  </tr>
  {/foreach}
  {foreach from=$DEFAULT_TEMPLATES[$MODULE.module] item=TEMPLATE}
  <tr class="{cycle values="row_a,row_b"}">
   <td colspan="3">
    <table cellspacing="0" cellpadding="0" width="100%">
     <tr>
      <td class="button" width="20" style="padding-left: {$TEMPLATE.level*25+50}px">{if $TEMPLATE.isFolder != 1}<img src="{$XT_IMAGES}icons/pens.png" alt="" />{else}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />{/if}</td>
      <td class="row" style="padding-left: 0px;"><span title="{$MODULE.module}"><span style="color: #999999;">{"Default"|translate}:</span> {$TEMPLATE.title|truncate:26:"...":true}&nbsp;</span></td>
      <td class="button" width="60" align="right">{if $TEMPLATE.isFolder != 1}{
      actionIcon
          action="editDefaultTemplate"
          icon="pencil.png"
          form=0
          path=$TEMPLATE.path
          title="Edit template"
          target="slave1"
      }{else}{$ICONSPACER}{/if}</td>
     </tr>
    </table>
   </td>
  </tr>
  {/foreach}
  {/foreach}
  {/foreach}
</table>
<br />
<input type="hidden" name="x{$BASEID}_path" />
<input type="hidden" name="x{$BASEID}_open" />
<input type="hidden" name="x{$BASEID}_open_module" />
</form>