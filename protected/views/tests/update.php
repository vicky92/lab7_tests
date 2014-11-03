<h2>Редакторование теста</h2>
<h4><?=$model->name?></h4><br />
<form action = "" method = "POST">
    <label>
        Название теста <br />
        <input type = "text" name = "add[name]" value = "<?=$model->name?>" />
    </label> <br />
    <?php 
        if ($model->hasErrors('name')) {
            ?>
                <div><?=$model->getError('name')?></div>
            <?php
        }
    ?>
    <h3>Список вопросов в этом тесте</h3>
    <table border = "1" style = "width: 100%;">
        <thead>
            <tr>
                <td>Вопрос</td>
                <td>Действие</td>
            </tr>
        </thead>
        <?php 
            foreach ($model->questions as $id => $quest) {
                $question_url = array(
                    'test_id'       => $test_id,
                    'question_id'   => $id
                );
                ?>
                    <tr>
                        <td><?=$quest->question?></td>
                        <td>
                            <a href = "<?=$this->createUrl('questions/remove', $question_url)?>">Удалить</a>
                            <a href = "<?=$this->createUrl('questions/update', $question_url)?>">Редактировать</a>
                        </td>
                    </tr>
                <?php
            }
        ?>
    </table><br />
    <?php 
        $add_question_url = $this->createUrl('questions/add', 
            array(
                'test_id' => $test_id
            )
        );
    ?>
    <a href = "<?=$add_question_url?>">Добавить вопрос</a>
    <br /><br />
    
    <input type = "submit" value = "Сохранить изменения" />
</form>
<a href = "<?=$this->createUrl("tests/index")?>">Вернутся к списку тестов</a>