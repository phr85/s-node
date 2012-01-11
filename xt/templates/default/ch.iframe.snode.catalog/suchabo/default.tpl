{if $VALIDMAIL}
<h2>Suchabo Eintrag</h2>
Ihr Suchabo wurde f&uuml; die Dauer von {$DURATION} Monate{if $DURATION >1}n{/if} mit folgenden Filter Einstellungen gespeichert: <br />
<br />
{if $FILTER.1 && $FILTER.1 !="not"} Ort: <b>{$FILTER.1}</b><br />{/if}
{if $FILTER.7 && $FILTER.7 !="not"} Zimmer: <b>{$FILTER.7}</b><br />{/if}
{if $FILTER.3 && $FILTER.3 !="not"} Kauf / Miete: <b>{$FILTER.3}</b><br />{/if}
<br />
{if $NODEFILTER.0}Kategorie: <b>{$KATEGORY}</b><br />{/if}
<br />
Email Adresse: <b>{$EMAIL}</b>
{else}
<h2>Fehler</h2>
Die Emailaddresse {$EMAIL} ist keine gültige Adresse
{/if}