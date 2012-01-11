<br><b>Image gallery</b> Folder: <b>{$FOLDER}</b> - Per Page: <b>{$PER_PAGE}</b> - Per Line: <b>{$PER_LINE}</b> - Show Descriptions: <b>{$SHOW_DESC}</b> - Version: <b>{$VERSION}</b><br><br>
<table cellpadding="0" cellspacing="0" style="border: 1px solid black;">
 <tr>
 {foreach from=$PICTURES item=PIC name=G}
  {if $smarty.foreach.G.iteration%$PER_LINE == 1}
   </tr><tr>
  {/if}
  <td style="padding: 6px;{cycle values="background-color: #EEEEEE;,background-color: #DDDDDD;"}"><img src="{$PIC_DIR}{$PIC.id}" alt="{$PIC.title}" title="{$PIC.title}" style="border: 1px solid #CCCCCC;"></td>
 {/foreach}
 </tr>
</table>