<?php
$obj = !empty($params['obj']) ? $params['obj'] : NULL;
$post_id = !empty($params['post_id']) ? $params['post_id'] : NULL;

if ( !empty($obj) && !empty($post_id) ) :

    $data = SCFP()->getSettings()->getFieldsSettings();
    $id = $obj->getId();
    $index = uniqid();
?>
<div class="agp-repeater" id="agp-repeater-<?php echo $id?>" data-id="<?php echo $id?>">
    <table class="wp-list-table widefat scfp-settings-table">
        <thead>
            <?php echo $obj->getHeaderTemplateAdmin(); ?>
        </thead>        
        <tbody id="the-list">
            <?php
            if (!empty($data)):
                foreach ($data as $key => $value) :
                    $rowClass = !empty($value['no_delete']) ? ' alternate' : '';
            ?>
                <tr class="agp-row<?php echo $rowClass?>">
                    <?php echo $obj->getRowTemplateAdmin(array('id' => $id, 'row' => $key, 'data' => $value)); ?>
                </tr>
            <?php
                endforeach;
            else:
            ?>
                <tr class="agp-row">                    
                    <?php echo $obj->getRowTemplateAdmin(array('id' => $id, 'row' => $index)); ?>
                </tr>
            <?php
            endif; 
            ?>
            <tr class="agp-row agp-row-template" style="display: none;">
                <?php echo $obj->getRowTemplateAdmin(array('id' => $id, 'row' => 0, 'data' => $data)); ?>                    
            </tr>
        </tbody>
    </table>
    <div class="agp-actions">
        <a class="button agp-add-row" href="javascript:void(0);">Add New</a>
    </div>    
</div>
<?php
endif;