<?php
/**
* Yii extension implementing mootools fancyupload 3
*
* I borrowed code from EuploadifyWidget and JUI extensions.
*
* This widget generates an instance of fancyupload project, which is a Harald Kirschner's project (visit http://digitarald.de/project/fancyupload/)
*
* @author Scoob Junior
* @version 1.2
* @filesource SFancyUpload.php
*
*/
class SFancySingleButton extends CInputWidget
{
   //***************************************************************************
   // Internal properties
   //***************************************************************************
    private $options   = array();
    private $callbacks = array();
    private $baseUrl;
    private $clientScript;
    private $action;
    private $progressBarImage;

    private $target;  //the browse button, it's present in the options array, but duplicated here for easier html integration
    public  $targetLabel;
    public  $statusBoxId;



   //***************************************************************************
   // Valid options
   //***************************************************************************
    protected $validOptions = array(
        'path' => array('type'=>'string'),              //(string: defaults to “Swiff.Uploader.swf”) The relative or absolute path to the Flash movie (Swiff.Uploader.swf) on the server
        'height' => array('type'=>'integer'),           //(number: defaults to 30) Only needed if you use buttonImage, otherwise its handled positioned over the target.
        'width' => array('type'=>'integer'),            //(number: defaults to 100) Only needed if you use buttonImage, otherwise its handled positioned over the target.
        'typeFilter'=> array('type'=>'array'),          //(object|string: defaults to null) Key/value pairs are used as filters for the dialog. Possible pair would be 'Images (*.jpg, *.jpeg, *.gif, *.png)': '*.jpg; *.jpeg; *.gif; *.png'.
        'multiple' => array('type'=>'boolean'),         //(boolean: defaults to true) If true, the browse-dialog allows multiple-file selection.
        'queued' => array('type'=>array('integer','boolean')),           //(number: defaults to 1) Maximum of currently running files. If this is false, all files are uploaded at once.
        'verbose' => array('type'=>'boolean'),          //(boolean: defaults to false) Debug mode, logs messages and all events from Flash during development (using console.info).
        'target'=> array('type'=>'string'),             //(element: defaults to null) If given, the browse-element is overlayed with a transparent movie. The Events click/mouseenter/mouseleave/disabled are fired as events on target.
        'zIndex'=> array('type'=>'integer'),            //(number: defaults to 9999) Only used if a target is given, this sets the z-index for the overlay.
        'buttonImage'=> array('type'=>'string'),        //(string: defaults to null) Sprite for the upload button, has to have 4 states vertically aligned: Normal, hovered, clicked and disabled. Make sure to adapt the options width and height.
        'policyFile'=> array('type'=>'string'),         //(string: defaults to null) Location the cross-domain policy file. See Flash Security.loadPolicyFile.
        'url'=> array('type'=>'string'),                //(string: defaults to null) URL to the server-side script (relative URLs are changed automatically to absolute paths).
        'method'=> array('type'=>'string','possibleValues'=>array('post', 'get')),             //(string: defaults to ‘post’) If the method is ‘get’, data is appended as query-string to the URL. The upload will always be a POST request.
        'data'=> array('type'=>array('string','array')), //(object|string: defaults to null) Key/data values that are sent with the upload requests.
        'mergeData'=> array('type'=>'boolean'),         //(boolean: defaults to true) If true, the data option from uploader and file is merged (prioritised file data).
        'fieldName'=> array('type'=>'string'),          //(string: defaults to “Filedata”) The key of the uploaded file on your server, similar to name in a file-input. Linux Flash ignores it, better avoid it.
        'fileSizeMin'=> array('type'=>'integer'),       //(number: defaults to 1) Validates the minimal size of a selected file byte.
        'fileSizeMax'=> array('type'=>'integer'),       //(number: defaults to 0) Validates the maximal size of a selected file (official limit is 100 MB for FileReference, I tested up to 2 GB)
        'allowDuplicates'=> array('type'=>'boolean'),   //(boolean: defaults to false) Validates that no duplicate files are added.
        'timeLimit'=> array('type'=>'integer'),         //(number: default 30, 0 for linux) Timeout in seconds. If the upload is without progress, it is cancelled and event complete gets fired (with error string timeout). Occurs usually when the server sends an empty response (also on redirects).
        'fileList'=> array('type'=>'boolean'),          //(boolean: defaults to false) Validates that no duplicate files are added.
        'fileListMax'=> array('type'=>'integer'),       //(number: defaults to 0) Validates the overall file count.
        'fileListSizeMax'=> array('type'=>'integer'),   //(number: defaults to 0) Validates the overall file size in byte.
        'instantStart'=> array('type'=>'boolean'),      //(boolean: defaults to false) If true, the upload starts right after a successful file selection.
        'appendCookieData'=> array('type'=>array('boolean', 'string')),   //????(boolean|string: defaults to false) If this is not false, the cookies of the browser are merged into the given options data. If a string is given, it is used as key for the data.
//        'fileClass'=> array('type'=>'string'),          //(class: defaults to Swiff.Uploader.File) An instance of this class is created for every selected file.
    );

   //***************************************************************************
   // Valid callbacks
   //***************************************************************************
    protected $validCallbacks = array(
    'onLoad',               //- (function) Function to execute when the Flash movie is initialised.
    'onFail',               //- (function) Function to execute when the loading is prevented. First argument is the error type and can be:
                                 //     o flash - Flash is not installed or the Flash version did not meet the requirements.
                                 //     o blocked - The user has to enable the movie manually because of Flashblock, no refresh required.
                                 //     o empty - The Flash movie failed to load, check if the file exists and the path is correct.
                                 //     o hidden - Adblock Plus blocks hides the movie, the user has enable it and refresh.
    'onStart',              //(functcy ion) Function to execute when the upload starts.
    'onQueue',              //(function) Function to execute when the queue statistics are updated.
    'onComplete',           //(function) Function to execute when all files are uploaded (or stopped).
    'onBrowse',             //(function) Function to execute when the browse-dialog opens.
    'onDisabledBrowse',     //(function) Function to execute when the user tries to open the browse-dialog, but the uploader is disabled.
    'onCancel',             //(function) Function to execute when the user closes the browse-dialog without a selection.
    'onSelect',             //(function) Function to execute when the user selected files in the dialog. Preferred events are selectSuccess and selectFail!
                                        // 1. successFiles (array|null) Raw file data for successfully added files.
                                        // 2. failFiles (array|null) Raw file data for invalid files that were not added.
    'onSelectSuccess',      //(function) Function to execute when files were selected and validated successfully.
                                    // 1. successFiles (array|null) Added file instances (see option fileClass).
    'onSelectFail',         //(function) Function to execute when files were selected and failed validation.
                                    //1. failFiles (array|null) Dismissed file instances (see option fileClass).
    'onReposition',         //(function) Function to execute when reposition method is called on uploader (usually on window-resize).
    'onBeforeStart',        //(function) Function to execute when start method is called on uploader.
    'onBeforeStop',         //(function) Function to execute when stop method is called on uploader.
    'onBeforeRemove',       //(function) Function to execute when remove method is called on uploader.
    'onButtonEnter',        //(function) Function to execute when the mouse enters the browse button.
    'onButtonLeave',        //(function) Function to execute when the mouse leave the browse button.
    'onButtonDown',         //(function) Function to execute when the mouse clicks the browse button.
    'onButtonDisable',      //(function) Function to execute when the script disables the browse button.
    'onFileStart',          //(function) Function to execute when flash initialised the upload for a file.
    'onFileStop',           //(function) Function to execute when a file got stopped manually.
    'onFileRequeue',        //(function) Function to execute when a file got added back to the queue after being stopped or completed.
    'onFileOpen',           //(function) Function to execute when the file is accessed before for upload.
    'onFileProgress',       //(function) Function to execute when the upload reports progress.
    'onFileComplete',       //(function) Function to execute when a file is uploaded or failed with an error.
    'onFileRemove',         //(function) Function to execute when a file got removed.
    'onFileSuccess',
    );



   //***************************************************************************
   // Getters and Setters
   //***************************************************************************

    /**
    * Getter
    * @return array
    */
    public function getCallbacks()
    {
        return $this->callbacks;
    }

   /**
    * Setter
    * @param array $value callbacks
    */
    public function setCallbacks($value)
    {
        if (!is_array($value))
            throw new CException(Yii::t('SFancyUpload', 'callbacks must be an associative array'));
        self::checkCallbacks($value, $this->validCallbacks);
        $this->callbacks = $value;
    }

    /**
    * Getter
    * @return array
    */
    public function getOptions()
    {
        return $this->options;
    }

    /**
    * Setter
    * @param mixed $value
    */
    public function setOptions($value)
    {
        if (!is_array($value))
            throw new CException(Yii::t('SFancyUpload', 'options must be an array'));
        self::checkOptions($value, $this->validOptions);
        $this->options = $value;
    }



   //***************************************************************************
   // Utilities
   //***************************************************************************
    /**
    * From JUI
    * Check callbacks against valid callbacks
    * @param array $value user's callbacks
    * @param array $validCallbacks valid callbacks
    */
    protected static function checkCallbacks($value, $validCallbacks)
    {
        if (!empty($validCallbacks)) {
            foreach ($value as $key=>$val) {
                if (!in_array($key, $validCallbacks)) {
                    throw new CException(Yii::t('SFancyUpload', '{k} must be one of: {c}', array('{k}'=>$key, '{c}'=>implode(', ', $validCallbacks))));
                }
            }
        }
    }

    /**
    * From JUI extension
    * Check the options against the valid ones
    *
    * @param array $value user's options
    * @param array $validOptions valid options
    */
    protected static function checkOptions($value, $validOptions)
    {
        if (!empty($validOptions)) {
            foreach ($value as $key=>$val) {

                if (!array_key_exists($key, $validOptions)) {
                    throw new CException(Yii::t('SFancyUpload', '{k} is not a valid option', array('{k}'=>$key)));
                }
                $type = gettype($val);
                if ((!is_array($validOptions[$key]['type']) && ($type != $validOptions[$key]['type'])) || (is_array($validOptions[$key]['type']) && !in_array($type, $validOptions[$key]['type']))) {
                        throw new CException(Yii::t('SFancyUpload', '{k} must be of type {t}',
                        array('{k}'=>$key,'{t}'=>$validOptions[$key]['type'])));
                }
                if (array_key_exists('possibleValues', $validOptions[$key])) {
                   if (!in_array($val, $validOptions[$key]['possibleValues'])) {
                        throw new CException(Yii::t('SFancyUpload', '{k} must be one of: {v}', array('{k}'=>$key, '{v}'=>implode(', ', $validOptions[$key]['possibleValues']))));
                   }
                }
                if (($type == 'array') && array_key_exists('elements', $validOptions[$key])) {
                        self::checkOptions($val, $validOptions[$key]['elements']);
                }

            }
        }
    }


   /**
    * Encode options and callbacks
    * @return string
    */
   protected function createOptions()
   {
        if(!array_key_exists('path', $this->options))
            $this->options['path'] = $this->baseUrl . '/fancy/source/Swiff.Uploader.swf';

        $this->action = $this->options['url'];
        $this->progressBarImage  = $this->baseUrl.'/fancy/assets/progress-bar/bar.gif';


        //visual elements
        if(empty($this->statusBoxId))
            $this->statusBoxId = 'fancy-status';

        //buttons
        if(!array_key_exists('target', $this->options))
            $this->options['target'] = 'fancy-browse';  //selFile button

        if(empty($this->target))
            $this->target = $this->options['target'];

        if(empty($this->targetLabel))
            $this->targetLabel = 'Change';

        $this->options = array_merge($this->options, $this->callbacks);
        $encodedOptions = self::encode($this->options);
        return $encodedOptions;
   }


    /**
    * Encode an array into a javascript array
    *
    * @param array $value
    * @return string
    */
    private static function encode($value)
    {
        $es=array();
        $n=count($value);
        if (($n)>0 && array_keys($value)!==range(0,$n-1)) {
            foreach($value as $k=>$v)
            {
                if(is_bool($v) || is_numeric($v) || substr($k,0,2) == "on")         // || substr($k,0,2) == "on"
                {
                    if($v===true) $v = 'true';
                    if($v===false) $v = 'false';

                    $es[] = $k . ":" . $v ;
                }
                elseif($k == 'scriptData')
                {
                    $sd ='';
                    foreach($v as $dkey=>$dval)
                    {
                        $sd .= $dkey .":'" . $dval ."',";
                    }
                    $es[] = $k . ":{" . $sd . "}";
                }
                elseif(is_array($v))
                {
                    $sd ='';
                    foreach($v as $dkey=>$dval)
                    {
                        $sd .= "'".$dkey ."':'" . $dval ."',";
                    }
                    $es[] = $k . ":{" . $sd . "}";

                }  else
                    $es[] = $k . ":'" .$v . "'";
            }

            return ''.implode(',',$es).'';
        } else {
            foreach($value as $v)
            {
                $es[] = "'" . $v . "'";
            }
            return '[' . implode(',',$es) . ']';
        }
    }



   /**
    * Publishes the assets
    */
   public function publishAssets()
   {
      $dir = dirname(__FILE__);
      $this->baseUrl = Yii::app()->getAssetManager()->publish($dir);
   }

   /**
    * Registers the external javascript files
    */
   public function registerClientScripts()
   {
        if ($this->baseUrl === '')
            throw new CException(Yii::t('SFancyUpload', 'baseUrl must be set. This is done automatically by calling publishAssets()'));

        $this->clientScript = Yii::app()->getClientScript();
        $this->clientScript->registerScriptFile($this->baseUrl.'/fancy/source/mootools-1_2_4-fancy.js');
        $this->clientScript->registerScriptFile($this->baseUrl.'/fancy/source/Fx.ProgressBar.js');
        $this->clientScript->registerScriptFile($this->baseUrl.'/fancy/source/Swiff.Uploader.js');
        $this->clientScript->registerCssFile($this->baseUrl.'/fancy/assets/fancy.css');
   }


   /**
    * The javascript needed
    */
   protected function createJsCode($options){

    $js=<<<EOP
        window.addEvent('domready', function() {

         var link = document.id('$this->target');
         var linkIdle = link.get('html');

         // Uploader instance
         var swf = new Swiff.Uploader({
            $options,
         });

         // Button state
         link.addEvents({
             click: function() {
                return false;
             },

             mouseenter: function() {
                this.addClass('hover');
                swf.reposition();
             },

             mouseleave: function() {
                this.removeClass('hover');
                this.blur();
             },

             mousedown: function() {
                this.focus();
             }
        });
    });
EOP;
 
       return $js;
   }






   /*
    * The HTML markup
    */
   public function createHtml(){
       $html=<<<EOP
	<div id="$this->name">
		<div id="$this->statusBoxId">
                    <a href="#" id="$this->target">$this->targetLabel</a>
                </div>
        </div>
EOP;

       return $html;
   }



   //***************************************************************************
   // Run
   //***************************************************************************
   /**
    * Run the widget
    */
   public function run()
   {
        $this->publishAssets();
        $this->registerClientScripts();

        list($name, $id) = $this->resolveNameID();
        $options = $this->createOptions();

        $js = $this->createJsCode($options);
        $this->clientScript->registerScript('jsfancysb', $js, CClientScript::POS_HEAD);

        $html = $this->createHtml();

        echo $html;

   }
}




