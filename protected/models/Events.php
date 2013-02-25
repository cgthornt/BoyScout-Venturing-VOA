<?php
class Events extends CActiveRecord
{

    public static function model($className=__CLASS__) { return parent::model($className); }
    public function tableName() { return 'events'; }

    public function rules()
    {
        return array(
            array('title, desc,  contact_email,brief_desc, date, openings, sponsor', 'required'),
            array('desc', 'length', 'min' => 0, 'max' => 10000),
            array('brief_desc', 'length', 'min' => 0, 'max' => 500),
            array('openings', 'numerical', 'min' => 0, 'max' => 20),
            array('contact_email', 'email'),
            array('zip', 'numerical'),
            array('zip', 'length', 'min' => 0, 'max' => 5),
            array('url', 'url', 'allowEmpty' => true),
            //array('date', 'match', 'pattern' => '/^[0-9]{2}[\/-]{1}[0-9]{2}[\/-]{1}[0-9]{4}$/'),
        );
    }

    public function relations()
    {
        return array(
                'crew' => array(self::BELONGS_TO, 'Crews', 'ID_CREW'),
                'requests' => array(self::HAS_MANY, 'EventRequest', 'ID_EVENT'),
                'attachments' => array(self::HAS_ONE, 'Attachments', 'ID_ATTACHMENT'),
        );
    }
    
    /**
     * Can this user edit or delete this event?
     */
    public function canEdit()
    {
        return (Yii::app()->user->ID == $this->ID_USER);
    }
    

}

?>