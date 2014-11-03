<h2>Список тестов</h2>
  
<table border = "1" style = "width: 100%;">
    <thead>
        <tr>
            <td>Название теста</td>
            <td>Количество вопросов</td>
            <td>Действия</td>
        </tr>
    </thead>
    <?php
        // Получаем список тестов

        $tests = Test::getAll();
        
        foreach ($tests as $test) {
            ?>
                <tr>
                    <td>
                        <a href = "<?=$this->createUrl("tests/view", array("id" => $test->_id))?>"><?=$test->name?></a>
                    </td>
                    <td><?=$test->getQuestionsCount()?></td>
                    <td>
                        <a href = "<?=$this->createUrl('tests/update', array('test_id' => $test->_id))?>">Редактировать</a>
                        <a href = "<?=$this->createUrl('tests/remove', array('id' => $test->_id))?>">Удалить</a>
                    </td>
                </tr>
            <?php
        }
    ?>
</table> <br />
<?php 
    // Проверим наличие тестов

    if (count ($tests) < 1) {
        // В случае отсутствия тестов выводим информирующее сообщение
        ?>
            К сожалению ни одного теста еще не создано <br /><br />
        <?php
    }
?>

<a href = "<?=$this->createUrl("tests/add")?>">Добавить тест</a>