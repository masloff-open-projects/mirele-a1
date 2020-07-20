<?php

/**
 * Rosemary Template: Darkness HubSpot Form Multiblock;
 */


if (MIRELE_INTEGRATION_HUBSPOT) {

    rosemary_register('darkness_hubspot_form', function() {

    $button = rosemary_register_element('submit', [
        'value' => 'Submit form',
        'type' => 'text'
    ], [
        'form_id' => ''
    ]);
    
    $options = rosemary_get_options();

    $form = MIHubSpot::form(get_option('mrltkn_hs', false), $options->form_id);

    ?>
    
    <section class="theme theme-dark-no-full-height text-center">
    
        <div class="separator-middle"></div>

        <h2 class="text-center"> <?php echo rosemary_register_element('header', [
                'value' => 'Leave a request and we will answer you!',
                'type' => 'text'
            ]); ?> </h2>

        <p class="text-center text-content-padding"> <?php echo rosemary_register_element('text', [
                'value' => Lorem::ipsum(2),
                'type' => 'text'
            ]); ?> </p>

        <form method="POST" action="form_hubspot" portal_id="<?php echo $form->portalId ?>" guid="<?php echo $form->guid ?>">

            <?php foreach ($form->formFieldGroups as $input): ?>
            
                <?php
                    
                    ?> <div> <?php

                    foreach ($input->fields as $input_box) {
                        
                        $input_ = rosemary_register_element($input_box->name, [
                            'value' => $input_box->label,
                            'type' => 'text'
                        ]);

                        if ( rosemary_get_visible(rosemary_get_full_id($input_box->name)) && $input_box->enabled): ?>
                            
                            <?php if ($input_box->hidden): ?>
                            
                                <input type="hidden" name="<?php echo $input_box->name; ?>" placeholder="<?php echo $input_ ?>" >

                            <?php else: ?>
                                
                                <?php if ($input_box->fieldType == 'text'): ?>

                                    <input type="text" required="<?php echo $input_box->required ? 'required' : '' ?>" remove_all_styles_in_mobile_version name="<?php echo $input_box->name; ?>" propertyObjectType="<?php echo $input_box->propertyObjectType; ?>" placeholder="<?php echo $input_ ?>" class="darkness-input margin-x-md" style="<?php echo count($input->fields) == 3 ? 'width: 13.3333% !important' : (count($input->fields) == 2 ? 'width: 20% !important' : '') ?>">
                                
                                <?php elseif ($input_box->fieldType == 'textarea'): ?>
                                    
                                    <textarea name="<?php echo $input_box->name; ?>" required="<?php echo $input_box->required ? 'required' : '' ?>" placeholder="<?php echo $input_ ?>" class="darkness-input margin-x-md"></textarea>                               
                                
                                <?php elseif ($input_box->fieldType == 'radio'): ?>

                                    <?php foreach ($input_box->options as $option): ?>

                                        <div>
                                            <label class='color-white darkness-input-radio margin-x-md'>
                                                <input type="radio" required="<?php echo $input_box->required ? 'required' : '' ?>" value="<?php echo $option->value ?>" name="<?php echo $input_box->name ?>">
                                                <?php echo $option->label ?>
                                            </label>
                                        </div>

                                    <?php endforeach; ?>

                                <?php elseif ($input_box->fieldType == 'booleancheckbox'): ?>
                                
                                    <div>
                                        <label class='color-white darkness-input-radio margin-x-md'>
                                            <input type="checkbox" required="<?php echo $input_box->required ? 'required' : '' ?>" value="Yes" name="<?php echo $input_box->name ?>">
                                            <?php echo $input_box->label ?>
                                        </label>
                                    </div>
                                    
                                <?php elseif ($input_box->fieldType == 'checkbox'): ?>

                                    <?php foreach ($input_box->options as $option): ?>

                                        <div>
                                        <label class='color-white darkness-input-radio margin-x-md'>
                                            <input type="checkbox" required="<?php echo $input_box->required ? 'required' : '' ?>" value="<?php echo $option->value ?>" name="<?php echo $option->name ?>">
                                            <?php echo $option->label ?>
                                        </label>
                                    </div>

                                    <?php endforeach; ?>

                                <?php elseif ($input_box->fieldType == 'select'): ?>

                                    <select class="darkness-input margin-x-md" required="<?php echo $input_box->required ? 'required' : '' ?>">

                                        <?php foreach ($input_box->options as $option): ?>

                                            <option value="<?php echo $option->value ?>"><?php echo $option->label ?></option>

                                        <?php endforeach; ?>    
                                        
                                    </select>

                                <?php elseif ($input_box->fieldType == 'number'): ?>

                                    <input type="number" required="<?php echo $input_box->required ? 'required' : '' ?>" name="<?php echo $input_box->name ?>" value="<?php echo $input_box->defaultValue ?>" placeholder="<?php echo $input_ ?>" class="darkness-input margin-x-md">

                                <?php endif; ?>

                            <?php endif; ?>
                            
                        <?php endif;

                    }

                    ?> </div> <?php


                ?>

            <?php endforeach; ?>
                
            <?php if ($form->captchaEnabled): ?>

                <p class="margin-lg">
                    <small class="color-white">Sorry, captcha is not yet supported.</small>
                </p>

            <?php endif; ?>

            <div class="margin-x-md">
                <a href="javascript:;" class="button-dark" action="hubspot_form_do"> <?php echo $button ?> <i class="fas fa-chevron-right"></i> </a>
            </div>

        </form>

        <div class="separator-middle"></div>

    </section>
    
    <?php
    }, array(
        'title' => 'Darkness HubSpot Form',
        'description' => 'Integrate the form from your HubSpot account!',
        'author' => 'Mirele Darkness Package'
    ));

}