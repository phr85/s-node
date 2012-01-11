{literal}
<script language="JavaScript"><!--
if(window.parent.frames['master']){

    window.parent.frames['master'].document.forms[1].submit();
}
//-->
</script>
{/literal}

<form method="POST" name="edit">
 {include file="includes/buttons.tpl" data=$EDIT_BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header"colspan="2"> <span class="title">{"Relation"|translate}</span></td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
 <td class="left">{"Title"|translate}&nbsp;</td>
  <td class="right">
  <input type="text" name="x{$BASEID}_title" value="{$RELATION.title}" size="45">
 </td>
 </tr>
 <tr>
 <td class="left">{"Description"|translate}&nbsp;</td>
  <td class="right">
  <input type="text" name="x{$BASEID}_description" value="{$RELATION.description}" size="45">
 </td>
 </tr>


 <tr>
  <td class="view_header"colspan="2"> <span class="title">{"Source"|translate}</span></td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
   <td class="left">{"Content type"|translate}&nbsp;</td>
  <td class="right">
  <select name="x{$BASEID}_source_content_type" onchange="document.forms['edit'].x{$BASEID}_source_content_id.value=0;document.forms['edit'].x{$BASEID}_action.value='saveRelation';document.forms['edit'].submit();">
  {foreach from=$CTYPES item=CTYPE}
    <option value="{$CTYPE.id}"{if $CTYPE.id == $RELATION.source_content_type} selected{/if}>{$CTYPE.title}</option>
  {/foreach}
  </select>
  </td>
 </tr>
 <tr>
  <td class="left">{"Content"|translate}&nbsp;<a name="content" /></td>
  <td class="right">
  {if $PICKER.source_template !=""}
            <a href="#content" onclick="popup('{$smarty.server.PHP_SELF}?TPL={$PICKER.source_template}&field=x{$BASEID}_source_content_id&form=edit',960,500);">
            <img src="images/icons/breakpoint_add.png" {"please select an item"|alttag}></a>
            <input type="text" name="x{$BASEID}_source_content_id_title" size="60" class="disabled" readonly value="{$RELATION.source_title}">
            <input type="hidden" name="x{$BASEID}_source_content_id" value="{$RELATION.source_content_id}">
            {else}
            <input type="text" name="x{$BASEID}_source_content_id" value="{$RELATION.source_content_id}"> ({$RELATION.source_title})
            {/if}
 </td>
 </tr>
 {if $RELATION.source_image > 0}
 <tr>
 <td class="left">&nbsp;</td>
 <td class="right">{image id=$RELATION.source_image version=0}</td>
 </tr>
 {/if}


 <tr>
  <td class="view_header"colspan="2"> <span class="title">{"Target"|translate}</span></td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"Content type"|translate}&nbsp;</td>
  <td class="right">
  <select name="x{$BASEID}_target_content_type" onchange="document.forms['edit'].x{$BASEID}_target_content_id.value=0;document.forms['edit'].x{$BASEID}_action.value='saveRelation';document.forms['edit'].submit();">
  {foreach from=$CTYPES item=CTYPE}
    <option value="{$CTYPE.id}"{if $CTYPE.id == $RELATION.target_content_type} selected{/if}>{$CTYPE.title}</option>
  {/foreach}
  </select>
  </td>
 </tr>
 <tr>
  <td class="left">{"Content"|translate}&nbsp;<a name="content" /></td>
  <td class="right">
  {if $PICKER.target_template !=""}
            <a href="#content" onclick="popup('{$smarty.server.PHP_SELF}?TPL={$PICKER.target_template}&field=x{$BASEID}_target_content_id&form=edit',960,500);">
            <img src="images/icons/breakpoint_add.png" {"please select an item"|alttag}></a>
            <input type="text" name="x{$BASEID}_target_content_id_title" size="60" class="disabled" readonly value="{$RELATION.target_title}">
            <input type="hidden" name="x{$BASEID}_target_content_id" value="{$RELATION.target_content_id}">
            {else}
            <input type="text" name="x{$BASEID}_target_content_id" value="{$RELATION.target_content_id}"> ({$RELATION.target_title})
            {/if}

 </td>
 </tr>
 {if $RELATION.target_image > 0}
 <tr>
 <td class="left">&nbsp;</td>
 <td class="right">{image id=$RELATION.target_image version=0}</td>
 </tr>
 {/if}

{if $RELATION.target_content_id == 0 && $RELATION.source_content_id == 0 }
 <tr>
  <td class="view_header"colspan="2"> <span class="title">{"Dublerelation"|translate}</span></td>
 </tr>
  <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
 <tr>
  <td class="left">{"Double relation"|translate}</td>
  <td class="right"><input type="checkbox" name="x{$BASEID}_double_relation" value="1">&nbsp;</td>
</tr>
{/if}
</table>
<input type="hidden" name="x{$BASEID}_relation_id" value="{$RELATION.id}" />
</form>