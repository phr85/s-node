{if $AUTH}
	<div id="addaddress" style="display:none;">{plugin package="ch.iframe.snode.addressmanager" module="add" redirect_tpl=163}</div>
{/if}
{plugin package="ch.iframe.snode.shop" module="orderprocess"}
{plugin package="ch.iframe.snode.shop" module="addressdata"}
{if $AUTH}
{plugin package="ch.iframe.snode.addressmanager" module="user_list" edit_tpl=167}
<a href="#addaddress" class="thickbox" >{"add address"|translate}</a>
{/if}

<table style="text-align: left; width: 100%;" border="0" cellpadding="0" cellspacing="0">
    <tr>
     <td align="left">{actionLink
     action  = "back"
     form    = "address"
     text   = "Back"
     baseid = 2400
   }</td>
   <td align="right">{if $AUTH}{actionLink
     action  = "addressOk"
     form    = "address"
     text   = "Next"
     baseid = 2400
   }{/if}</td>
    </tr>
</table>