<h2>Результат теста</h2>
<table border = "1" style = "width: 100%;">
    <tr>
        <td>Характеристика</td>
        <td>Значение</td>
    </tr>
<?php
    foreach ($definitions as $definition => $value) {
        $definition = Definition::model()->findByPK( new MongoID( $definition ) );
        ?>
            <tr>
                <td><?=$definition->name?></td>
                <td><?=$value?></td>
            </tr>
        <?php
    }
?>
</table>