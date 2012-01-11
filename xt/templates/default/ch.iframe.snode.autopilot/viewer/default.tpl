{"Playing Slide"|translate}: {$TITLE}<br />

<script language="javascript" type="text/javascript">
<!--
{literal}
function popitup(url)
{
var Swidth = screen.availWidth;
var Sheight = screen.availHeight;

newwindow=window.open(url,'slideshow','fullscreen=yes,toolbar=0,titlebar=no,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0,top=0,left=0,height=' + Sheight +',width=' + Swidth);

if (window.focus) {newwindow.focus()}
    return false;
}
{/literal}

{foreach from=$SLIDES item=SLIDE}
{if $SLIDE.page_type == 1 || $SLIDE.page_type == 0}
    setTimeout("popitup('{$SLIDE.page}')",{$SLIDE.timeline});
{/if}
{if $SLIDE.page_type == 2}
setTimeout("newwindow.close()",{$SLIDE.timeline});
{/if}
{/foreach}
{if $LOOP==1}
  setTimeout("window.location.reload()",{$LOOPTIME});
{/if}
// -->


</script>
