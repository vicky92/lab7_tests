<?php
class AnswersController extends Controller {
    function actionAdd( $test_id, $question_id ) {
        $answer = new Answer;
        
        if (!empty($_POST['add_answer'])) 
        {
            $answer->attributes = $_POST['add_answer'];
            
            if ($answer->validate()) 
            {
                // Добавляем вопрос в тест
                
                $test = Test::model()->findByPK( new MongoID( $test_id ) );
                
                $answers = (array) $test->questions[$question_id]->answers;
                
                $answers[] = array('answer' => $answer->answer);
                
                unset($test->questions->answers);
                
                $test->questions[$question_id]->answers = (object)$answers;
                
                // Сохраняем изменения
                
                if ($test->save()) 
                {
                    $this->redirect (
                        $this->createUrl ('questions/update', array (
                            'test_id' => $test_id,
                            'question_id' => $question_id
                        ))
                    );
                }
            }
        }
        
		$this->render('add', array (
            'answer' => $answer, 
            'test_id' => $test_id, 
            'question_id' => $question_id
        ));
    }
    
    function actionUpdate( $test_id, $question_id, $answer_id ) {
        
        $test = Test::model()->findByPK( new MongoID( $test_id ) );
                
        $answers = (array) $test->questions[$question_id]->answers;
                
        $answer = $answers[$answer_id];
        
        if (!empty($_POST['update_answer'])) 
        {
            unset($test->questions->answers);
                
            $definitions = $_POST['update_answer']['definitions'];
            $answers[$answer_id] = array(
                'answer'        => $_POST['update_answer']['answer'],
                'definitions'   => $definitions,
            );
            
            
            $test->questions[$question_id]->answers = (object) $answers;
            
            // Сохраняем изменения
                
            if ($test->save()) 
            {
                $this->redirect (
                    $this->createUrl ('questions/update', array (
                        'test_id' => $test_id,
                        'question_id' => $question_id
                    ))
                );
            }
        }
        
		$this->render('update', array (
            'answer' => (object)$answer, 
            'test_id' => $test_id, 
            'question_id' => $question_id
        ));
    }
    
    function actionRemove( $test_id, $question_id, $answer_id ) {
        $test = Test::model()->findByPK( new MongoID( $test_id ) );
        
        // Получим все ответы на вопрос в тесте
        $answers = $test->questions[$question_id]->answers;
            
        // Находим и удаляем искомый ответ в базе
        unset($answers[$answer_id]);
        
        // Перезаписываем оставшиеся ответы
        $test->questions[$question_id]->answers = $answers;
        
        // Сохраняем изменения
        if ($test->save()) 
        {
            $this->redirect (
                $this->createUrl ('questions/update', array (
                    'test_id' => $test_id,
                    'question_id' => $question_id,
                ))
            );
        }
    }
}