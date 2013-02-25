<?php

$statusBoxId  = 'fancy-status';
$clearButton  = 'fancy-clear';
$uploadButton = 'fancy-upload';

$this->widget('application.extensions.fancyupload.SFancyQueue',
    array(
        'name'=>'form-fancy',
        'statusBoxId'=>$statusBoxId,            //id for the container div
        'clearButton'=>$clearButton,            //id for "Clear List" link
        'uploadButton'=>$uploadButton,          //id for "Start Upload" link
        'clearButtonLabel'=>'Limpar Lista',     //label for "Clear List" link
        'uploadButtonLabel'=>'Start Upload',    //label for "Start Upload" link
        'targetLabel'=>'Select Files',          //label for "select files" link
        'options'=> array(
                'verbose'=>true,  //remove in production
                'url'=>$this->createUrl('fancy/UploadedFiles'),          //send files to this controller/action
                'multiple'=>true,                                       //multiple files
                'target'=>'fancy-browse',                               //id for "select files" link
                'typeFilter'=>array('Images (jpg, jpeg, gif, png)'=>'*.jpg; *.jpeg; *.gif; *.png','Compressed (zip, rar)'=>'*.zip; *.rar'),   //accept only images and compressed files (better check the mimetype in the controller which receives the file)
                'instantStart'=>false,                                  //do not upload right after the selection of files
                'data'=>array('extradata'=>'your_additional_content'),  //accessible in the controller via $_POST['extradata'] or $_POST['whatever_you_put_in_the_key']
            ),

            
        'callbacks' => array(
            //'onComplete' => 'function(){alert("Complete");}',
            //'onCancel' => 'function(evt,queueId,fileObj,data){alert("Cancelled");}',

            'onLoad'=>"function() {
                    document.id('$statusBoxId').removeClass('hide');
                    document.id('fancy-fallback').destroy();

                    // We relay the interactions with the overlayed flash to the link
                    this.target.addEvents({
                            click: function() {
                                    return false;
                            },
                            mouseenter: function() {
                                    this.addClass('hover');
                            },
                            mouseleave: function() {
                                    this.removeClass('hover');
                                    this.blur();
                            },
                            mousedown: function() {
                                    this.focus();
                            }
                    });

                    // Interactions for the 2 other buttons

                    document.id('$clearButton').addEvent('click', function() {
                            up.remove(); // remove all files
                            return false;
                    });

                    document.id('$uploadButton').addEvent('click', function() {
                            up.start(); // start upload
                            return false;
                    });
            }",


            'onFail'=> 'function(error) {
                            switch (error) {
                                    case "hidden": // works after enabling the movie and clicking refresh
                                            alert("Para habilitar o sistema de upload, desbloqueie no seu browser e atualize.");
                                            break;
                                    case "blocked": // This no *full* fail, it works after the user clicks the button
                                            alert("Para habilitar o sistema de upload, habilite o filme flash bloqueado");
                                            break;
                                    case "empty": // Oh oh, wrong path
                                            alert("O sistema de upload parece estar faltando, por favor, tente mais tarde");
                                            break;
                                    case "flash": // no flash 9+ :(
                                            alert("Precisa ter o plugin do Adobe Flash 9 ou superior para usar o upload")
                            }
                    }',

            'onFileSuccess'=> "function(file, response) {
                var json = new Hash(JSON.decode(response, true) || {});

                if (json.get('status') == '1') {
                        file.element.addClass('file-success');
                        file.info.set('html', '<strong>File sent:</strong> (' + json.get('width') + ' x ' + json.get('height') + 'px, <em>' + json.get('mime') + '</em>)');
                } else {
                        file.element.addClass('file-failed');
                        file.info.set('html', '<strong>Error sending:</strong> (' + (json.get('error') ? (json.get('error') + ' #' + json.get('code')) : response));
                }
            }",


            'onSelectFail'=> "function(files) {
                    files.each(function(file) {
                            new Element('li', {
                                    'class': 'validation-error',
                                    html: file.validationErrorMessage || file.validationError,
                                    title: MooTools.lang.get('FancyUpload', 'removeTitle'),
                                    events: {
                                            click: function() {
                                                    this.destroy();
                                            }
                                    }
                            }).inject(this.list, 'top');
                    }, this);
            }",


            /*'onFileComplete'=> "function(file) {
                    up.fileRemove(file);
            }",*/

            'onComplete'=>"function() {
               // document.id('fancy-status').setStyle('display','none');
               //up.remove();
               el = document.search('.file-success');
               for (i=0; i<el.length; i++){
                   el[i].destroy();
               }
            }",




//'onBeforeStart'=>"function() {
//var hash = {};
//document.cookie.split(/;\s*/).each(function(cookie) {
//cookie = cookie.split('=');
//if (cookie.length == 2) {
//hash[decodeURIComponent(cookie[0])] = decodeURIComponent(cookie[1]);
//}
//});
//
//up.setOptions({
//data: {cookieName: hash['myfield'], myfield: document.id('myfield').get('value')}
//});
//}",



        )
        
    ));
?>

