<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="POST" name="article">
{include file="includes/buttons.tpl" data=$LIST_ARTICLES_BUTTONS}
{include file="includes/lang_selector_simple.tpl" form="article"}
{include file="includes/charfilter.tpl" form="article"}
<input type="hidden" name="x{$BASEID}_id" value="" />
<input type="hidden" name="x{$BASEID}_page" value="" />
<input type="hidden" name="x{$BASEID}_save_lang" value="" />
<input type="hidden" name="x{$BASEID}_module" value="{$ADMINMODULE}" />

<table cellspacing="0" cellpadding="0" width="100%">
     <tr>
       <td class="table_header" width="70">{"options"|translate}</td>
       <td class="table_header" width="45">{actionIcon action="NULL" label="ID" form=article sort=$sort.0.value icon=$sort.0.icon}</td>
       <td class="table_header" width="60">{actionIcon action="NULL" label="art_nr" form=article sort=$sort.1.value icon=$sort.1.icon}</td>
       <td class="table_header">{actionIcon action="NULL" form=article label="Title" sort=$sort.2.value icon=$sort.2.icon}</td>
       <td class="table_header" width="60">&nbsp;</td>
      </tr>
      {foreach from=$DATA item=ENTRY}
      <tr class="{cycle values="row_a,row_b"}" {if $ENTRY.id==$ACTUAL_ID} style="background-color:#FFCCCC;"{/if}>
       <td class="button">
        {if $ENTRY.lang_active  == 1}
        {actionIcon
             action         = "deactivateArticleLang"
             icon           = "active.png"
             form           = "article"
             perm           = "activateArticle"
             title          = "deactivate article"
             nopermicon     = "active.gif"
             nopermtitle    = "article is active"
             yoffset        = "1"
             id             = $ENTRY.id
             save_lang      = $ENTRY.lang
        }{else}{actionIcon
             action         = "activateArticleLang"
             icon           = "inactive.png"
             form           = "article"
             perm           = "activateArticle"
             title          = "activate article"
             nopermicon     = "inactive.gif"
             nopermtitle    = "article is inactive"
             yoffset        = "1"
             id             = $ENTRY.id
             save_lang      = $ENTRY.lang
        }{/if}{if $ENTRY.product_of_month  == 1}{actionIcon
             action         = "product_of_month_unset"
             icon           = "star_yellow.png"
             form           = "article"
             perm           = "activateArticle"
             title          = "unset product of month"
             yoffset        = "1"
             id             = $ENTRY.id
             save_lang      = $ENTRY.lang
        }{else}{actionIcon
             action         = "product_of_month_set"
             icon           = "star_grey.png"
             form           = "article"
             perm           = "activateArticle"
             title          = "set product of month"
             yoffset        = "1"
             id             = $ENTRY.id
             save_lang      = $ENTRY.lang
        }{/if}{actionIcon
             action         = "editArticle"
             icon           = "pencil.png"
             target         = "slave1"
             form           = "0"
             perm           = "editArticle"
             title          = "edit article"
             id             = $ENTRY.id
        }{actionIcon
             action         = "duplicateArticle"
             icon           = "copy.png"
             form           = "article"
             perm           = "addArticle"
             title          = "duplicate article"
             yoffset        = "1"
             id             = $ENTRY.id
        }{actionIcon
             action         = "deleteArticle"
             icon           = "delete.png"
             ask            = "Are you sure to delete this article?"
             form           = "article"
             yoffset        = "1"
             perm           = "deleteArticle"
             title          = "Delete article"
             id             = $ENTRY.id
        }
       </td>
       <td class="row">
       {$ENTRY.id}
       </td>
       <td class="row">
       {$ENTRY.art_nr|default:"..."}
       </td>
       <td class="row">
       {$ENTRY.title|default:"?"}
       </td>
       <td class="button">{$EXT_OPTIONS[$ENTRY.id]}<img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
      </tr>
     {/foreach}
    </table>
{include file="includes/navigator.tpl" form="article" withouthidden=1}
<input type="hidden" name="x{$BASEID}_article_id" value="" />
<input type="hidden" name="x{$BASEID}_sort" value="" />
<input type="hidden" name="x{$BASEID}_contributed_action" value="" />
{yoffset}
</form>