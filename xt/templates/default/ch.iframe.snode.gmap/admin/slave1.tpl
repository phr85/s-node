<form method="post" name="slave1" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
    {include file="ch.iframe.snode.gmap/admin/hiddenValues.tpl"}
    <div id="content">
        <img src="/images/icons/gmaplogo.gif" alt="" />
        <p class="introduction">{"intro_text"|translate}</p>
    </div>
</form>
{literal}
    <script type="text/javascript">
        //<![CDATA[
            if(window.parent.frames['master'].document.forms[0]){
                window.parent.frames['master'].document.forms[0].submit();
            }
        //]]>
    </script>
{/literal}