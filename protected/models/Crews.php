<?php
class Crews extends CActiveRecord
{

    public static function model($className=__CLASS__) { return parent::model($className); }
    public function tableName() { return 'crews'; }

    public function relations()
    {
        return array(
                'events' => array(self::HAS_MANY, 'Events', 'ID_CREW'),
        );
    }
    
    public function rules()
    {
        return array(
            //array('crew', 'unique',  'attribute' => 'crew', 'className' => 'Crews' ),
            array('crew, desc, specialties, city', 'required'),
            array('desc, specialties', 'length', 'min' => 0, 'max' => 1000),
            array('zip, crew', 'numerical'),
            array('zip, crew', 'length', 'min' => 0, 'max' => 5),
            array('url', 'url', 'allowEmpty' => true),
            //array('date', 'match', 'pattern' => '/^[0-9]{2}[\/-]{1}[0-9]{2}[\/-]{1}[0-9]{4}$/'),
        );
    }
    
    /**
     * Does the user currently own this crew?
     */
    public function isOwner()
    {
        return (Yii::app()->user->crew->ID == $this->ID); 
    }

}

?>