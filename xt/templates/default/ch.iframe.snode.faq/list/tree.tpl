{strip}
{* ACHTUNG: Dies ist ein Subplugin des Trees *}
    {if $xt1400_list.data|@count > 0}
        <div class="faqnodewrapper2">
            {foreach from=$xt1400_list.data item=FAQ}
                <h6>{$FAQ.title}</h6>
                <div class="faqitemtext">
                    {if $FAQ.description != ""}
                        <div class="faqdescription">
                            {$FAQ.description}
                        </div>
                    {/if}
                    {if $FAQ.answer != ""}
                        <div class="faqanswer">
                            {$FAQ.answer}
                        </div>
                    {/if}
                </div>
            {/foreach}
        </div>
    {else}
        <div class="faqnodewrapper2noheight">&nbsp;</div>
    {/if}
{/strip}