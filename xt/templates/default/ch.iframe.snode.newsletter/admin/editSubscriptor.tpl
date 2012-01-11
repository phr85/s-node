<script language="JavaScript"><!--
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>
<form method="post" name="edit" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
<h2><span class="light">{"edit subscriber"|translate}:</span> {$CATEGORY.title}</h2>
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">

<tr>
  <td class="left">{"Categories"|translate}</td>
  <td class="right">
   
   {foreach from=$CATEGORIES item=CATEGORY} 
   {if $CATEGORY.selected}
   
   {actionIcon
       action="deleteSubscriber"
       icon="delete.png"
       form="edit"
       title="Unsubscribe"
       ask="Are you sure that you want to unsubscribe from this category"
       scategory_id=$CATEGORY.id
   }
   {else}
   <input type="checkbox" name="x{$BASEID}_categories[]" value="{$CATEGORY.id}" />
    {/if}
    {$CATEGORY.title}<br />
   {/foreach}
   
  </td>
 </tr>
<tr>
  <td class="left">{"Language"|translate}</td>
  <td class="right">
	<select name="x{$BASEID}_lang">
   {foreach from=$LANGS key=KEY item=LANG}
    <option value="{$KEY}" {if $KEY == $SUBSCRIBER.lang}selected{/if}>{$LANG.name|translate}</option>
   {/foreach}
   </select>
  </td>
 </tr>
 <tr>
  <td class="left">{"email"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_email" size="45" value="{$SUBSCRIBER.email}"></td>
 </tr>
 <tr>
  <td class="left">{"name"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_name" size="45" value="{$SUBSCRIBER.name}"></td>
 </tr>
 <tr>
  <td class="left">{"title"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_title" size="45" value="{$SUBSCRIBER.title}"></td>
 </tr>
 <tr>
  <td class="left">{"salutation"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_anrede" size="45" value="{$SUBSCRIBER.anrede}"></td>
 </tr>
 <tr>
  <td class="left">{"first name"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_firstname" size="45" value="{$SUBSCRIBER.firstname}"></td>
 </tr>
 <tr>
  <td class="left">{"last name"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_lastname" size="45" value="{$SUBSCRIBER.lastname}"></td>
 </tr>
 <tr>
  <td class="left">{"company"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_company" size="45" value="{$SUBSCRIBER.company}"></td>
 </tr>
 <tr>
  <td class="left">{"mobile"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_mobile" size="45" value="{$SUBSCRIBER.mobile}"></td>
 </tr>
</table>

<input type="hidden" name="x{$BASEID}_newsletter_id" />
{include file="ch.iframe.snode.newsletter/admin/hiddenValues.tpl"}
{include file="includes/editor.tpl"}
</form>
