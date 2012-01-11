<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title"> {"System Settings"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"System Name"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_system_name" size="42" value="{$SYSTEM_NAME}" /></td>
 </tr>
 <tr>
  <td class="left">{"System E-Mail"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_system_email" size="42" value="{$SYSTEM_EMAIL}" /></td>
 </tr>
 <tr>
  <td class="view_header" colspan="2">
   <span class="title"> {"System Password"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"Set new Password"|translate}</td>
  <td class="right"><input type="password" name="x{$BASEID}_system_password" size="42" value="" /></td>
 </tr>
 <tr>
  <td class="left">{"Confirm new Password"|translate}</td>
  <td class="right"><input type="password" name="x{$BASEID}_system_password_confirm" size="42" value="" /></td>
 </tr>

 <tr>
  <td class="view_header" colspan="2">
   <span class="title"> {"Security Settings"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
 <tr>
  <td class="left">Override permission checks for files and images on download</td>
  <td class="right">
  <input type="radio" name="x{$BASEID}_disable_file_security" {if $FILE_SECURITY} checked="checked" {/if} value="true" /> Yes, use unsecure mode
  <input type="radio" name="x{$BASEID}_disable_file_security" {if !$FILE_SECURITY} checked="checked" {/if} value="false" /> No, do security checks on files and images
  </td>
 </tr>

 <td class="view_header" colspan="2">
   <span class="title"> {"Database Settings"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"Host"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_database_host" size="42" value="{$DATABASE_HOST}" /></td>
 </tr>
 <tr>
  <td class="left">{"Username"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_database_username" size="42" value="{$DATABASE_USERNAME}" /></td>
 </tr>
 <tr>
  <td class="left">{"Password"|translate}</td>
  <td class="right"><input type="password" name="x{$BASEID}_database_password" size="42" value="{$DATABASE_PASSWORD}" /></td>
 </tr>
 <tr>
  <td class="left">{"Database"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_database_database" size="42" value="{$DATABASE_DATABASE}" /></td>
 </tr>
 <tr>
  <td class="left">{"Prefix"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_database_prefix" size="42" value="{$DATABASE_PREFIX}" /></td>
 </tr>
 <tr>
  <td class="view_header" colspan="2">
   <span class="title"> {"Main META information"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"Site title (Base)"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_system_meta_title" size="42" value="{$SYSTEM_META_TITLE}" /></td>
 </tr>
 <tr>
  <td class="left">{"Site description (Default)"|translate}</td>
  <td class="right"><textarea name="x{$BASEID}_system_meta_description" cols="70" rows="6">{$SYSTEM_META_DESCRIPTION}</textarea></td>
 </tr>
 <tr>
  <td class="left">{"Site keywords (Default)"|translate}</td>
  <td class="right"><textarea name="x{$BASEID}_system_meta_keywords" cols="70" rows="6">{$SYSTEM_META_KEYWORDS}</textarea></td>
 </tr>
 <tr>
  <td class="left">{"Site copyright (Default)"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_system_meta_copyright" value="{$SYSTEM_META_COPYRIGHT}" size="42" /></td>
 </tr>
 <tr>
  <td class="left">{"Site author (Default)"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_system_meta_author" size="42" value="{$SYSTEM_META_AUTHOR}"/></td>
 </tr>
  <tr>
  <td class="left">{"Revisit after (Default)"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_system_meta_revisit_after" size="42" value="{$SYSTEM_META_REVISIT_AFTER}"/></td>
 </tr>
 <tr>
  <td class="view_header" colspan="2">
   <span class="title"> {"Google Keys"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"Piwik ID"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_system_piwik_id" size="120" value="{$SYSTEM_PIWIK_ID}" /></td>
 </tr>
 <tr>
  <td class="left">{"Google Analytics"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_system_google_analytics_key" size="42" value="{$SYSTEM_GOOGLE_ANALYTICS_KEY}" /></td>
 </tr>
 <tr>
  <td class="left">{"Google Maps"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_system_google_map_key" size="120" value="{$SYSTEM_GOOGLE_MAP_KEY}" /></td>
 </tr>
</table>
</form>