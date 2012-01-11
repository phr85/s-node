<script language="JavaScript" type="text/javascript">

var f = 0;
var count = {$FILES|@count};
var slides = new Array(count);
{literal}
for (f = 0; f < count ; f++ )
{
    slides[f] = 'slide' + (f + 1);
}
var si = 0; var wait = 5000;
function SlideShow() {
    Effect.Fade(slides[si], { duration:1, from:1.0, to:0.0 });
    si++;
    if (si == count ){
        si = 0;
    }
    Effect.Appear(slides[si], { duration:1, from:0.0, to:1.0 });

 }

// the onload event handler that starts the fading.
function start_slideshow() { setInterval('SlideShow()',wait); }

start_slideshow();
</script>
{/literal}
<div>
{foreach from=$FILES item=FILE name=F}
    <div id="slide{$smarty.foreach.F.iteration}" class="slide"{if !$smarty.foreach.F.first} style="display: none;"{/if}>
        {image id=$FILE.id version=$VERSION}
    </div>
{/foreach}
</div>