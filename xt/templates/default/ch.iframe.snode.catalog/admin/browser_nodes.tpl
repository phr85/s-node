 <form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="POST" name="browser_nodes">
 {include file="includes/buttons.tpl" data=$BROWSER_BUTTONS}

 {include file="includes/lang_selector_simple.tpl" form="browser_nodes"}
<table cellspacing="0" cellpadding="0" width="100%">
     <tr>
       <td class="table_header" width="80">{"options"|translate}</td>
       <td class="table_header" width="70">{"image"|translate}</td>
       <td class="table_header" width="60">{"art_nr"|translate}</td>
       <td class="table_header">{"title"|translate}</td>
       <td class="table_header" width="60">&nbsp;
       <input type="hidden" name="x{$BASEID}_module" value="{$ADMINMODULE}">
       <input type="hidden" name="x{$BASEID}_article_id" value="">
       <input type="hidden" name="x{$BASEID}_property_id" value="">
       <input type="hidden" name="x{$BASEID}_id" value="">
       <input type="hidden" name="x{$BASEID}_node_pid" value="">
       <input type="hidden" name="x{$BASEID}_node_id" value="">
       <input type="hidden" name="x{$BASEID}_save_lang" value="">
       <input type="hidden" name="x{$BASEID}_position" value="">

       </td>
      </tr>
      {foreach from=$ARTICLES item=ENTRY}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="button">
        {if $ENTRY.lang_active  == 1}{actionIcon
             action         = "deactivateArticleLang"
             icon           = "active.png"
             form           = "browser_nodes"
             perm           = "activateArticle"
             title          = "deactivate article"
             nopermicon     = "active.gif"
             nopermtitle    = "article is active"
             id             = $ENTRY.id
             save_lang      = $ENTRY.lang
             yoffset        = "1"
        }{else}{actionIcon
             action         = "activateArticleLang"
             icon           = "inactive.png"
             form           = "browser_nodes"
             perm           = "activateArticle"
             title          = "activate article"
             nopermicon     = "inactive.gif"
             nopermtitle    = "article is inactive"
             id             = $ENTRY.id
             save_lang      = $ENTRY.lang
             yoffset        = "1"
        }{/if}{actionIcon
             action         = "editArticle"
             icon           = "pencil.png"
             form           = "browser_nodes"
             perm           = "editArticle"
             title          = "edit article"
             id             = $ENTRY.id
        }{actionIcon
             action         = "browserRemoveArticleFromTree"
             icon           = "delete.png"
             form           = "browser_nodes"
             perm           = "browserArticles"
             title          = "remove article association from node"
             ask            = "Are you sure to remove this article from this node?"
             article_id             = $ENTRY.id
             node_id        = $ENTRY.node_id
             yoffset        = "1"
        }
       </td>
       <td class="row">
       {if $ENTRY.image_id != ''}{image
       id = $ENTRY.image_id
       version = 0
       }{else}&nbsp;{/if}
       </td>
       <td class="row">
       {$ENTRY.art_nr|default:"..."}
       </td>
       <td class="row">
       <b>{$ENTRY.title|default:"?"}</b><br />
       {$ENTRY.lead|default:"?"}
       </td>
       <td class="row">
       {actionIcon
             action         = "moveNodeDown"
             icon           = "explorer/arrow_down_green.png"
             form           = "browser_nodes"
             perm           = "browserArticles"
             title          = "move down"
             article_id             = $ENTRY.id
             position       = $ENTRY.position
             yoffset        = "1"
        }{actionIcon
             action         = "moveNodeUp"
             icon           = "explorer/arrow_up_green.png"
             form           = "browser_nodes"
             perm           = "browserArticles"
             title          = "move up"
             article_id             = $ENTRY.id
             position       = $ENTRY.position
             yoffset        = "1"
        }
&nbsp;
       </td>
      </tr>
     {/foreach}
    </table>
    {yoffset}
    </form>

