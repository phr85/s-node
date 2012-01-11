<form method="POST" name="overview" onSubmit="window.document.forms['overview'].x{$BASEID}_yoffset.value= window.pageYOffset;">
{include file="includes/buttons.tpl" data=$OVERVIEW_BUTTONS}
{include file="includes/lang_selector_simple.tpl" form="overview"}
<table cellspacing="0" cellpadding="0" width="100%">
{foreach from=$RELATIONS key=CONTENT_TYPE item=CTYPE}
        <tr class="{cycle values=row_a,row_b}">
            <td class="row" style="padding-left: 8px; width: 1px;">
                <a href="javascript:document.forms['overview'].x{$BASEID}_open_ct.value={$CONTENT_TYPE};document.forms['overview'].submit();">
                    {if $CONTENT_TYPE == $OPEN_CT}
                        <img src="{$XT_IMAGES}icons/minus.gif" alt="" />
                    {else}
                        <img src="{$XT_IMAGES}icons/plus.gif" alt="" />
                    {/if}
                </a>
            </td>
            <td class="button" width="16">
                <a href="javascript:document.forms['overview'].x{$BASEID}_open_ct.value={$CONTENT_TYPE};document.forms['overview'].submit();">
                    {if $CONTENT_TYPE == $OPEN_CT}
                        <img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />
                    {else}
                        <img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="" />
                    {/if}
                </a>
            </td>
            <td class="row" colspan="3">
                <a href="javascript:document.forms['overview'].x{$BASEID}_open_ct.value={$CONTENT_TYPE};document.forms['overview'].submit();">
                    {if $CONTENT_TYPE == $OPEN_CT}
                        <span style="color: black; font-weight:bold;">{$CTYPE.title}</b></span>
                    {else}
                        {$CTYPE.title}
                    {/if}
                </a>
            </td>
        </tr>


        {if count($CTYPE.relation) > 0 && $CONTENT_TYPE == $OPEN_CT}
        {foreach from=$CTYPE.relation key=CID item=RELATION}
        <tr class="{cycle values=row_a,row_b}">
            <td class="row">&nbsp;</td>
            <td class="button"><img src="{$XT_IMAGES}icons/document.png" alt="" /></td>
            <td class="row" colspan="2">
            <a href="javascript:document.forms['overview'].x{$BASEID}_open_element.value={$CID}; document.forms['overview'].submit();">
            {if $OPEN_ELEMENT == $CID}<span style="color: black; font-weight:bold;">{$RELATION.title|default:"unknown"}</span>{else}{$RELATION.title|default:"unknown"}{/if}</a>  (ID={$CID})
            </td>
            <td class="button" align="right" width="60">
            {if $RELATIONS[$CONTENT_TYPE].open_url !=""}
                <a href="{prepare_url url=$RELATIONS[$CONTENT_TYPE].open_url id=$CID}" target="_blank"><img src="{$XT_IMAGES}icons/view.png" alt="" /></a>
            {/if}
            </td>
        </tr>
        {if count($RELATION.elements) > 0 &&  $CID == $OPEN_ELEMENT}
           {foreach from=$RELATION.elements item=OPPONENT name=DEVIL}
             <tr class="{cycle values=row_a,row_b}">
                <td class="row">&nbsp;</td>
                <td class="row">&nbsp;</td>
                <td class="button" width="16"><img src="{$XT_IMAGES}icons/{if $OPPONENT.doublerelation}refresh.png{else}{if $OPPONENT.relation_type =='target'}explorer/arrow_left_green.png{else}explorer/arrow_right_green.png{/if}{/if}" /></td>
                <td class="row">{if $OPPONENT.relation_title !=""}{$OPPONENT.relation_title}<br />{/if}
                {actionLink
                    action="editRelation"
                    form="0"
                    target="slave1"
                    relation_id=$OPPONENT.relation_id
                    perm="edit"
                    title="Edit this relation"
                    text=$OPPONENT.opponent_content_title|default:"unknown"
              }
                (ID={$OPPONENT.opponent_content_id}) ; {$OPPONENT.opponent_content_type_title}
                </td>
                <td class="button" align="right" width="120">
              
                {if $RELATIONS[$OPPONENT.opponent_content_type].open_url !=""}
                <a href="{prepare_url url=$RELATIONS[$OPPONENT.opponent_content_type].open_url id=$OPPONENT.opponent_content_id}" target="_blank"><img src="{$XT_IMAGES}icons/view.png" alt="" /></a>
                {/if}

                {actionIcon
                    action="editRelation"
                    icon="pencil.png"
                    form="0"
                    target="slave1"
                    relation_id=$OPPONENT.relation_id
                    perm="edit"
                    title="Edit this relation"
              }{actionIcon
                    action="deleteRelation"
                    icon="delete.png"
                    form="overview"
                    target="master"
                    relation_id=$OPPONENT.relation_id
                    perm="edit"
                    ask="Really delete this relation?"
                    title="Delete this relation"
              }
            
              </td>
            </tr>
            {/foreach}
          {/if}
         {/foreach}
         {/if}
{/foreach}

</table>
<!-- {include file="includes/navigator.tpl" form="overview"} -->
<input type="hidden" name="x{$BASEID}_open_ct" value="" />
<input type="hidden" name="x{$BASEID}_open_element" value="" />
<input type="hidden" name="x{$BASEID}_relation_id" value="" />
{yoffset}
</form>
