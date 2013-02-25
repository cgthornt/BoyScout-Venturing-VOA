<?php

class FancyController extends CController
{

    //render view
    public function actionFancy(){
        $this->render('fancyqueue');
    }

    //render view
    public function actionFancySingle(){
        $this->render('fancysingle');
    }


    //handle uploaded files
    public function actionUploadedFiles(){
        $file = CUploadedFile::getInstanceByName("Filedata");

        $return = array(
                'status' => '1',
                'name' => $file->getName()
        );

        /**
         * ATENTION: this is for demonstration purposes only.
         * In a real world application, you'd better validate
         * the files according to your needs
         */
        switch(CFileHelper::getMimeType($file->getTempName())){
           case 'application/zip':
               break;

           case 'image/jpeg':
               $info = @getimagesize($file->getTempName());
                if ($info) {
                    $return['width']  = $info[0];
                    $return['height'] = $info[1];
                    $return['mime']   = $info['mime'];
                }
               break;

           default:
                $return = array(
                    'status' => '0',
                    'error' => 'Tipo de arquivo não permitido'
                );
        }


        $file->saveAs(Yii::app()->getBasePath().'/tmp/'.$file->getName());
        echo json_encode($return);
    }

}