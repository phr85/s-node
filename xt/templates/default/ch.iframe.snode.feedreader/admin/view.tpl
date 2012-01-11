<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Feed"|translate}:</span><span class="title">&nbsp;{$FEED.title|utf8enc}&nbsp;({$FEED.url / $FEED.link})</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 {if $FEED.generator != ''}
 <tr>
  <td class="view_left">{"Generator"|translate}</td>
  <td class="view_right">{$FEED.generator}&nbsp;</td>
 </tr>
 {/if}
 {if $FEED.protocol != ''}
 <tr>
  <td class="view_left">{"Protocol"|translate}</td>
  <td class="view_right">{$FEED.protocol}&nbsp;</td>
 </tr>
 {/if}
 {if $FEED.language != ''}
 <tr>
  <td class="view_left">{"Language"|translate}</td>
  <td class="view_right">{$FEED.language}&nbsp;</td>
 </tr>
 {/if}
 {if $FEED.copyright != ''}
 <tr>
  <td class="view_left">{"Copyright"|translate}</td>
  <td class="view_right">{$FEED.copyright}&nbsp;</td>
 </tr>
 {/if}
 {if $FEED.docs != ''}
 <tr>
  <td class="view_left">{"Docs"|translate}</td>
  <td class="view_right">{$FEED.docs}&nbsp;</td>
 </tr>
 {/if}
 {if $FEED.image_url != ''}
 <tr>
  <td class="view_left">{"Image"|translate}</td>
  <td class="view_right"><img src="{$FEED.image_url}" alt="{$FEED.image_title}" width="{$FEED.image_width}" height="{$FEED.image_height}" /><br />{$FEED.image_description}&nbsp;</td>
 </tr>
 {/if}
 {if $FEED.description != ''}
 <tr>
  <td class="view_left">{"Description"|translate}</td>
  <td class="view_right">{$FEED.description}</td>
 </tr>
 {/if}
 {if $FEED.lastbuilddate != ''}
 <tr>
  <td class="view_left">{"Last build date"|translate}</td>
  <td class="view_right">{$FEED.lastbuilddate}&nbsp;</td>
 </tr>
 {/if}
 {if $FEED.managingeditor != ''}
 <tr>
  <td class="view_left">{"Managing editor"|translate}</td>
  <td class="view_right">{$FEED.managingeditor}&nbsp;</td>
 </tr>
 {/if}
 {if $FEED.pubdate != ''}
 <tr>
  <td class="view_left">{"Publish date"|translate}</td>
  <td class="view_right">{$FEED.pubdate}&nbsp;</td>
 </tr>
 {/if}
</table>

<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header">
   <span class="title_light">{"Entries"|translate}:</span><span class="title"> {$ITEMS_COUNT}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 {foreach from=$ITEMS item=entry}
  <tr>
  <td class="view_right">{if $entry.link != ''}<a href="{$entry.link}" target="_blank" title="{$entry.title}">{/if}{$entry.title}{if $entry.link != ''}</a>{/if}</td>
 </tr>
 <tr>
  <td class="view_left">

  {if $entry.author != ''}
  {"Author"|translate}: {$entry.author|utf8enc}<br /><br />
  {/if}

  {if $entry.createddate != ''}
  {"Created"|translate}: {$entry.createdate|utf8enc}<br /><br />
  {/if}

  {if $entry.published != ''}
  {"Published"|translate}: {$entry.published|date_format:"%H:%I:%S %d %B %Y"|utf8enc}<br /><br />
  {/if}

  {if $entry.moddate != ''}
  {"Modified"|translate}: {$entry.moddate|utf8enc}<br /><br />
  {/if}

  {$entry.summary}

  {if $entry.comments != ''}
  <br /><a href="{$entry.comments}" title="{"Comment this entry"|translate}">{"Comments"|translate}</a><br /><br />
  {/if}
  </td>
 </tr>
 {/foreach}
</table>
<form method="post" name="edit">
<input type="hidden" name="x{$BASEID}_feed_id" />
<input type="hidden" name="x{$BASEID}_action" />
</form>