<?php

add_action('mirele_ui_market_template_demo', function ($e=null) {
    ?>

    <div class="theme">

        <div class="theme-screenshot blank"></div>

        <span class="more-details">Demo Details</span>
        <div class="theme-author">
            By iRTEX</div>

        <div class="theme-id-container">

            <h2 class="theme-name">Demo title</h2>


            <div class="theme-actions">

                <a class="button activate" href="#">Activate</a>
                <a class="button button-primary load-customize hide-if-no-customize" href="#">Live Preview</a>

            </div>
        </div>
    </div>

    <?php
});