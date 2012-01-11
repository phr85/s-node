<table cellspacing="0" cellpadding="0" width="100%">
 {foreach from=$DATA item=NEWS}
 <tr>
  <td>
  {if $LINK2DETAILS == 'yes'}
  <h2><a href="{$smarty.server.PHP_SELF}?TPL={$TARGET_TPL}&amp;x{$BASEID}_id={$NEWS.id}">{$NEWS.title}</a></h2>
  {else}
  <h2>{$NEWS.title}</h2>
  {/if}
  {if $NEWS.subtitle != ""}{$NEWS.subtitle}&nbsp;-&nbsp;{/if}{$NEWS.creation_date|date_format:"%d.%m.%Y %H:%I"}<br /><br /> 
   {if $NEWS.introduction != ""}
       <table cellpadding="0" cellspacing="0" width="100%" style="background-color: #EEEEEE;">
        <tr>
         <td style="padding: 10px;">
         
               {if $NEWS.image > 0}
               <table cellspacing="0" cellpadding="0" align="left" style="border: 1px solid #6F94B2; margin: 0px 12px 0px 0px;">
                <tr>
                <td>{image
                	id=$NEWS.image
                	version=2
                	title=$NEWS.img_description
                	alt=$NEWS.img_alt}
            	</td>
               </tr>
              </table>
              {/if}
         {$NEWS.introduction}
         </td>
        </tr>
       </table>
   <br />
   {/if}
  </td>
 </tr>
 {/foreach}
</table>