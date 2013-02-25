<?php
class Attachments extends CActiveRecord
{

    public static function model($className=__CLASS__) { return parent::model($className); }
    public function tableName() { return 'attachments'; }

    public function relations()
    {
        return array(
                'user' => array(self::BELONGS_TO, 'User', 'ID_USER'),
        );
    }

}

?>