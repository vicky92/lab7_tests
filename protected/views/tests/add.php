<h2>Новый тест</h2>
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
    ?> <br />
    
    <input type = "submit" value = "Создать" />
</form>
<a href = "<?=$this->createUrl("tests/index")?>">Вернутся к списку тестов</a>