<table cellpadding="0" cellspacing="0">
 <tr>
  <td><img src="{$PIC_DIR}{$PIC}" alt="{$PIC_ALT}" title="{$PIC_ALT}"></td>
 </tr>
 {if $SHOW_DESC == 1}
 <tr>
  <td style="padding: 5px;background-color: #BBBBBB;">{$PIC_DESC}&nbsp;</td>
 </tr>
 {/if}
 {if $SHOW_DETAILS == 1}
 <tr>
  <td style="padding: 5px;background-color: #CCCCCC; border-top: 1px dotted #999999;">{"Original filename"|translate}: {$PIC_ALT}</td>
 </tr>
 <tr>
  <td style="padding: 5px;background-color: #CCCCCC; border-top: 1px dotted #999999;">{"Original resolution"|translate}: {$PIC_WIDTH} x {$PIC_HEIGHT}</td>
 </tr>
 <tr>
  <td style="padding: 5px;background-color: #CCCCCC; border-top: 1px dotted #999999;">{"Original filesize"|translate}: {$PIC_FILESIZE/1000} KB</td>
 </tr>
 {/if}
</table>