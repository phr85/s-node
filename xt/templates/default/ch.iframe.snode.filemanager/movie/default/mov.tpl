{get_param param="height" assign="height"}
{get_param param="width" assign="width"}

<object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab" width="{$width}" height="{$height}">
 <param name="src" value="/video/{$xt240_movie.id}.mov" />
 <param name="controller" value="true" />
  {if $xt240_autoplay == true}
  	<param name="autoplay" value="true" />
  {else}
  	<param name="autoplay" value="false" />
  {/if}
 <object type="video/quicktime" data="/video/{$xt240_movie.id}.mov" width="{$width}" height="{$height}" class="mov">
  <param name="controller" value="true" />
  Please install Apple Quick time to stream this movie. Otherwise download it from <a href="/video/{$xt240_movie.id}.mov">here</a>.
 </object>
</object>