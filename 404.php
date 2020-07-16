<?php

get_header();

if (rosemary_page_exists('404')) {

    initialize_templates(true);

    rosemary_page('404');


} else {

?>

<div class="container content-body single-page">
    <h1 class="text-404">NOT FOUND</h1>
</div>

<?php

    get_footer();

}