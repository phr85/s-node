{* weitere details zu swfobjekt gibt es unter http://code.google.com/p/swfobject/
Der verwendete Player ist die lizenzierte version von http://www.longtailvideo.com/players/jw-flv-player/
*}
{XT_load_js file="ch.iframe.snode.filemanager/swfobject.js"}
{get_param param="height" assign="height"}
{get_param param="width" assign="width"}
{get_param param="autoplay" assign="autoplay"}

<div id="container_movie{$xt240_movie.id}"><a href="http://www.macromedia.com/go/getflashplayer">Get the Flash Player</a> to see this player.</div>

<script type="text/javascript">
var flashvars = {literal}{{/literal}
  allowfullscreen: "true",
  width: "{$width}",
  height: "{$height}",
  allowscriptaccess: "always",
  backcolor: "0x000000",
  frontcolor: "0xffffff",
  allowscriptaccess: "always",
  {if $xt240_autoplay =="true"}
  autostart: true,
  {/if}
  lightcolor: "0x0099CC",
  {if $xt240_movie.image >0}
  image: "/download.php?file_id={$xt240_movie.image}&file_version={$xt240_movie.image_version}",
  {/if}
  file: "/video/{$xt240_movie.id}.flv"
  {literal}}{/literal};
  
  
{literal}
var params = {
  menu: "false",
  wmode: "opaque"
};

{/literal}

swfobject.embedSWF("/mediaplayer/mediaplayer.swf", "container_movie{$xt240_movie.id}", "{$width}", "{$height}", "9.0.0", "/mediaplayer/expressInstall.swf", flashvars, params);
</script>