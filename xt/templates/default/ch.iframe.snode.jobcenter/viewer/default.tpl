{if $xt1700_viewer.data != ""}
    <h1>
        {$xt1700_viewer.data.title}
        {if $xt1700_viewer.data.job_percentage_to != 100 || $xt1700_viewer.data.job_percentage_from > 0}
            ({if $xt1700_viewer.data.job_percentage_from > 0}{$xt1700_viewer.data.job_percentage_from} - {/if}{$xt1700_viewer.data.job_percentage_to}%)
        {/if}
    </h1>
    {if $xt1700_viewer.data.subtitle != ""}
        <h2>
            {$xt1700_viewer.data.subtitle}
        </h2>
    {/if}
    {if $xt1700_viewer.data.job_id != ""}
        {"Job ID"|livetranslate}: {$xt1700_viewer.data.job_id}<br />
    {/if}
    <br />
    {if $xt1700_viewer.data.introduction != ""}
        {$xt1700_viewer.data.introduction}<br />
        <br />
    {/if}
    {if $xt1700_viewer.data.maintext != ""}
        {$xt1700_viewer.data.maintext}<br />
        <br />
    {/if}
    <h3>{"Informationen"|livetranslate}</h3>
    {"Art der Anstellung"|livetranslate}: {if $xt1700_viewer.data.job_end_at == 0}{"Festanstellung"|livetranslate}{else}{"befristete Anstellung"|livetranslate}{/if}<br />
    {"Arbeitsbeginn"|livetranslate}: {if $xt1700_viewer.data.job_start_at > 0}{$xt1700_viewer.data.job_start_at|date_format:"%d.%m.%Y"}{else}{"nach Vereinbarung"|livetranslate}{/if}<br />
    {if $xt1700_viewer.data.job_end_at > 0}{"Arbeitsende"|livetranslate}: {$xt1700_viewer.data.job_end_at|date_format:"%d.%m.%Y"}<br />{/if}
    {if $xt1700_viewer.data.application_up > 0}{"Bewerbungen werden entgegengenommen bis"|livetranslate}: {$xt1700_viewer.data.application_up|date_format:"%d.%m.%Y"}<br />{/if}
    {* Arbeitsort *}
    {if $xt1700_viewer.data.location_id > 0}
        <br />
        <h3>{"Arbeitsort"|livetranslate}</h3>
        {if $xt1700_viewer.data.location_street != ""}
            {$xt1700_viewer.data.location_street}<br />
        {/if}
        {if $xt1700_viewer.data.location_city != ""}
            {$xt1700_viewer.data.location_postal_code} {$xt1700_viewer.data.location_city}<br />
        {/if}
        {if $xt1700_viewer.data.location_country != ""}
            {$xt1700_viewer.data.location_country}<br />
        {/if}
    {/if}
    {* Zustaendige Person *}
    {if $xt1700_viewer.data.contact_id > 0}
        <br />
        <h3>{"Zustaendige Person"|livetranslate}</h3>
        {if $xt1700_viewer.data.contact_first_name != ""}
            {$xt1700_viewer.data.contact_first_name} {$xt1700_viewer.data.contact_last_name}<br />
        {/if}
        {if $xt1700_viewer.data.contact_street != ""}
            {$xt1700_viewer.data.contact_street}<br />
        {/if}
        {if $xt1700_viewer.data.contact_city != ""}
            {$xt1700_viewer.data.contact_postal_code} {$xt1700_viewer.data.contact_city}<br />
        {/if}
        {if $xt1700_viewer.data.contact_country != ""}
            {$xt1700_viewer.data.contact_country}<br />
        {/if}
        {if $xt1700_viewer.data.contact_tel != ""}
            {"Telefon"|livetranslate}: {$xt1700_viewer.data.contact_tel}<br />
        {/if}
        {if $xt1700_viewer.data.contact_email != ""}
            {"E-Mail"|livetranslate}: <a href="mailto: {$xt1700_viewer.data.contact_email}">{$xt1700_viewer.data.contact_email}</a><br />
        {/if}
    {/if}
    {* Bewerbungsformular linken *}
    {if $xt1700_viewer.param.application_tpl > 0 && $xt1700_viewer.data.application_schematic != ""}
        <br />
        <br />
        <a href="/index.php?TPL={$xt1700_viewer.param.application_tpl}&amp;x{$BASEID}_job_id={$xt1700_viewer.data.id}">{"online_application"|livetranslate}</a>
    {/if}
{/if}