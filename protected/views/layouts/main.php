<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <base href="http://chrisbuntu.brophyprep.org<?php echo Yii::app()->baseUrl; ?>/" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="description" content="<?php CHtml::encode($this->page['meta_desc']); ?>" />
    
    <title><?php echo CHtml::encode($this->page['title']); ?> | <?php echo Yii::app()->name; ?></title>
    
    <link rel="stylesheet" type="text/css" href="ui/css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="ui/css/typeography.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="ui/css/form.css" media="screen" />

    
    <script type="text/javascript" src="ui/js/include.js"></script>

    
</head>
<body>
<div id="holder">
    <div id="container">
        <div id="header">
            <a href="/" title="Home"></a>

            <h1>Crew 2040</h1>
        </div>
        
        <div id="content">
            
            <!-- Breadcrumb -->
            <div id="crumb" class="center">
                You are here:
                Home
            </div>
        
            <!-- Body -->
            <div id="right-body">

                <?php echo $content; ?>
            </div>
            
            <!-- Left Menu -->
            <div id="left-menu">
                
                
                        
                <div id="left-links">
                    
                        <?php $this->renderPartial('/layouts/_links', array('link' => $link)); ?>
        
                </div>


            </div>
            
            <!-- Footer -->
            <div id="footer-container">
                <div id="footer">
                                        &copy; 2010 Grand Canyon Council VOA <br />
                    Web site developed and maintained by Grand Canyon Council VOA youth
                    <?php
                    if(isset($this->page['date_edited']))
                        echo '<br />This page was last edited on ', $this->page['date_edited'];
                    ?>

                </div>
            </div>

            
        </div>
        
    </div>
</div>
</body>
</html>