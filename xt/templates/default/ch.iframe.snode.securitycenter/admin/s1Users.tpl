<form method="POST" name="s1">
{include file="ch.iframe.snode.securitycenter/admin/hiddenValues.tpl"}
{include file="includes/buttons.tpl" data=$BUTTONS withouthidden=1}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header">
  <span class="title_light">{"User"|translate}:</span> <span class="title">{$USER.username}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 {if $USER.description != ''}
 <tr>
  <td class="view_header" colspan="2"><span class="subline">{$USER.description}</span></td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 {/if}
 {if $USER.firstName != "" || $USER.lastName != ''}
 <tr>
  <td class="view_left">{"Name"|translate}</td>
  <td class="view_right"><b>{$USER.firstName} {$USER.lastName}</b>&nbsp;</td>
 </tr>
 {/if}
 {if $USER.email != ""}
 <tr>
  <td class="view_left">{"email"|translate}</td>
  <td class="view_right">{$USER.email}&nbsp;</td>
 </tr>
 {/if}
 {if $USER.lang != ""}
  <tr>
  <td class="view_left">{"lang"|translate}</td>
  <td class="view_right" style="padding-top: 5px; padding-bottom: 2px;"><img src="/images/lang/{$USER.lang}.png" />&nbsp;</td>
 </tr>
 {/if}
 {if $USER.last_login_date != 0}
  <tr>
  <td class="view_left">{"last_login_date"|translate}</td>
  <td class="view_right">{$USER.last_login_date|date_format:"%A, %e. %B %Y um %T"}&nbsp;</td>
 </tr>
 {/if}
 {if $USER.mod_user != ""}
   <tr>
  <td class="view_left">{"mod_user"|translate}</td>
  <td class="view_right">{$USER.mod_user}&nbsp;</td>
 </tr>
 {/if}
 {if $USER.mod_date != 0}
  <tr>
  <td class="view_left">{"mod_date"|translate}</td>
  <td class="view_right">{$USER.mod_date|date_format:"%A, %e. %B %Y um %T"}&nbsp;</td>
 </tr>
 {/if}
 {if $USER.creation_user != ""}
  <tr>
  <td class="view_left">{"creation_user"|translate}</td>
  <td class="view_right">{$USER.creation_user}&nbsp;</td>
 </tr>
 {/if}
 {if $USER.creation_date != 0}
  <tr>
  <td class="view_left">{"creation_date"|translate}</td>
  <td class="view_right">{$USER.creation_date|date_format:"%A, %e. %B %Y um %T"}&nbsp;</td>
 </tr>
 {/if}
 {if $USER.image > 0}
  <tr>
  <td class="view_left">{"Image"|translate}</td>
  <td class="view_right">{image
      id=$USER.image
      version=2
      title=$USER.firstName
      alt=$USER.firstName
      }&nbsp;</td>
 </tr>
 {/if}
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 </table>
</form>
