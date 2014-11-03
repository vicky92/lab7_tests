<?php
class Answer extends EMongoEmbeddedDocument {
    public $answer = null;
    
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }
    
    public function rules () {
        return array(
            array('answer', 'required'),
            array('answer', 'length', 'min' => 6),
        );
    }
}