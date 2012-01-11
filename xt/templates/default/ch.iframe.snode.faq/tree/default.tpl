{XT_load_css file="ch.iframe.snode.faq/accordion.css"}
{XT_load_js file="jquery-ui/ui.accordion.js"}
{XT_load_js file="ch.iframe.snode.faq/call.jquery.accordion.js"}

{get_param param="node" assign="node"}

<div id="faqaccordion">
    <h1>{"FAQ"|livetranslate}</h1>
    <br />
    {if $xt1400_tree.nodearray.$node|@count > 0 || $xt1400_tree.questions.$node|count > 0}
        {include file="ch.iframe.snode.faq/tree/recursion.tpl"}
    {/if}
</div>