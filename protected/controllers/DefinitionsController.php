<?php
class DefinitionsController extends Controller {
    
    function actionIndex() {
		$this->render('index');
    }
    
    
    /*
     *  Создание хар-ки
     */
    
    function actionAdd() {
        $model = new Definition();
        
        if (!empty($_POST['add'])) {
            $model->attributes = $_POST['add'];
            
            // Проверяем правильность введенной информации
            
            if ($model->validate()) {
                
                // Создаем новый тест
                
                if ($model->save()) {
                    
                    // Перенаправляем пользователя на страницу редактирования
                    
                    $this->redirect(
                        $this->createUrl('definitions/index')
                    );
                }
            }
        }
        
        $this->render("add", array("model" => $model));
    }
    
    
    /*
     *  Редактирование хар-ки
     */
    
    function actionUpdate( $id ) {
        $model = Definition::model()->findByPK( new MongoID( $id ) );
        
        if (!empty($_POST['update'])) {
            $model->attributes = $_POST['update'];
            
            // Проверяем правильность введенной информации
            
            if ($model->validate()) {
                
                // Создаем новый тест
                
                if ($model->save()) {
                    $this->redirect(
                        $this->createUrl('definitions/index')
                    );
                }
            }
        }
        
        $this->render("update", array("model" => $model));
    }
    
    
    /*
     *  Удаление хар-ки
     */
    
    function actionRemove ( $id ) {
        $model = Definition::model()->findByPK( new MongoID( $id ) );
        
        if ($model->delete()) {
            $this->redirect(
                $this->createUrl('definitions/index')
            );
        }
    }
}