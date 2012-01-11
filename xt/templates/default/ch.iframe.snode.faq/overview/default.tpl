{if !$VIEWER}
{if !$CATEGORY}
{plugin package="ch.iframe.snode.faq" module="search"}
{plugin package="ch.iframe.snode.faq" module="most_viewed" count="5"}
{plugin package="ch.iframe.snode.faq" module="category_list"}
{else}
{plugin package="ch.iframe.snode.faq" module="category_list"}
{plugin package="ch.iframe.snode.faq" module="question_list"}
{/if}
{else}
{plugin package="ch.iframe.snode.faq" module="viewer"}
{/if}