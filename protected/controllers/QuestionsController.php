<?php
class QuestionsController extends Controller {
    function actionAdd( $test_id ) {
        $question = new Question;
        
        if (!empty($_POST['add_question'])) 
        {
            $question->attributes = $_POST['add_question'];
            
            if ($question->validate()) 
            {
                // Добавляем вопрос в тест
                
                $test = Test::model()->findByPK( new MongoID( $test_id ) );
                $test->questions[] = $question;
                
                // Сохраняем изменения
                
                if ($test->save()) 
                {
                    $this->redirect (
                        $this->createUrl ('tests/update', array (
                            'test_id' => $test_id,
                        ))
                    );
                }
            }
        }
        
		$this->render('add', array('model' => $question, 'test_id' => $test_id));
    }
    
    function actionUpdate( $test_id, $question_id ) {
        $test = Test::model()->findByPK( new MongoID( $test_id ) );
        
        $question = $test->questions[$question_id];
        
        if (!empty($_POST['update_question'])) {
            $question->attributes = $_POST['update_question'];
            
            $test->questions[$question_id] = $question;
            
            if ($test->save()) {
                $this->redirect(
                    $this->createUrl("questions/update", array (
                        "test_id" => $test_id,
                        "question_id" => $question_id
                    ))
                );
            }
        }
        
        $this->render('update', array(
            'question' => $question,
            'test' => $test,
            'question_id' => $question_id
        ));
    }
    
    function actionRemove( $test_id, $question_id ) {
        $test = Test::model()->findByPK( new MongoID( $test_id ) );
        
        unset($test->questions[$question_id]);
        
        if ($test->save()) 
        {
            $this->redirect (
                $this->createUrl ('tests/update', array (
                    'test_id' => $test_id
                ))
            );
        }
    }
}