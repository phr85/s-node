{get_param param="overview_tpl" assign="overview_tpl"}
<div class="rviewer">
    <div class="rviewer_title">{$DATA.recipe.title}</div>
    <div class="rviewer_subtitle">{$DATA.recipe.subtitle}</div>
    {subplugin package="ch.iframe.snode.rezepte" module="images" style="default.tpl" show="all" version=3}
    
    <div class="rviewer_ingridient_box">
     <b>{"ingridients"|translate}</b> <br />
      {foreach from=$DATA.ingridients item=INGRIDIENT}

        {if $INGRIDIENT.unit_id==17}
         <div class="rviewer_ingridient_separator">{$INGRIDIENT.name}</div>
        {else}
          <div class="rviewer_ingridient">
          {if $INGRIDIENT.unit_ammount_calc > 0}<div class="rviewer_calculated">{$INGRIDIENT.unit_ammount_calc|round} {$INGRIDIENT.standard}</div>  {/if}
          {$INGRIDIENT.unit_ammount|round} {$INGRIDIENT.standard} {$INGRIDIENT.name}  
           
          </div>
        {/if}

     {/foreach}
    </div>
    
    <div class="rviewer_detailbox">
    <b>{"details"|translate}</b> <br />
    {"portions"|translate}: {$DATA.recipe.portions}<br />
    {if $DATA.recipe.create_duration}{"create_duration"|translate}: {$DATA.recipe.create_duration}<br />{/if}
    {if $DATA.recipe.rest_duration}{"rest_duration"|translate}: {$DATA.recipe.rest_duration}<br />{/if}
    {if $DATA.recipe.kcal}{"kcal"|translate}: {$DATA.recipe.kcal}<br />{/if}
    {if $DATA.recipe.complexity}{"complexity"|translate}: {$DATA.recipe.complexity}<br />{/if}
    {if $DATA.recipe.ca_price}{"ca_price"|translate}: {$DATA.recipe.ca_price}<br />{/if}
    {if $DATA.recipe.rating_avg}{"rating_avg"|translate}: {$DATA.recipe.rating_avg}<br />{/if}
    <br />
    <form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" name="portions">
    <input class="portionfield" type="text" name="x{$BASEID}_portions" value="{$DATA.portions}" />
    <input class="portionsubmit" type="submit" value="{'send'|translate}" />
    </form>
    </div>
    
    <div class="rviewer_making">
     <b>{"making"|translate}</b> <br />
    {$DATA.recipe.making}</div>

 
<br clear="all" />
<a href="{$smarty.server.PHP_SELF}?TPL={$overview_tpl}">{"back to overview"|translate}</a>
</div>