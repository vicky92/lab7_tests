<h2>Новый вариант ответа</h2>
<form action = "" method = "POST">
    <label>
        Ответ <br />
        <textarea rows = "5" style = "width: 300px;" name = "add_answer[answer]"><?=$answer->answer?></textarea>
    </label> <br />
    <?php 
        if ($answer->hasErrors('answer')) {
            ?>
                <div><?=$answer->getError('answer')?></div>
            <?php
        }
    ?> <br />
    
    <input type = "submit" value = "Создать" />
</form>

<a href = "<?=$this->createUrl("questions/update", array(
        'test_id' => $test_id,
        'question_id' => $question_id
    ))?>">Вернутся к вопросу</a>