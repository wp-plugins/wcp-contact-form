<?php
    $post_id = $params;
    $data = SCFP_Form::getFormFields();

?>
<table width="100%" style="border: 1px solid #dfdfdf; border-collapse: collapse;">
    <?php $i=0; foreach( $data as $datakey => $datavalue ): ?>
        <?php if ( !empty( $data[$datakey]['values']['visibility'] ) && empty($datavalue['noemail'])) : ?>
            <tr<?php echo (($i % 2 == 0)) ? ' style="background: #f5f5f5;"' : ''; ?>>
                <td style="padding: 10px 5px; border: 1px solid #dfdfdf; width: 15%;"><strong><?php echo $datavalue['default']['name']; ?></strong></td>
                <td style="padding: 10px 5px; border: 1px solid #dfdfdf; width: 85%;"><?php echo get_post_meta( $post_id, 'scfp_'.$datakey, true ); ?></td>
            </tr>
        <?php endif;?>
    <?php $i++; endforeach; ?>
</table>