<?php
class TestsController extends Controller {
    function actionIndex() {
		$this->render('index');
    }
    
    function actionView( $id, $question_id = 0, $answer = false ) {
        $test = Test::model()->findByPK( new MongoID( $id ) );
        $questions = $test->questions;
        $current_question = $questions[$question_id];
        
        // Определим поступил ли ответ на данный вопрос
        if (!$answer and !($answer === '0')) {
            // Если ответ не поступил выводим вараинты ответа
            $_SESSION['test_' . $test->_id][$question_id] = null;
        } else {
            // Если поступил ответ, переадресуем пользователя на след. вопрос
            // Либо покажем результат если вопросов больше нет
            $_SESSION['test_' . $test->_id][$question_id] = $answer;
            
            if (($question_id + 1) >= count($questions)) {
                // Вопросов больше нет.
                // Генерируем результат
                
                // Проходим по всем вопросам
                $session_definitions = array();
                foreach ($questions as $quest_id => $quest) {
                    $user_answer = $_SESSION['test_' . $test->_id][$quest_id];
                    $temp_answers = (array) $quest->answers;
                    
                    $user_definitions = (array) $temp_answers[$user_answer]['definitions'];
                    
                    foreach($user_definitions as $definition) {
                        $session_definitions[$definition]++;
                    }
                }
                
                $this->render("result",
                    array(
                        'definitions' => $session_definitions
                    )
                );
                
                die();
            }
            var_dump(($question_id + 1));
            // Переадресовываем пользователя на след. вопрос
            $this->redirect (
                $this->createUrl('tests/view', array(
                    'id' => $id,
                    'question_id' => ($question_id + 1),
                ))
            );
        }
        
        // Показываем страницу с вопросом
		$this->render('view', array (
            'test' => $test,
            'question' => $current_question,
            'question_id' => $question_id,
            'question_num' => ($question_id + 1)
        ));
    }
    
    /*
     *  Создание теста
     */
    
    function actionAdd() {
        $model = new Test;
        
        if (!empty($_POST['add'])) {
            $model->attributes = $_POST['add'];
            
            // Проверяем правильность введенной информации
            
            if ($model->validate()) {
                
                // Создаем новый тест
                
                if ($model->save()) {
                    
                    // Перенаправляем пользователя на страницу редактирования
                    
                    $this->redirect(
                        $this->createUrl('tests/update', array (
                            'test_id' => $model->_id
                        ))
                    );
                }
            }
        }
        
        $this->render("add", array("model" => $model));
    }
    
    
    /*
     *  Удаление теста
     */
    
    function actionUpdate( $test_id ) {
        $model = Test::model()->findByPK( new MongoID( $test_id ) );
        
        if (!empty($_POST['update'])) {
            $model->attributes = $_POST['update'];
            
            // Проверяем правильность введенной информации
            
            if ($model->validate()) {
                
                // Сохраняем изменения
                
                if ($model->save()) {
                    
                    // Перенаправляем пользователя на страницу c тестом
                    
                    $this->redirect(
                        $this->createUrl('tests/view', array (
                            'id' => $model->_id
                        ))
                    );
                }
            }
        }
        
        $this->render("update", array("model" => $model, 'test_id' => $test_id));
    }
    
    
    /*
     *  Редактирование теста
     */
    
    function actionRemove( $id ) {
        $test = Test::model()->findByPK( new MongoID( $id ) );
        
        if ($test->delete()) {
            $this->redirect(
                $this->createUrl("tests/index")
            );
        }
    }
}