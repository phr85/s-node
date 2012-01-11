<div style="padding: 20px;">
<table cellspacing="0" cellpadding="0" width="100%">
 <tr style="height: 60px;">
  <td width="60"><img src="{$XT_IMAGES}icons/big/document_preferences.png" alt="" /></td>
  <td class="desktop_subtitle"><span class="admin_title">{"Tasks"|translate}</span><br />Sie haben keine neuen Aufgaben</td>
 </tr>
</table>
<br />
<table cellspacing="0" cellpadding="0" width="100%" class="desktop_container">
 <tr>
  <td style="padding: 10px; color: #FFFFFF;" valign="top">
   <table cellspacing="0" cellpadding="0" width="100%">
    {foreach from=$OPEN_TASKS item=TASK}
    <tr class="{cycle values=desktop_row_a,desktop_row_b}">
     <td class="desktop_row" align="center" style="padding-right: 0px;" width="16"><img src="{$XT_IMAGES}icons/documents_preferences.png" alt="{$TASK.priority}" /></td>
     <td class="desktop_row"><a href="{$INDEX_PHP}?TPL=561&x{$BASEID}_action=view&x{$BASEID}_id={$TASK.id}">{$TASK.title}</a></td>
     <td style="padding-right: 5px;" width="16"><input type="checkbox"></td>
    </tr>
    {/foreach}
   </table>
  </td>
 </tr>
</table>
</div>
