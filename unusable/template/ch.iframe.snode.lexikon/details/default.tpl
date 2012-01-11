<table style="width: 100%; height:460px;" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%" valign="top">
     <table style="width: 100%;" border="0" cellpadding="0" cellspacing="0">
      <tr>
       <td width="50%"><div class="titlebar">{"Lexikon details"|translate}</div></td>
      </tr>
      <tr>
       <td class="producttitle">{$DATA.title}<br /></td>
      </tr>
      <tr>
       <td align="center">{image
      id=$DATA.image_id
      version=1
      title=$DATA.field_text
      alt=$DATA.field_text
      width=180
      }<br /></td>
      </tr>
      <tr>
       <td style="font-weight:bold; height:35px;">{$DATA.field_text|nl2br}<br /></td>
      </tr>
     </table>
    </td>
    <td width="50%" style="padding-left: 14px;" valign="top">
     <table style="width: 100%;" border="0" cellpadding="0" cellspacing="0">
      <tr>
      <td width="50%"><div class="titlebar">{"Detailed Informations"|translate}</div></td>
      </tr>
      <tr>
       <td class="producttitle">{$DATA.title}<br /></td>
      </tr>
      <tr>
       <td>{$DATA.lead}<br /></td>
      </tr>
      {foreach from=$FIELDS item=FIELD}
      <tr>
       <td><br /><b>{$FIELD.fieldname}:</b> {$FIELD.value|nl2br}<br />
       </td>
      </tr>
      {/foreach}
      <tr>
       <td><br /><br />
       <table cellpadding="0" cellspacing="0" style="height: 25px;">
        <tr>
         <td><img src="{$XT_IMAGES}live/info.gif" alt="" /></td>
         <td style="font-size: 12px; font-weight: bold; font-style: italic; padding-left: 5px;"><a href="{$smarty.server.PHP_SELF}?TPL={get_param param='products_tpl'}&amp;x{get_param param='products_baseid'}_lexikon_id={$DATA.id}">Produkte mit {$DATA.title}</a></td>
        </tr>
       </table>
       <table cellpadding="0" cellspacing="0" style="height: 25px;">
        <tr>
         <td><img src="{$XT_IMAGES}live/back.gif" alt="" /></td>
         <td style="font-size: 12px; font-weight: bold; font-style: italic; padding-left: 5px;"><a href="{$smarty.server.PHP_SELF}?TPL={get_param param='overview_tpl'}">{"back to overview"|translate}</a></td>
        </tr>
       </table>
       </td>
      </tr>
     </table>
    </td>
  </tr>
</table>
