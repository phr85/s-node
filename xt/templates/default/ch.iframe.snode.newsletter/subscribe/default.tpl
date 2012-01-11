<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
{if $data.$BASEID.subscribe.SUBSCRIPTION_TRY && $data.$BASEID.subscribe.SUBSCRIPTION_OK}
<div style="color: green;">{"Thank you for your subscription"|translate}<br /><b>{$SUBSCRIPTION_EMAIL}</b><br /><br /></div>
{/if}
{if $data.$BASEID.subscribe.UNSUBSCRIPTION_OK}
<div style="color: green;">{"You were unsubscribed successfully"|translate}<br /><b>{$SUBSCRIPTION_EMAIL}</b><br /><br /></div>
{/if}
{if $data.$BASEID.subscribe.ERROR |count > 0}
{foreach from=$data.$BASEID.subscribe.ERROR item=e}
<div style="color: red;">{$e}<br/></div>
{/foreach}
{/if}

<table width="100%">
<tr>
 	<td width="100">{"Categories"|livetranslate}</td>
 	<td>
	 	{foreach from=$data.$BASEID.subscribe.CATEGORIES item=CATEGORY}
		<input type="checkbox" name="x{$BASEID}_category[{$CATEGORY.id}]" value="{$CATEGORY.id}"{if $CATEGORY.selected} checked="checked"{/if}/> {$CATEGORY.title}<br />
		{/foreach}
 	</td>
 </tr>
 <tr>
 	<td width="100">{"E-Mail"|livetranslate}</td>
 	<td><input type="text" name="x{$BASEID}_email" value="{$data.$BASEID.subscribe.email}" /></td>
 </tr>
 <tr>
 	<td width="100">{"Language"|livetranslate}</td>
 	<td>
		<select name="x{$BASEID}_lang">
	   {foreach from=$data.$BASEID.subscribe.LANGS key=KEY item=LANG}
	    <option value="{$KEY}" {if $KEY == $data.$BASEID.subscribe.lang}selected{/if}>{$LANG.name|translate}</option>
	   {/foreach}
	   </select>
	</td>
 </tr>
  <tr>
 	<td width="100">{"title"|livetranslate}</td>
 	<td><input type="text" name="x{$BASEID}_title" value="{$data.$BASEID.subscribe.title}" /></td>
 </tr>
  <tr>
 	<td width="100">{"salutation"|livetranslate}</td>
 	<td><input type="text" name="x{$BASEID}_anrede" value="{$data.$BASEID.subscribe.anrede}" /></td>
 </tr>
 <tr>
 	<td width="100">{"first name"|livetranslate}</td>
 	<td>
 	<input type="text" name="x{$BASEID}_firstname" value="{$data.$BASEID.subscribe.firstname}" />
 	<input type="hidden" name="x{$BASEID}_needed_fields[firstname]" value="{"please enter your firstname"|translate}" />
 	</td>
 </tr>
  <tr>
 	<td width="100">{"last name"|livetranslate}</td>
 	<td>
 	<input type="text" name="x{$BASEID}_lastname" value="{$data.$BASEID.subscribe.lastname}" />
 	<input type="hidden" name="x{$BASEID}_needed_fields[lastname]" value="{"please enter your lastname"|translate}" />
 	</td>
 	
 </tr>
  <tr>
 	<td width="100">{"company"|livetranslate}</td>
 	<td><input type="text" name="x{$BASEID}_company" value="{$data.$BASEID.subscribe.company}" /></td>
 </tr>
  <tr>
 	<td width="100">{"mobile"|livetranslate}</td>
 	<td><input type="text" name="x{$BASEID}_mobile" value="{$data.$BASEID.subscribe.mobile}" /></td>
 </tr>
 <tr>
 	<td colspan="2">
 	<select name="x{$BASEID}_unsubscribe">
       <option value="no" selected>anmelden</option>
       <option value="yes">abmelden</option>
    </select>
		</td>
 </tr>
  <tr>
 	<td colspan="2">
 		<input type="submit" value="{'Ok'|translate}" />
	</td>
  </tr>
 </table>

       
</form>