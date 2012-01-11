
 <tr>
  <td class="view_header" colspan="2">
   <span class="title"> {"article basics"|translate}</span>{inline_navigator_top anchor ="article_basics"}
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
{if $DISPLAY.status == 1}
<tr>
  <td class="left">{"Status"|translate}</td>
  <td class="right">
  {if $DATA.lang_active  == 1}
  {actionIcon
     action  = "deactivateArticleLang"
     icon    = "active.png"
     perm    = "activateArticle"
     form    = "editArticle"
     title   = "deactivate article"
     nopermicon = "active.gif"
     nopermtitle="article is active"
     yoffset    = "1"
   }{else}{actionIcon
     action  = "activateArticleLang"
     icon    = "inactive.png"
     perm    = "activateArticle"
     form    = "editArticle"
     title   = "activate article"
     nopermicon = "inactive.gif"
     nopermtitle="article is inactive"
     yoffset     = "1"
   }{/if}
  </td>
 </tr>
 {/if}
 {if $DISPLAY.title == 1}
 <tr>
  <td class="left">{"Title"|translate}</td>
  <td class="right"><input type="text" size="42" name="x{$BASEID}_title" value="{$DATA.title}" onchange="window.parent.document.title = this.value"></td>
 </tr>
 {/if}
 {if $DISPLAY.subtitle == 1}
 <tr>
  <td class="left">{"Subtitle"|translate}</td>
  <td class="right"><input type="text" size="42" name="x{$BASEID}_subtitle" value="{$DATA.subtitle}"></td>
 </tr>
 {/if}
 {if $DISPLAY.lead == 1}
 <tr>
  <td class="left">{"lead"|translate}</td>
  <td class="right">{toggle_editor id="lead"}
     <textarea id="x{$BASEID}_lead" name="x{$BASEID}_lead" rows="4" cols="65">{$DATA.lead}</textarea>
  </td>
 </tr>
 {/if}
 {if $DISPLAY.description == 1}
  <tr>
  <td class="left">{"Description"|translate}</td>
  <td class="right">{toggle_editor id="description"}
     <textarea id="x{$BASEID}_description" name="x{$BASEID}_description" rows="8" cols="65">{$DATA.description}</textarea>
  </td>
 </tr>
 {/if}
 {if $DISPLAY.art_nr == 1}
 <tr>
  <td class="left">{"article number"|translate}</td>
  <td class="right"><input type="text" size="12" name="x{$BASEID}_art_nr" value="{$DATA.art_nr}"></td>
 </tr>
 {/if}
 {if $DISPLAY.quantity == 1}
 <tr>
  <td class="left">{"quantity"|translate} / {"unit"|translate}</td>
  <td class="right">
   <input type="text" size="12" name="x{$BASEID}_quantity" value="{$DATA.quantity}"> /
   <select name=x{$BASEID}_unit>
    {html_options options=$UNITS selected=$DATA.unit}
   </select>
  </td>
 </tr>
  <tr>
  <td class="left">{"stock"|translate} / {"min stock"|translate}</td>
  <td class="right">
   <input type="text" size="12" name="x{$BASEID}_stock" value="{$DATA.stock}"> &nbsp;
   <input type="text" size="6" name="x{$BASEID}_min_stock" value="{$DATA.min_stock}">

  </td>
 </tr>
 {/if}
 {if $DISPLAY.packaging_unit == 1}
 <tr>
  <td class="left">{"pkg_unit"|translate}</td>
  <td class="right">
   <select name=x{$BASEID}_pkg_unit>
      <option label="{'Not selected'|translate}" value="0" {if $PKG_UNIT.id==0}selected="selected"{/if}>{'Not selected'|translate}</option>
   {foreach from=$PKG_UNITS item=PKG_UNIT}
   <option label="{$PKG_UNIT.short} / {$PKG_UNIT.standard}" value="{$PKG_UNIT.id}" {if $PKG_UNIT.id==$DATA.pkg_unit}selected="selected"{/if}>{$PKG_UNIT.short} / {$PKG_UNIT.standard}</option>
   {/foreach}
   </select>
  </td>
 </tr>
 {/if}