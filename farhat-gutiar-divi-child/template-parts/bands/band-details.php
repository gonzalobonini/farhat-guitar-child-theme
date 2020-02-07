
<?php 

$details['Members'] = get_the_terms(get_the_ID(), 'member');
$details['Past Members'] = get_the_terms(get_the_ID(), 'past_member');
$details['Labels'] = get_the_tags( get_the_ID() );
$details['Origin'] = get_post_meta(get_the_ID(), 'new_band_origin', true);
$details['Active'] = get_post_meta(get_the_ID(), 'new_band_active', true);
$details['Website'] = get_post_meta(get_the_ID(), 'new_band_website', true);

?>

<div class="et_pb_text et_pb_bg_layout_light et_pb_text_align_left details-songs-title section-title">
    Details
</div>

<div class="et_pb_text et_pb_bg_layout_light et_pb_text_align_left details-list">    
    
    <ul>
        
    <?php foreach($details as $key => $value) { ?>
     
        <?php if($value): 

        $value = (is_array($value)) ? new_get_separeted_by_commas_list($value) : $value;
                
        ?>
        <li>
            
            <div class="details-first-column"><?php _e($key.':', 'farhat'); ?></div>
            <div class="details-second-column">
                <?php echo $value; ?>
            </div>
            <hr>
        </li>

    <?php endif;

}  ?>

        
    </ul>

</div> <!-- .et_pb_text -->