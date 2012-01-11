{if count($IMAGES) > 0}
<table border="0" cellpadding="0" cellspacing="0" width="550">
  <tr>
  <td>
{foreach from=$IMAGES item=IMAGE}
<span>{image
      id=$IMAGE.id
      version=$VERSION
      title=$IMAGE.description
      alt=$IMAGE.description
      }</span>
    
{/foreach}
  </td>
</tr>
</table>
{/if}