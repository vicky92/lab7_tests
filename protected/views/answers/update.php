<h2>Редактировать вариант ответа</h2>
<form action = "" method = "POST">
    <label>
        Ответ: <br />
        <textarea rows = "5" style = "width: 300px;" name = "update_answer[answer]"><?=$answer->answer?></textarea>
    </label> <br /><br />
    
    Характеристики: <br />
    <?php
        $definitions = Definition::getAll();
        
        foreach ($definitions as $definition) {
            ?>
                <label>
                    <input 
                        type = "checkbox" 
                        name = "update_answer[definitions][]" 
                        value = "<?=$definition->_id?>" 
                        <?=(in_array($definition->_id, (array)$answer->definitions)) ? "checked" : ""?>
                    />
                    <?=$definition->name?>
                </label> <br />
            <?php
        }
    ?> <br />
    
    <input type = "submit" value = "Сохранить" />
</form>

<a href = "<?=$this->createUrl("questions/update", array(
        'test_id' => $test_id,
        'question_id' => $question_id
    ))?>">Вернутся к вопросу</a>