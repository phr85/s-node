<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" 
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" >
    <head>
    <title>{$xt5100_registration_mail.xt5100_registration_mail}</title>
    <base href="http://{$smarty.server.SERVER_NAME}/" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        {literal}
            <style type='text/css'>
                    
                body {
                    font-family: Verdana, Arial, sans-serif;
                    font-size: 11px;
                    margin: 0;
                    padding: 0;
                }
                
                a {
                    color: black;
                }
                
                a:hover {
                    color: #000066;
                }
                
                a:focus {
                    outline: none;
                }
                
                table {
                    text-align: left;
                    width: 100%;
                    border: 0 solid white;
                    padding: 0;
                    margin: 0;
                    border-collapse: collapse;
                }
                
                td {
                    font-size: 11px;
                    border: 2px solid white;
                    padding: 5px;
                    background-color: rgb(238, 238, 238);
                }
                
                td.field {
                    width: 30%;
                }
                
                td.value {
                    width: 70%;
                }
                    
            </style>
    {/literal}
    </head>
    <body>
        <table>
        {foreach from=$xt5100_registration_mail key="KEY" item="VALUE"}
                <tr>
                    <td class="field">
                        {if $KEY|truncate:9:"":true == "acco_pers"}
                            {assign var=KEY value="acco_pers"}
                        {/if}
                        <b>{$KEY|translate}:</b>
                    </td>
                    <td class="value">
                        {if $KEY == "gender"}
                            {$VALUE|translate|nl2br}
                        {else}
                            {$VALUE|nl2br}
                        {/if}
                    </td>
                </tr>
        {/foreach}
        </table>
    </body>
</html>