{XT_load_css file="ch.iframe.snode.assessment.css"}
{XT_load_js file="jquery-ui/ui.accordion.js"}
<form id="assessment">
{foreach from=$xt8200_viewer.questions item=question key=x name=q}
	<div class="assessment_question" id="panel_{$x}">
		<div class="assessment_question_title">{$question.title}</div>
		{$question.description}
		{foreach from=$question.answers item=answer}
			<div class="assessment_answer">
				<input type="radio" id="a_id_{$answer.id}" name="a_{$question.id}" value="{$answer.value}"/> <label for="answer_input_{$answer.id}">{$answer.description}</label>
			</div>
		{/foreach}
		<div class="assessment_question_buttons">
			{if !$smarty.foreach.q.first}
			<input type="button" class="previous" value="{"Previous"|translate}"/>
			{/if}
			{if !$smarty.foreach.q.last}
			<input type="button" class="next" value="{"Next"|translate}" />
			{/if}
			{if $smarty.foreach.q.last}
			<input type="button" class="getresult" value="{"Show result"|translate}" />
			{/if}
		</div>
	</div>
{/foreach}
<input type="hidden" name="panel" value="0" id="panel">
</form>
{foreach from=$xt8200_viewer.solutions item=solution}
	<div class="assessment_solutions" id="solution_{$solution.id}"><div class="assessment_solutions_title">{$solution.title}</div>
	{$solution.description}
	<div class="assessment_question_buttons">
		<input type="button" class="close" value="{"Close"|translate}" />
		<input type="button" class="new" value="{"Start new questioning"|translate}" />
	</div>
	</div>
{/foreach}
{XT_load_js file="querystring.js"}
{literal}
<script>
  $(document).ready(function(){
    var total;
    var str = readCookie("assessment");
	var qs = new Querystring(str);
    $("#assessment .assessment_question").hide();
   
    function saveValues() {
      var str = $("#assessment").serialize();
      createCookie("assessment",str,2);
      $("#results").text(str);
    }
	function showValues() {
		$("#assessment :radio").each(function (i) {
      		if (this.value == qs.get(this.name)) {
      			this.checked = true;
      		}
      	});
      	saveValues();
	}
	
	function showPanel(panel){
		$("#assessment .assessment_question").slideUp("slow");
		$("#panel_" + panel).slideDown("slow");
		$("#panel").attr("value",panel);
		saveValues();
	}
	
	function shwoResult() {
		total = 0;
		$("#assessment :radio:checked").each(function (i) {
			total = total + parseInt(this.value);
		});
		{/literal}{foreach from=$xt8200_viewer.solutions item=solution}{literal}
		if (total >= {/literal}{$solution.lower_level}{literal} && total <= {/literal}{$solution.upper_level}{literal}) {
			shwoResultElement("#solution_{/literal}{$solution.id}{literal}");
		}		
		{/literal}{/foreach}{literal}
	}
	
	function shwoResultElement(elId) {
		$("#assessment .assessment_question").slideUp("slow");

		$(elId).slideDown("slow");
	}
	
	if (qs.get("panel") > 0) {
		showPanel(qs.get("panel"));
	} else {
		showPanel(0);
	}
	
	$(".next").click(function (i){
		var old_value = parseInt($("#panel").attr("value"));
		var new_value = old_value+1;
		showPanel(new_value);
	});
	
	$(".previous").click(function (i){
		var old_value = parseInt($("#panel").attr("value"));
		var new_value = old_value-1;
		showPanel(new_value);
	});
	
	$(".close").click(function (i){
		$(".assessment_solutions").slideUp("slow");
		showPanel(parseInt($("#panel").attr("value")));
	});
	
	$(".new").click(function (i){
		$("#assessment :radio").each(function (i) {
    		this.checked = false;
      	});
      	saveValues();
		$(".assessment_solutions").slideUp("slow");
		showPanel(0);
	});
	
    $("#assessment :radio").click(saveValues);
    $(".getresult").click(shwoResult);
    $(".assessment_solutions").hide();
    showValues();
  });
</script>
{/literal}