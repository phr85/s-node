<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Expression"|translate}:</span><span class="title"> {$EXP|truncate:25:"..."} {if $PACKAGE_TITLE != ""}({$PACKAGE_TITLE}){/if}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellpadding="0" cellspacing="0" width="100%">
 <tr class="row_b">
  <td class="row" colspan="2"><textarea name="x{$BASEID}_new_exp"rows="2" cols="50" style="background-color:#EEEEEE;" readonly>{$EXP}</textarea></td>
 </tr>
 {foreach from=$LANGS key=KEY item=LANG}
 <tr class="{cycle values=row_a,row_a,row_b,row_b}">
  <td class="button" width="20" style="padding-right: 0px;"><img src="{$XT_IMAGES}lang/{$KEY}.png" alt="" /></td>
  <td class="row" style="padding-left: 0px;"><b>{$LANG.name|translate}</b></td>
 </tr>
 <tr class="{cycle values=row_a,row_a,row_b,row_b}">
  <td class="row" colspan="2">{toggle_editor id="translations[$EXP][$KEY]"}
  <textarea name="x{$BASEID}_translations[{$EXP}][{$KEY}]" id="x{$BASEID}_translations[{$EXP}][{$KEY}]" rows="5" cols="50">{$TRANSLATION.$KEY}</textarea></td>
 </tr>
 {/foreach}
</table>
<input type="hidden" name="x{$BASEID}_old_exp" value="{$EXP}" />
<input type="hidden" name="x{$BASEID}_exp" />
<input type="hidden" name="msg" value="{$EXP}" />
<input type="hidden" name="package" value="{$PACKAGE_TITLE}"/>
{yoffset}
</form>
 {include file="includes/editor.tpl"}