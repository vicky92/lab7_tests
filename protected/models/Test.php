<?php
class Test extends EMongoDocument {
    public $name = null;
    public $questionsCount = 0;
    public $questions = array();
    
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }
    
    public function getCollectionName() { return 'tests'; }
    
    public function rules () {
        return array(
            array('name', 'required'),
            array('name', 'length', 'min' => 5),
        );
    }
    
    public static function getAll() {
        return Test::model()->findAll();
    }
    
    function getQuestionsCount () {
        return $this->questionsCount = count ( $this->questions );
    }
    
    public function behaviors() {
        return array(
            'embeddedArrays' => array(
                'class'             => 'ext.YiiMongoDbSuite.extra.EEmbeddedArraysBehavior',
                'arrayPropertyName' => 'questions',
                'arrayDocClassName' => 'Question'
            ),
        );
    }
}