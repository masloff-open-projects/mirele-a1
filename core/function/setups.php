<?php

function wp_setups()
{

    function setup_wp_markup($only = 'all')
    {

        function navmenus()
        {
            register_nav_menus(array(
                'header' => 'Header'
            ));
            register_nav_menus(array(
                'footer' => 'Footer'
            ));
        }

        function sidebars()
        {

            add_action('widgets_init', function () {

                register_sidebar(array(
                    'name' => __('Right sidebar (page)', ''),
                    'id' => 'right-side-page',
                    'description' => __('Sidebar is displayed on the pages', ''),
                    'before_widget' => '',
                    'after_widget' => '',
                    'before_title' => '<h3>',
                    'after_title' => '</h3>',
                ));

                register_sidebar(array(
                    'name' => __('Left sidebar (page)', ''),
                    'id' => 'left-side-page',
                    'description' => __('Sidebar is displayed on the pages', ''),
                    'before_widget' => '',
                    'after_widget' => '',
                    'before_title' => '<h3>',
                    'after_title' => '</h3>',
                ));


                register_sidebar(array(
                    'name' => __('Right sidebar (post)', ''),
                    'id' => 'right-side-single',
                    'description' => __('Sidebar is displayed on the blog post page.', ''),
                    'before_widget' => '',
                    'after_widget' => '',
                    'before_title' => '<h3>',
                    'after_title' => '</h3>',
                ));

                register_sidebar(array(
                    'name' => __('Left sidebar (post)', ''),
                    'id' => 'left-side-single',
                    'description' => __('Sidebar is displayed on the blog post page.', ''),
                    'before_widget' => '',
                    'after_widget' => '',
                    'before_title' => '<h3>',
                    'after_title' => '</h3>',
                ));


                register_sidebar(array(
                    'name' => __('Right sidebar (product)', ''),
                    'id' => 'right-side-product',
                    'description' => __('Sidebar is displayed on the product page.', ''),
                    'before_widget' => '',
                    'after_widget' => '',
                    'before_title' => '<h3>',
                    'after_title' => '</h3>',
                ));

                register_sidebar(array(
                    'name' => __('Left sidebar (product)', ''),
                    'id' => 'left-side-product',
                    'description' => __('Sidebar is displayed on the product page.', ''),
                    'before_widget' => '',
                    'after_widget' => '',
                    'before_title' => '<h3>',
                    'after_title' => '</h3>',
                ));


                register_sidebar(array(
                    'name' => __('Right sidebar (list products)', ''),
                    'id' => 'right-side-list-products',
                    'description' => __('Sidebar is displayed on the products list page.', ''),
                    'before_widget' => '',
                    'after_widget' => '',
                    'before_title' => '<h3>',
                    'after_title' => '</h3>',
                ));

                register_sidebar(array(
                    'name' => __('Left sidebar (list products)', ''),
                    'id' => 'left-side-list-products',
                    'description' => __('Sidebar is displayed on the products list page.', ''),
                    'before_widget' => '',
                    'after_widget' => '',
                    'before_title' => '<h3>',
                    'after_title' => '</h3>',
                ));


                register_sidebar(array(
                    'name' => __('Under the product (single product)', ''),
                    'id' => 'single-product-bar-after-form',
                    'description' => __('', ''),
                    'before_widget' => '',
                    'after_widget' => '',
                    'before_title' => '<h3>',
                    'after_title' => '</h3>',
                ));

                register_sidebar(array(
                    'name' => __('Under the product page (single product)', ''),
                    'id' => 'single-product-bar-after-page',
                    'description' => __('', ''),
                    'before_widget' => '',
                    'after_widget' => '',
                    'before_title' => '<h3>',
                    'after_title' => '</h3>',
                ));

                register_sidebar(array(
                    'name' => __('Over product (single product)', ''),
                    'id' => 'single-product-bar-before-form',
                    'description' => __('', ''),
                    'before_widget' => '',
                    'after_widget' => '',
                    'before_title' => '<h3>',
                    'after_title' => '</h3>',
                ));

                register_sidebar(array(
                    'name' => __('Footer #1', ''),
                    'id' => 'footer-1',
                    'description' => __('Sidebar is displayed on footer section', ''),
                    'before_widget' => '',
                    'after_widget' => '',
                    'before_title' => '<h3>',
                    'after_title' => '</h3>',
                ));

                register_sidebar(array(
                    'name' => __('Footer #2', ''),
                    'id' => 'footer-2',
                    'description' => __('Sidebar is displayed on footer section', ''),
                    'before_widget' => '',
                    'after_widget' => '',
                    'before_title' => '<h3>',
                    'after_title' => '</h3>',
                ));

                register_sidebar(array(
                    'name' => __('Footer #3', ''),
                    'id' => 'footer-3',
                    'description' => __('Sidebar is displayed on footer section', ''),
                    'before_widget' => '',
                    'after_widget' => '',
                    'before_title' => '<h3>',
                    'after_title' => '</h3>',
                ));

                register_sidebar(array(
                    'name' => __('Footer #4', ''),
                    'id' => 'footer-4',
                    'description' => __('Sidebar is displayed on footer section', ''),
                    'before_widget' => '',
                    'after_widget' => '',
                    'before_title' => '<h3>',
                    'after_title' => '</h3>',
                ));

            });

        }

        navmenus();
        sidebars();

        switch ($only) {
            case 'navmenus':
                navmenus();
                break;

            case 'sidebars':
                sidebars();
                break;

            case 'all':
                navmenus();
                sidebars();
                break;

            default:
                break;

        }

    }

    function setup_wp_supports($wp_default = true, $woocommerce = true)
    {

        if ($wp_default) {

            add_theme_support('post-thumbnails');
            add_theme_support('custom-background');
            add_theme_support('custom-header');
            add_theme_support('title-tag');
            add_theme_support('automatic-feed-links');
            add_theme_support('wc-product-gallery-zoom');
            add_theme_support('wc-product-gallery-lightbox');
            add_theme_support('wc-product-gallery-slider');
            add_image_size('mirele-thumbnail', 80, 80);

        }

        if ($woocommerce) {
            add_theme_support('woocommerce', array(
                'thumbnail_image_width' => 150,
                'single_image_width' => 300,

                'product_grid' => array(
                    'default_rows' => get_option('woo_markup_rows', 5),
                    'min_rows' => 2,
                    'max_rows' => 8,
                    'default_columns' => get_option('woo_column', 4),
                    'min_columns' => 8,
                    'max_columns' => 12,
                ),
            ));
        }

    }

    function setup_bootstrap()
    {

        switch (get_option('mirele_bootstrap_main_type_width_main', 'stretched')) {

            case "stretched":

                add_action('mirele_header', function () {

                    if (is_page_template(ROSEMARY_CANVAS)) {
                        $max_width = "<style>
                        @media (min-width:1200px) {
                            .container {
                                width: 80vw;
                                max-width: 1870px;
                            }
                        }</style>";

                        echo $max_width;
                    }

                });

                break;

        }

        switch (get_option('mirele_bootstrap_main_type_width_woo', 'stretched')) {

            case "stretched":

                add_action('mirele_header', function () {

                    if (is_woocommerce()) {
                        $max_width = "<style>
                        @media (min-width:1200px) {
                            .container {
                                width: 80vw;
                                max-width: 1870px;
                            }
                        }</style>";

                        echo $max_width;
                    }

                });

                break;

        }

    }

    function setup_wp_filters()
    {

        add_filter('nav_menu_css_class', 'special_nav_class', 10, 2);

        function special_nav_class($classes, $item)
        {
            if (in_array('current-post-ancestor', $classes) || in_array('current-page-ancestor', $classes) || in_array('current-menu-item', $classes)) {
                $classes[] = 'active-flat-navbar ';
            }
            return $classes;
        }

    }

    function setup_wp_dashboard_widgets()
    {

        add_action('wp_dashboard_setup', function () {

            wp_add_dashboard_widget('mirele_security_dwidget', 'Mirele Security', function () {

                initialize_templates(true);

                global $msafe;

                ?>

                <h1> <?php echo !empty($msafe->info()->virus) ? "You have <b style='color: #e9523d;'>" . count($msafe->info()->virus) . "</b> security bugs!" : "Your site is safe" ?> </h1>

                <?php if (count($msafe->info()->virus) > 0): ?>
                    <ol>
                        <?php foreach ($msafe->info()->virus as $post): ?>
                            <li>
                                <b> <?php echo basename($post->file); ?> </b> <?php echo $post->short_description ?>
                                <hr>
                                <small>
                                    <?php echo $post->description ?>
                                </small>
                            </li>
                        <?php endforeach; ?>
                    </ol>
                <?php endif; ?>

                <p>The security system did not detect malicious blocks that you could download from a third-party
                    repository</p>
                <small> Files that have passed antivirus check - <?php echo count($msafe->info()->normal) ?> </small>

                <?php

            });

            wp_add_dashboard_widget('mirele_twitter_dwidget', 'Mirele News', function () {

                ?>

                <h3 class="mirele-overview__heading"> News </h3>

                <ul class="mirele-overview__posts">
                    <?php

                    $feed = mc_execute('twtr_feed', function () {
                        return MFile::read("https://twitrss.me/twitter_user_to_rss/?user=iRTEXFeed");
                    });

                    $rss = simplexml_load_string($feed);

                    if ($rss): foreach (array_slice($rss->xpath("//item"), 0, 6) as $post): ?>

                        <li>
                            <a href="<?php echo $post->link ?>" target="_blank" rel="noopener noreferrer"
                               class="rsswidget"> <?php echo preg_replace('/\.twitter\.com\/(.+)/', '', preg_replace('/(#\w+)/', '', $post->title)) ?> </a>
                        </li>

                    <?php endforeach; endif; ?>
                </ul>

                <?php

            });

        });

    }

    function setup_robotstxt($type = false)
    {

        if (!$type) {

            if (!MFile::exist(get_template_directory() . '/robots.txt')) {
                MFile::write(get_template_directory() . '/robots.txt', get_option('mirele_robotstxt', ''));
            } elseif (mb_strlen(get_option('mirele_robotstxt', '')) != MFile::size(get_template_directory() . '/robots.txt')) {
                MFile::write(get_template_directory() . '/robots.txt', get_option('mirele_robotstxt', ''));
            }

        } elseif ($type == 'default') {

            $url = home_url();
            $host = $_SERVER['HTTP_HOST'];

            $robots = "User-agent: *
                           
Disallow: /cgi-bin          
Disallow: /?                
Disallow: /wp-              
Disallow: /wp/              
                            
Disallow: *?s=              
Disallow: *&s=              
Disallow: /search/          
Disallow: /author/          
Disallow: /users/           
Disallow: */trackback       
                            
Disallow: */feed            
Disallow: */rss             
Disallow: */embed           
Disallow: */wlwmanifest.xml 
                            
Disallow: /xmlrpc.php       
Disallow: *utm*=             
Disallow: *openstat=        
Allow: */uploads            

Sitemap: $url/sitemap.xml
Sitemap: $url/sitemap.xml.gz

Host: www.$host";

            update_option('mirele_robotstxt', $robots);
            MFile::write(get_template_directory() . '/robots.txt', get_option('mirele_robotstxt', ''));

        } elseif ($type == 'google') {

            $url = home_url();
            $host = $_SERVER['HTTP_HOST'];

            $robots = "User-agent: *               
                            
Disallow: /cgi-bin          
Disallow: /?                
Disallow: /wp-              
Disallow: /wp/              
                            
Disallow: *?s=              
Disallow: *&s=              
Disallow: /search/          
Disallow: /author/          
Disallow: /users/           
Disallow: */trackback       
                            
Disallow: */feed            
Disallow: */rss             
Disallow: */embed           
Disallow: */wlwmanifest.xml 
                            
Disallow: /xmlrpc.php       
Disallow: *utm*=             
Disallow: *openstat=        
Allow: */uploads            

User-agent: GoogleBot       
Disallow: /cgi-bin
Disallow: /?
Disallow: /wp-
Disallow: /wp/
Disallow: *?s=
Disallow: *&s=
Disallow: /search/
Disallow: /author/
Disallow: /users/
Disallow: */trackback
Disallow: */feed
Disallow: */rss
Disallow: */embed
Disallow: */wlwmanifest.xml
Disallow: /xmlrpc.php
Disallow: *utm*=
Disallow: *openstat=
Allow: */uploads
Allow: /*/*.js              
Allow: /*/*.css             
Allow: /wp-*.png            
Allow: /wp-*.jpg            
Allow: /wp-*.jpeg           
Allow: /wp-*.gif            
Allow: /wp-admin/admin-ajax.php 

Clean-Param: openstat

Sitemap: $url/sitemap.xml
Sitemap: $url/sitemap.xml.gz

Host: www.$host";

            update_option('mirele_robotstxt', $robots);
            MFile::write(get_template_directory() . '/robots.txt', get_option('mirele_robotstxt', ''));

        }

    }

    setup_wp_markup();
    setup_wp_supports();
    setup_bootstrap();
    setup_wp_filters();
    setup_wp_dashboard_widgets();
    setup_robotstxt();

}