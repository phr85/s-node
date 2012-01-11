<form method="post" name="overview">
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr class="{cycle value=row_a,row_b}">
  <td class="row">{"Choose theme"|translate}</td>
  <td class="row" align="right" style="padding: 4px;">
   <select name="dummy" onchange="this.form.x{$BASEID}_theme.value=this.options[this.selectedIndex].value;this.form.submit();">
       {foreach from=$THEMES item=THEME_NAME}
       <option {if $THEME_NAME == $THEME}selected{/if} value="{$THEME_NAME}">{$THEME_NAME}</option>
       {/foreach}
   </select>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 {foreach from=$THEME_FILES item=FILE}
 <tr class="{cycle value=row_a,row_b}">
  <td colspan="2">
   <table cellspacing="0" cellpadding="0" width="100%">
   <tr>
    <td class="button" width="20"><img src="{$XT_IMAGES}icons/pens.png" alt="" /></td>
    <td class="row" style="padding: 5px; padding-right: 0px; padding-left: 3px;">
    {if $FILE.theme != "default"}
    {
   actionLink
       action="edit"
       form="0"
       text=$FILE.name
       file=$FILE.name
       theme=$FILE.theme
       target="slave1"
   }
   {else}
    {$FILE.name}
   {/if}
    </td>
    <td class="button" width="80" align="right">
	{if $FILE.theme != "default"}
	{actionIcon
       action="edit"
       icon="document_edit.png"
       form="0"
       title="Edit the stylesheet"
       file=$FILE.name
       theme=$FILE.theme
       target="slave1"
   }
    {else}
    {actionIcon
       action="overtake"
       icon="breakpoint_into.png"
       form="overview"
       title="Overtake the stylesheet"
       file=$FILE.name
       theme=$THEME
       target="master"
       ask="Are you sure to overtake this file?"
   }
   {/if}
   {actionIcon
       action="view"
       icon="view.png"
       form="0"
       title="View the stylesheet"
       file=$FILE.name
       theme=$FILE.theme
       target="slave1"
   }
	</td>
   </tr>
   </table>
  </td>
 </tr>
 {/foreach}
</table>
<input type="hidden" name="x{$BASEID}_theme" value="" />
<input type="hidden" name="x{$BASEID}_file" value="" />
</form>
