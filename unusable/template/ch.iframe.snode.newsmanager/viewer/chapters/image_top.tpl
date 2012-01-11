<div class="chapter">
 <h2>{$CHAPTER.title}</h2>
 <p class="chapter_content">{if $CHAPTER.image > 0}{if $CHAPTER.image_zoom == 1}<a href="javascript:popup('{$smarty.server.PHP_SELF}?TPL={$IMAGE_POPUP_TPL}&x{$FILEMANAGER_BASEID}_file_id={$CHAPTER.image}');">{else}{if $CHAPTER.image_link != ''}<a target="{$CHAPTER.image_link_target}" href="{$CHAPTER.image_link}">{/if}{/if}
  {image
      id=$CHAPTER.image
      version=2
      title=$CHAPTER.image_description
      alt=$CHAPTER.image_description
      class="top"
  }{if $CHAPTER.image_zoom == 1 || $CHAPTER.image_link != ''}</a>{/if}{/if}{if $CHAPTER.subtitle != ''}{$CHAPTER.subtitle}{/if}{$CHAPTER.maintext}
  <div class="chapter_control"><a class="page_navigation" href="#top">{"To the top"|translate}</a></div>
 </p>
</div>