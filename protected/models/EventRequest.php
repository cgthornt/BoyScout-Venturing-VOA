<?php
class EventRequest extends CActiveRecord
{

    public static function model($className=__CLASS__) { return parent::model($className); }
    public function tableName() { return 'events_requests'; }

    public function rules()
    {
        return array(
            array('title, body', 'required'),
            array('body', 'length', 'max'=> 1000),
        );
    }

    public function relations()
    {
        return array(
                'events' => array(self::BELONGS_TO, 'Events', 'ID'),
        );
    }

}

?>