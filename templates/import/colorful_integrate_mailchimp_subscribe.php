<?php

/**
 * Rosemary Template: Colorful MailChimp Subscribe;
 */

if (MIRELE_INTEGRATION_MAILCHIMP) {

    rosemary_register('colorful_mailchimp_subscribe', function ($event=null) {

        $button = rosemary_register_element('button', [
            'value' => 'Subscribe for free',
            'type' => 'text'
        ], [
            'redirect_url' => '',
            'mailchimp_list' => ''
        ]);
    
        $options = rosemary_get_options();
    
    ?>
    
    <section class="theme theme-white-no-full-height text-center">
    
        <div class="separator-middle"></div>
    
        <h2 class="text-center color-dark"> <?php echo rosemary_register_element('header', [
                'value' => 'Sign up to our newsletter!',
                'type' => 'text'
            ]); ?> </h2>
    
        <p class="text-center text-content-padding"> <?php echo rosemary_register_element('text', [
                'value' => Lorem::ipsum(2),
                'type' => 'text'
            ]); ?> </p>
    
        <form method="POST" list_id="<?php echo $options->mailchimp_list ?>" action="subscribe_to_news_mailchimp_form">
    
            <?php foreach (['email', 'phone', 'lname', 'fname'] as $input): ?>
            
                <?php
                    
                    $input_ = rosemary_register_element($input, [
                        'value' => "Enter your $input",
                        'type' => 'text'
                    ]);
    
                ?>
    
                <?php if ( rosemary_get_visible(rosemary_get_full_id($input)) ): ?>
                                
                <div>
                    <input type="<?php echo $input == 'email' ? 'email' : 'text' ?>" name="<?php echo $input; ?>" placeholder="<?php echo $input_ ?>" class="no-full-input margin-x-md" placeholder="">
                </div>
                
                <?php endif; ?>
    
            <?php endforeach; ?>
    
    
            <div class="margin-x-md">
                <a href="javascript:;" class="button-light" action="subscribe_to_news_mailchimp_do"> <?php echo $button ?> <i class="fas fa-chevron-right"></i> </a>
            </div>
    
        </form>
    
        <div class="separator-middle"></div>
    
    </section>
    
    <?php }, array(
        'title' => 'Colorful MailChimp Subscribe Integrate',
        'description' => 'You want to organize a subscription for your future products - this unit will help in the implementation of your ideas! (Do not forget to log in to MailChimp and specify the sheet number in the item options)',
        'author' => 'Mirele Package Colorful Integrate'
    )); 

}