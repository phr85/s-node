{get_param param="height" assign="height"}
{get_param param="width" assign="width"}

<object classid="clsid:67DABFBF-D0AB-41fa-9C46-CC0F21721616" width="{$width}" height="{$height}" codebase="http://go.divx.com/plugin/DivXBrowserPlugin.cab">
 <param name="custommode" value="Stage6" />
  {if $xt240_autoplay == true}
  	<param name="autoPlay" value="true" />
  {else}
  	<param name="autoPlay" value="false" />
  {/if}
  <param name="src" value="/video/{$xt240_movie.id}.divx" />
<embed type="video/divx" src="/video/{$xt240_movie.id}.divx" custommode="Stage6" width="{$width}" height="{$height}" autoPlay="false"  pluginspage="http://go.divx.com/plugin/download/">
<embed type="video/divx" src="/video/{$xt240_movie.id}.divx" custommode="Stage6" width="{$width}" height="{$height}" autoPlay="false"  pluginspage="http://go.divx.com/plugin/download/">
</embed>
</object>