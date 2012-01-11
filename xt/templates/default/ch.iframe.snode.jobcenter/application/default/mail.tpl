<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
        "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" > 
<head> 
    <title>{"application"|translate}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
        {literal}
        <!--
            
            html, body {
                margin: 0;
                padding: 0;
                font-family: Arial, Helvetica, Verdana, sans-serif;
                font-size: 12px;
                line-height: 140%;
                color: #000000;
                background-color: #FFFFFF;
            }
            
            a {
                color: #AAAAAA;
                text-decoration: none;
            }
            
            a:hover {
                color: #555555;
                text-decoration: none;
            }
            
            h1 {
                margin: 0;
                padding: 0 0 20px 0;
                font-size: 20px;
                font-weight: bold;
            }
            
            h2 {
                margin: 0;
                padding: 0 0 15px 0;
                font-size: 15px;
                font-weight: bold;
            }
            
            h3 {
                margin: 0;
                padding: 0 0 5px 0;
                font-size: 15px;
                font-weight: bold;
            }
            
        -->
        {/literal}
    </style>
</head>
<body>
    <table style="width: 600px; margin: 0; padding: 0; border-collapse: collapse;">
        <tr>
            <td style="width: 560px; padding: 20px; text-align: left; vertical-align: top; font-family: Arial, Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 140%; color: #000000;">
                <h1 style="margin: 0; padding: 0 0 20px 0; font-size: 20px; font-weight: bold;">
                    {"online_application"|translate}
                </h1>
                <h2 style="margin: 0; padding: 0 0 15px 0; font-size: 15px; font-weight: bold;">
                    {$xt1700_application_mail.info.job_title}
                    {if $xt1700_application_mail.info.job_percentage_to != 100 || $xt1700_application_mail.info.job_percentage_from > 0}
                        ({if $xt1700_application_mail.info.job_percentage_from > 0}{$xt1700_application_mail.info.job_percentage_from} - {/if}{$xt1700_application_mail.info.job_percentage_to}%)
                    {/if}
                </h2>
                {if $xt1700_application_mail.info.job_job_id != ""}
                    {"job_id"|translate}: {$xt1700_application_mail.info.job_job_id}<br />
                {/if}
                {"reference_id"|translate}: {$xt1700_application_mail.info.job_id}<br />
                {"application_id"|translate}: {$xt1700_application_mail.info.id}<br />
                <br />
                <br />
                <table style="width: 560px; margin: 0; padding: 0; border-collapse: collapse;">
                    <tr>
                        <td style="width: 250px; padding: 0 60px 0 0; text-align: left; vertical-align: top; font-family: Arial, Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 140%; color: #000000;">
                            <h3 style="margin: 0; padding: 0 0 5px 0; font-size: 15px; font-weight: bold;">
                                {"location_address"|translate}
                            </h3>
                            {if $xt1700_application_mail.info.location_street != ""}
                                {$xt1700_application_mail.info.location_street}<br />
                            {/if}
                            {if $xt1700_application_mail.info.location_city != ""}
                                {$xt1700_application_mail.info.location_postal_code} {$xt1700_application_mail.info.location_city}<br />
                            {/if}
                            {if $xt1700_application_mail.info.location_country != ""}
                                {$xt1700_application_mail.info.location_country}<br />
                            {/if}
                        </td>
                        <td style="width: 250px; padding: 0; text-align: left; vertical-align: top; font-family: Arial, Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 140%; color: #000000;">
                            <h3 style="margin: 0; padding: 0 0 5px 0; font-size: 15px; font-weight: bold;">
                                {"contact_address"|translate}
                            </h3>
                            {if $xt1700_application_mail.info.contact_last_name != ""}
                                {$xt1700_application_mail.info.contact_last_name} {$xt1700_application_mail.info.contact_first_name}<br />
                            {/if}
                            {if $xt1700_application_mail.info.contact_street != ""}
                                {$xt1700_application_mail.info.contact_street}<br />
                            {/if}
                            {if $xt1700_application_mail.info.contact_city != ""}
                                {$xt1700_application_mail.info.contact_postal_code} {$xt1700_application_mail.info.contact_city}<br />
                            {/if}
                            {if $xt1700_application_mail.info.contact_country != ""}
                                {$xt1700_application_mail.info.contact_country}<br />
                            {/if}
                            <br />
                            {if $xt1700_application_mail.info.contact_tel != ""}
                                {"tel"|translate}: {$xt1700_application_mail.info.contact_tel}<br />
                            {/if}
                            {if $xt1700_application_mail.info.contact_fax != ""}
                                {"fax"|translate}: {$xt1700_application_mail.info.contact_fax}<br />
                            {/if}
                            {if $xt1700_application_mail.info.contact_email != ""}
                                {"email"|translate}: <a style="color: #AAAAAA; text-decoration: none;" href="mailto:{$xt1700_application_mail.info.contact_email}">{$xt1700_application_mail.info.contact_email}</a>
                            {/if}
                        </td>
                    </tr>
                </table>
                <br />
                <br />
                <h3 style="margin: 0; padding: 0 0 5px 0; font-size: 15px; font-weight: bold;">
                    {"application_data"|translate}
                </h3>
                <table style="width: 560px; margin: 0; padding: 0; border-collapse: collapse;">
                    {foreach from=$xt1700_application_mail.values item=VALUE key=KEY}
                        <tr>
                            <td style="width: 180px; padding: 0 20px 0 0; text-align: left; vertical-align: top; font-family: Arial, Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 140%; color: #000000;">
                                {$KEY|translate}
                            </td>
                            <td style="width: 360px; padding: 0; text-align: left; vertical-align: top; font-family: Arial, Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 140%; color: #000000;">
                                {$VALUE|nl2br}
                            </td>
                        </tr>
                    {/foreach}
                </table>
                {if $xt1700_application_mail.attachments|@count > 0}
                    <br />
                    <br />
                    <h3 style="margin: 0; padding: 0 0 5px 0; font-size: 15px; font-weight: bold;">
                        {"attachments"|translate}
                    </h3>
                    {foreach from=$xt1700_application_mail.attachments item=ATTACHMENT}
                        - {$ATTACHMENT}<br />
                    {/foreach}
                {/if}
            </td>
        </tr>
    </table>
</body>
</html>