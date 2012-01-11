{literal}
<script language="JavaScript"><!--
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>
{/literal}

<form method="post" name="edit">
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Room"|translate}:</span> <span class="title">{$ROOM.title}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$BUTTONS withouthidden=1}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"Title"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_title" size="42" value="{$ROOM.title|htmlspecialchars}"></td>
 </tr>
 <tr>
  <td class="left">{"Description"|translate}</td>
  <td class="right">{toggle_editor id="description"}
  <textarea id="x{$BASEID}_description" name="x{$BASEID}_description" rows="4" cols="65">{$ROOM.description}</textarea></td>
 </tr>

  <tr>
  <td class="left">{"Area in m2"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_area" size="6" value="{$ROOM.area}"></td>
 </tr>

  <tr>
  <td class="left">{"seats"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_seats" size="6" value="{$ROOM.seats}"></td>
 </tr>


 <tr>
  <td class="left">{"Contact Person"|translate}<a name="contact_picker" /></td>
  <td class="right">
  <input size="40" type="text" readonly="yes" class="disabled" id="x{$BASEID}_contact_person_title" name="x{$BASEID}_contact_title" value="{if $ROOM.contact_person > 0}{$CONTACT_PERSON.title}, {$CONTACT_PERSON.street}, {$CONTACT_PERSON.postalCode} {$CONTACT_PERSON.city}{/if}" />
  {actionPopUp
    icon="breakpoint_add.png"
    title="Pick an image"|translate
    TPL=$ADDR_PICKER_TPL
    BASEID=4500
    fieldBaseId=$BASEID
    fieldName="contact_person"
    form="edit"
    name="contact_picker"
    anker="contact_picker"
}<input type="hidden" id="x{$BASEID}_contact_person" name="x{$BASEID}_contact_person" value="{$CONTACT_PERSON.id}" /></td>
 </tr>


</table>


{include file="ch.iframe.snode.roombooking/admin/hiddenValues.tpl"}
{include file="includes/editor.tpl"}
</form>
