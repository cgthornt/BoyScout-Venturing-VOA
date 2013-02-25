<?php
class Pages extends CActiveRecord
{

    public static function model($className=__CLASS__) { return parent::model($className); }
    public function tableName() { return 'pages'; }


    
    public function create($title, $title_url, $content, $id_sub = 0, $meta_desc = null, $meta_keys = null)
    {
        $pg = new Pages();
        $pg->title     = $title;
        $pg->content   = $content;
        $pg->id_sub    = $id_sub;
        $pg->title_url = $title_url;
        $pg->meta_desc = $meta_desc;
        $pg->meta_keys = $meta_keys;
        
        $pg->date_created = date('"Y-m-d H:i:s');
        $pg->date_edited  = $pg->date_created;
        $pg->save();
        
    }
    
    public function scopes()
    {
        return array(
            'links'=>array(
                'order'=>'position ASC',
                //'limit'=>5,
            ),
        );

    }
}

?>