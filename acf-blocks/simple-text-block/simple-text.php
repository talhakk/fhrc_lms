<?php 
    $stb_heading = get_field( 'stb_heading' );
    $stb_description = get_field( 'stb_description' );
    $stb_button_and_link = get_field( 'stb_button_and_link' );
?>
<section class="about-us">
    <div class="container">
        <div class="inner">
            <div class="head no-border">
                <h2 class="text-center mb-3"><?php echo (isset($stb_heading)?$stb_heading:'');?></h2>
            </div>
            <div class="content">
                <?php echo (isset($stb_description)?$stb_description:'');?>
                
                <?php
                    foreach ($stb_button_and_link as $key => $value) {
                        // print_r($value);
                        if (!empty($value)) { ?>
                            <a href="<?php echo (isset($value['label_and_link']['url'])?$value['label_and_link']['url']:'');?>" target="<?php echo (isset($value['label_and_link']['target'])?$value['label_and_link']['target']:'');?>" class="btn <?php echo (isset($value['extra_classes'])?$value['extra_classes']:'');?>"><?php echo (isset($value['label_and_link']['title'])?$value['label_and_link']['title']:'');?></a>
                <?php    
                        }
                    }
                ?>
                    
            </div>
        </div>
    </div>
</section>