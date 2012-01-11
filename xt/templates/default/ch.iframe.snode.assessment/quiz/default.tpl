<h1>{$xt8200_quiz.data.title}</h1>
{if $xt8200_quiz.data.description != ""}
    {$xt8200_quiz.data.description}<br />
{/if}
<br />
{if $xt8200_quiz.finished}
    {"You have answered"|livetranslate} <strong>{$xt8200_quiz.points}</strong> {"of"|livetranslate} {$xt8200_quiz.metadata.questions_count} {"question correctly"|livetranslate}<br /><br />
    {if $xt8200_quiz.solution.title != ""}{$xt8200_quiz.solution.title}<br />{/if}
    {if $xt8200_quiz.solution.description != ""}{$xt8200_quiz.solution.description}<br />{/if}
{else}
    <strong>{$xt8200_quiz.metadata.active_question}</strong> {"of"|livetranslate} {$xt8200_quiz.metadata.questions_count}<br />
    <br />
    <strong>{$xt8200_quiz.question.title}</strong><br />
    {if $xt8200_quiz.question.description != ""}{$xt8200_quiz.question.description}<br />{/if}
    <br />
    {if !$xt8200_quiz.answer}
        {foreach from=$xt8200_quiz.question.answers item=ANSWER name=A}
            <a href="/index.php?TPL={$TPL}&amp;x{$BASEID}_answer_id={$ANSWER.id}">{$ANSWER.description}</a><br />
        {/foreach}
    {else}
        {$xt8200_quiz.answer.comment}<br />
        <br />
        <a href="/index.php?TPL={$TPL}&amp;x{$BASEID}_next=1">{"next"|livetranslate}</a>
    {/if}
{/if}

{*print_data array=$xt8200_quiz*}