<?php
/**
 * Rosemary Template: 1;
 */

MPackage::single_font('Montserrat:wght@100;700;800;900');
MPackage::single_font('Domine');

rosemary_register ('nd_header', function () {

    ?>

    <section class="theme-white" style="background: #070203">
        <div class="container text-center">

            <div class="separator-big"></div>
            <h3 style="font-family: Domine; font-weight: 100; margin: 0;">Welcome to</h3>
            <h1 style="font-family: 'Montserrat'; font-weight: 700; margin: 10px;"> <?php echo rre('title', array('type' => 'text', 'value' => Lorem::ipsum(1))); ?> </h1>

            <img src="https://images.unsplash.com/photo-1548611716-ad782502c9d2?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80" alt=""
                 style="width: 100%;object-fit: contain;height: 620px;">
            
        </div>
    </section>

    <section class="theme-white">
        <div class="container text-center">

            <div class="separator-big"></div>
            <h3 style="font-family: Domine; color: #323232; font-weight: 100">Welcome to</h3>
            <h1 style="font-family: 'Montserrat'; font-weight: 700; color: #323232;"> <?php echo rre('title', array('type' => 'text', 'value' => Lorem::ipsum(1))); ?> </h1>


        </div>
    </section>

    <?php
});