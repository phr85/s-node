<form method="POST" name="view">
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header">
   <span class="title">{$FILE.title}</span>
   <span class="subline"><br />{"Uploaded"|translate}: {$FILE.upload_date|date_format:"%d.%m.%Y %H:%I:%S"} - {"Uploaded by"|translate}: {$FILE.username}</span>
  </td>
  <td class="view_header" align="right"><a href="{$smarty.server.PHP_SELF}?TPL=658&x{$BASEID}_file_id={$FILE.id}&x{$BASEID}_file_name={$FILE.title}"><img src="{$XT_IMAGES}icons/view.png" alt="" class="icon" /></a></td>
 </tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 {if $FILE.description != ''}
 <tr>
  <td class="view_header" colspan="4">
   <span class="subline">{$FILE.description}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 {/if}
 {if $FILE.type == 3}
 <tr>
  <td class="view_header" colspan="4">
   <span><img src="tmp.png?{$TIME}" alt="" /></span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 {/if}
 {if $FILE.type == 2}
 <tr>
  <td class="view_header" colspan="4">
   <span><embed width="100%" src="{$smarty.server.PHP_SELF}?TPL=658&x{$BASEID}_file_id={$FILE.id}&x{$BASEID}_file_name={$FILE.title}" alt=""></span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 {/if}
 {if $FILE.type == 1}
 <tr>
  <td class="view_header" colspan="4">
   <span><img src="{$smarty.server.PHP_SELF}?TPL=658&x{$BASEID}_file_id={$FILE.id}&x{$BASEID}_file_name={$FILE.title}" alt="" /></span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 {/if}
 <tr>
  <td class="view_left">{"File size"|translate}:</td>
  <td class="view_right" colspan="2">{$FILE.filesize|format_filesize}</td>
 </tr>
 {if $FILE.keywords != ''}
 <tr>
  <td class="view_left">{"Keywords"|translate}:</td>
  <td class="view_right" colspan="2">{$FILE.keywords}</td>
 </tr>
 {/if}
 <tr>
  <td colspan="4">{include file="includes/buttons.tpl" data=$VIEW_BUTTONS}</td>
 </tr>
 {foreach from=$RELATIONS item=RELATION}
 <tr>
  <td class="view_left" style="padding-bottom: 3px; padding-right: 0px;">
   <table cellspacing="0" cellpadding="0" width="100%">
    <tr>
     <td style="width: 16px; padding-right: 5px;"><img src="{$XT_IMAGES}icons/{$RELATION.icon}" alt="" /></td>
     <td style="color: #999999;">{$RELATION.content_type_title|translate}</td>
    </tr>
   </table>
  </td>
  <td class="view_right">{$RELATION.title}</td>
  <td class="button" align="right">{
  actionIcon
        action="deleteRelation"
        icon="delete.png"
        form="0"
        file_id=$FILE.id
        before_content_id=$RELATION.target_content_id
        before_content_type=$RELATION.target_content_type
        title="Delete this relation"
        ask="Are you sure you want to delete this relation?"
  }</td>
 </tr>
 {/foreach}
</table>
<input type="hidden" name="x{$BASEID}_node_id" />
<input type="hidden" name="x{$BASEID}_node_pid" />
<input type="hidden" name="x{$BASEID}_position" />
<input type="hidden" name="x{$BASEID}_before_content_id" />
<input type="hidden" name="x{$BASEID}_before_content_type" />
<input type="hidden" name="x{$BASEID}_file_id" value="{$FILE.id}" />
<input type="hidden" name="x{$BASEID}_file_name" />
</form>
