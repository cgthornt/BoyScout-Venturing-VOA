<?php
$statusBoxId = 'fancy-single';
 
$this->widget('application.extensions.fancyupload.SFancySingleButton',
    array('name'=>'single',
           'statusBoxId'=>$statusBoxId,
           'options'=>array(
                'target'=>'select-0',
                'queued'=>false,                                //only one file uploaded
                'multiple'=>false,                              //only select one file
                'verbose'=>true,                                //remove in production
                'url'=> 'protected/uploads',  //send files to this controller/action
                //'typeFilter'=>array('Images (jpg, jpeg, gif, png)'=>'*.jpg; *.jpeg; *.gif; *.png'),  //only images
                'instantStart'=>true,                           //start upload right after the selecion
                'appendCookieData'=>true,                       //send cookies together
            ),
 
 
            'callbacks'=>array(
                'onSelectSuccess'=>"function(files) {
                    if (Browser.Platform.linux) window.alert('Warning: Due to a misbehaviour of Adobe Flash Player on Linux,the browser will probably freeze during the upload process.Since you are prepared now, the upload will start right away ...');
                        window.alert('Starting Upload - ' + files[0].name + '(' + Swiff.Uploader.formatUnit(files[0].size, 'b') + ')');
                        this.setEnabled(false);
                }",
 
                'onSelectFail'=>"function(files) {
                     window.alert(files[0].name + '(Error: #' + files[0].validationError + ')');
                }",
 
 
                'onQueue'=>"function() {
                     if (!swf.uploading) return;
                     var size = Swiff.Uploader.formatUnit(swf.size, 'b');
                     link.set('html', swf.percentLoaded + '% - ' + size);
                }",
 
 
                'onFileComplete'=>"function(file) {
 
                    if (file.response.error) {
                        window.alert('Failed Upload ' + this.fileList[0].name + '. Please try again. (Error: #' + this.fileList[0].response.code + ' ' + this.fileList[0].response.error + ')');
                    } else {
                        window.alert('Successful Upload');
                    }
 
                    file.remove();
                    this.setEnabled(true);
                }",
 
                'onComplete'=>"function() {
                    link.set('html', linkIdle);
                }",
 
            )
 
 
));?>