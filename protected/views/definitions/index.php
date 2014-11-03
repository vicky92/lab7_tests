<h2>Список всех характеристик</h2>
  
<table border = "1" style = "width: 100%;">
    <thead>
        <tr>
            <td>Название характеристики</td>
            <td>Действия</td>
        </tr>
    </thead>
    <?php
        // Получаем список характеристик

        $definitions = Definition::getAll();
        
        foreach ($definitions as $definition) {
            ?>
                <tr>
                    <td>
                        <a href = ""><?=$definition->name?></a>
                    </td>
                    <td>
                        <a href = "<?=$this->createUrl('definitions/update', array('id' => $definition->_id))?>">Редактировать</a>
                        <a href = "<?=$this->createUrl('definitions/remove', array('id' => $definition->_id))?>">Удалить</a>
                    </td>
                </tr>
            <?php
        }
    ?>
</table> <br />

<a href = "<?=$this->createUrl('definitions/add')?>">Добавить характеристику</a>