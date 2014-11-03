<?php
class Question extends EMongoEmbeddedDocument {
    public $question = null;
    public $answers;
    
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }
    
    public function rules () {
        return array(
            array('question', 'required'),
            array('question', 'length', 'min' => 6),
        );
    }
}