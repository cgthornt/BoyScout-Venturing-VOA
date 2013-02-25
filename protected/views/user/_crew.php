<?php
if($crew == null)
    $crew = Yii::app()->user->crew;

?>
<?php
if($crew == null)
{
?>
<h2 class="tabs-text-header">No Crew Found</h2>
<p>The crew was not found. Perhaps you meant to <?php echo CHtml::link('Create a Crew', 'crews/create'); ?>?
</p>
<?php } else { ?>

<h2 class="tabs-text-header">Crew <?php echo $crew->crew; ?></h2>
    
        <p>
            <?php echo nl2br(CHtml::encode($crew->desc)); ?>
        </p>
        
        <h3>Specalties</h3>
        
        <p>
            <?php echo nl2br(CHtml::encode($crew->specialties)); ?>
        </p>

        
    <table class="nicetable" style="margin-top:20px">
        <tr class="nicetable-entry">
            <td class="nicetable-head" style="width:150px">Zip</td>
            <td style="width:250px">
            <?php if(empty($crew->zip)) echo '<em>No Zip Defined</em>'; else echo $crew->zip; ?>
            </td>
        </tr>
        
        <tr class="nicetable-entry">
            <td class="nicetable-head">City</td>
            <td>
            <?php echo $crew->city; ?>
            </td>
        </tr>
        
        
        <tr class="nicetable-entry">
            <td class="nicetable-head">Web site</td>
            <td>
            <?php echo $crew->url; ?>
            </td>
        </tr>
        

        
        <tr class="nicetable-entry">
            <td class="nicetable-head">ID</td>
            <td><?php echo $crew->ID; ?></td>
        </tr>
    </table>
    
    <?php if($crew->isOwner() || Yii::app()->user->isAdmin()) { ?>
    <p>
        <?php echo CHtml::link('Edit crew', 'crews/edit/?id=' . $crew->ID); ?>  
    </p>
    <?php } ?>

<?php } ?>