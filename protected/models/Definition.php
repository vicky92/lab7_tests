<?php
class Definition extends EMongoDocument {
    public $name = null;
    
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }
    
    public function getCollectionName() { return 'definitions'; }
    
    public function getAll() {
        return Definition::model()->findAll();
    }
    
    public function rules () {
        return array(
            array('name', 'required'),
            array('name', 'length', 'min' => 3),
        );
    }
}