<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="POST" name="article">
{include file="includes/buttons.tpl" data=$LIST_ARTICLES_BUTTONS}
{include file="includes/lang_selector_simple.tpl" form="article"}
{include file="includes/charfilter.tpl" form="article"}

<input type="hidden" name="x{$BASEID}_id" value="">
<input type="hidden" name="x{$BASEID}_save_lang" value="">
<input type="hidden" name="x{$BASEID}_module" value="{$ADMINMODULE}">
<table cellspacing="0" cellpadding="0" width="100%">
     <tr>
       <td class="table_header" width="80">{"options"|translate}</td>
       <td class="table_header" width="40"><b>ID</b></td>
       <td class="table_header" width="*">{"title"|translate}</td>
       <td class="table_header" width="60">&nbsp;</td>
      </tr>

      {foreach from=$DATA item=ENTRY}
      <tr class="{cycle values="row_a,row_b"}">
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
        }{/if}{actionIcon
             action         = "editArticle"
             icon           = "pencil.png"
             target         = "slave1"
             form           = "0"
             perm           = "editArticle"
             title          = "edit article"
             id             = $ENTRY.id
        }{actionIcon
             action         = "deleteArticle"
             icon           = "delete.png"
             ask            = "Are you sure to delete this article?"
             form           = "article"
             yoffset        = "1"
             perm           = "deleteArticle"
             title          = "edit article"
             id             = $ENTRY.id
        }

       </td>
       <td class="row">
       {$ENTRY.id}
       </td>
       <td class="row">
       {$ENTRY.title|default:"?"}
       </td>
       <td class="row">{$EXT_OPTIONS[$ENTRY.id]}<img src="{$XT_IMAGES}spacer.gif" alt=""></td>
      </tr>
     {/foreach}
    </table>
{include file="includes/navigator.tpl" form="article"}
<input type="hidden" name="x{$BASEID}_article_id" value="">
<input type="hidden" name="x{$BASEID}_contributed_action" value="">
{yoffset}
</form>