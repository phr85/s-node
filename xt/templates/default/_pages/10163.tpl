{include file="includes/header/header.tpl"}
{plugin package="ch.iframe.snode.catalog" module="category_title"}
{plugin package="ch.iframe.snode.catalog" module="image_box" show="main" style="main.tpl" title="yes"}
{plugin package="ch.iframe.snode.catalog" module="product_details"}
<table border="0" cellpadding="0" cellspacing="0">
    <tr>
       <td colspan="2">{"Pictures"|translate}</td>
    </tr>
    <tr>
        <td colspan="2">{plugin package="ch.iframe.snode.catalog" module="image_box"}</td>
    </tr>
    <tr>
        <td>{"Umgebung"|translate} / {"Austattung"|translate}</td>
        <td>{"Details"|translate}</td>
    </tr>
    <tr>
        <td style="padding: 5px;">{plugin package="ch.iframe.snode.catalog" module="property_box" range="18, 25"}</td>
        <td style="padding: 5px;">{plugin package="ch.iframe.snode.catalog" module="property_box"}</td>
    </tr>
 </table>

{include file="includes/footer/footer.tpl"}