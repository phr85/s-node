<div style="width:160px;">
<h2 class="datepicker">{$SETTEDDATE|date_format}</h2>
<form action="javascript:ajaxGet(document.getElementById('dp{$axNAME}'),'{$axNAME}');" name="dp{$axNAME}" id="dp{$axNAME}">
{plugin package="ch.iframe.snode.roombooking" module="ax_datepicker" axparams=$axPARAM paramvar=$axPARAM.paramvar}
</form>
</div>