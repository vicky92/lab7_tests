<h2>Новый вопрос</h2>
<form action = "" method = "POST">
    <label>
        Вопрос <br />
        <textarea rows = "5" style = "width: 300px;" name = "add_question[question]"><?=$model->question?></textarea>
    </label> <br />
    <?php 
        if ($model->hasErrors('question')) {
            ?>
                <div><?=$model->getError('question')?></div>
            <?php
        }
    ?> <br />
    
    <input type = "submit" value = "Создать" />
</form>

<a href = "<?=$this->createUrl("tests/update", array('test_id' => $test_id))?>">Вернутся к тесту</a>