<h2>Редакторование Вопроса</h2>
<h4><?=$question->question?></h4><br />
<form action = "" method = "POST">
    <label>
        Вопрос <br />
        <textarea rows = "5" style = "width: 300px;" name = "update_question[question]"><?=$question->question?></textarea>
    </label> <br />
    <?php 
        if ($question->hasErrors('question')) {
            ?>
                <div><?=$question->getError('question')?></div>
            <?php
        }
    ?>
    
    <h3>Список ответов на этот вопрос</h3>
    <table border = "1" style = "width: 100%;">
        <thead>
            <tr>
                <td>Вариант ответа</td>
                <td>Действие</td>
            </tr>
        </thead>
        
        
        <?php 
            if (count($question->answers) > 0) {
                foreach ($question->answers as $answer_id => $answer) {
                    $answer = (object) $answer;

                    $answer_url = array(
                        'test_id' => $test->_id,
                        'question_id' => $question_id,
                        'answer_id' => $answer_id
                    );
                    ?>
                        <tr>
                            <td><?=$answer->answer?></td>
                            <td>
                                <a href = "<?=$this->createUrl('answers/remove', $answer_url)?>">Удалить</a>
                                <a href = "<?=$this->createUrl('answers/update', $answer_url)?>">Редактировать</a>
                            </td>
                        </tr>
                    <?php
                }
            }
        ?>
    </table> <br />
    <?php 
        $answer_add_url = array(
            'test_id' => $test->_id,
            'question_id' => $question_id
        );
    ?>
    <a href = "<?=$this->createUrl('answers/add', $answer_add_url)?>">Добавить вариант ответа</a> <br /><br />
    
    <input type = "submit" value = "Сохранить изменения" />
</form>
<a href = "<?=$this->createUrl("tests/update", array('test_id' => $test->_id))?>">Вернутся к списку вопросов</a>