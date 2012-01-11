<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td width="25%" valign="top" style="padding: 2px;">Kategorie wählen</td>
  <td width="25%" valign="top" style="padding: 2px;">
   <select name="x{$BASEID}_category">
    {foreach from=$CATEGORIES item=CATEGORY}
    <option value="{$CATEGORY.id}">{$CATEGORY.title}</option>
    {/foreach}
   </select>
  </td>
  <td width="50%" valign="top">
   <table cellpadding="0" cellspacing="0" width="100%">
    {foreach from=$FIELDS item=FIELD}
    <tr>
     <td width="50%" style="padding: 2px;">{$FIELD.title}</td>
     <td width="50%" style="padding: 2px;">
      <select name="x{$BASEID}_fields{$FIELD.id}">
       <option value="0">-- {"Please choose"|translate} --</option>
       {foreach from=$FIELD_VALUES[$FIELD.id] item=VALUE}
       <option value="{$VALUE.value}">{$VALUE.value}</option>
       {/foreach}
      </select>
     </td>
    </tr>
    {/foreach}
   </table>
  </td>
 </tr>
</table>