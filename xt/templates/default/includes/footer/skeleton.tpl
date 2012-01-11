                </div>
                <div id="footer">&nbsp;</div>
            </div>
        </div>
        <a name="bottom"></a>
        {if $SYSTEM_GOOGLE_ANALYTICS_KEY != ""}
            {literal}
                <script type="text/javascript">
                    var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
                    document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
                </script>
                <script type="text/javascript">
                    try {
                        var pageTracker = _gat._getTracker("{/literal}{$SYSTEM_GOOGLE_ANALYTICS_KEY }{literal}");
                        pageTracker._trackPageview();
                    } catch(err) {}
                </script>
            {/literal}
        {/if}
        {if $SYSTEM_PIWIK_ID != ""}
            {literal}
                <script type="text/javascript">
                    var pkBaseURL = (("https:" == document.location.protocol) ? "https://piwik.iframe.ch/" : "http://piwik.iframe.ch/");
                    document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
                </script>
                <script type="text/javascript">
                    try {
                        var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", {/literal}{$SYSTEM_PIWIK_ID}{literal});
                        piwikTracker.trackPageView();
                        piwikTracker.enableLinkTracking();
                    } catch( err ) {}
                </script>
                <noscript>
                    <p><img src="http://piwik.iframe.ch/piwik.php?idsite={/literal}{$SYSTEM_PIWIK_ID}{literal}" style="border:0" alt="" /></p>
                </noscript>
            {/literal}
        {/if}
    </body>
</html>
<!-- Created with S-Node XT Content Management System - http://www.iframe.ch -->