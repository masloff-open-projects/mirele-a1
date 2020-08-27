<?php

/**
 * Rosemary Template: 21;
 */

rosemary_register('main', function() {
  
    
  	rosemary_register_block_options ([
    "o" => '23'
    ]);
  
?>

<?php echo rre('main', [
    'value' => '',
    'type' => 'text'
], []); ?>

<?php
  
}, array(
    'title' => 'main',
    'description' => '',
    'author' => ''
));