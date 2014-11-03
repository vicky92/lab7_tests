<h2>Изменение характеристика</h2>
<form action = "" method = "POST">
    <label>
        Название характеристики <br />
        <input type = "text" name = "update[name]" value = "<?=$model->name?>" />
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
<a href = "<?=$this->createUrl("definitions/index")?>">Вернутся к списку тестов</a>