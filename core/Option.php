<?php

use Mirele\Framework\Customizer;
use Mirele\Framework\Option;

# Fix the navbar at the top of the page when scrolling
Customizer::add( (new Option)
    ->setType("switch")
    ->setDefault(false)
    ->setName("mrl_wp_navbar_fixed")
    ->setTitle("Fix the navbar at the top of the page when scrolling")
    ->setDescription("If you enable this option, then when scrolling a page, navbar will always be at the top of the screen and will follow the user. If you turn this option off, napbar will always be at the top of the page and will not follow the user when scrolling a page.")
    ->setProps([])
    ->setNamespace('basic')
);

# Sidebar settings.
# Side bar width settings for 1 active bar
Customizer::add( (new Option)
    ->setType("integer")
    ->setDefault(3)
    ->setName("mrl_wp_sidebar_width_1_active")
    ->setTitle("Sidebar width at 1 active sidebar")
    ->setDescription("Specify the width of the sidebar when only 1 sidebar is active on the page. Page grid consists of 12 columns")
    ->setProps([
        'step' => 1,
        'min' => 1,
        'max' => 4
    ])
    ->setNamespace('basic')
);

# Sidebar settings.
# Side bar width settings for 2 active bar
Customizer::add( (new Option)
    ->setType("integer")
    ->setDefault(3)
    ->setName("mrl_wp_sidebar_width_2_active")
    ->setTitle("Sidebar width at 2 active sidebar")
    ->setDescription("Specify the width of the sidebar when all 2 sidebar is active on the page. Page grid consists of 12 columns")
    ->setProps([
        'step' => 1,
        'min' => 1,
        'max' => 4
    ])
    ->setNamespace('basic')
);

# Sidebar settings.
# Hide Sidebar on mobile device
Customizer::add( (new Option)
    ->setType("switch")
    ->setDefault(true)
    ->setName("mrl_wp_sidebar_hide_mobile")
    ->setTitle("Hide Sidebar on mobile device")
    ->setDescription("On all devices, whose screen is already 576px sidebars will be completely hidden")
    ->setNamespace('basic')
);

### Login
# Register the text-title field on the login page
Customizer::add( (new Option)
    ->setType("text")
    ->setDefault("Login to {WEBSITE_NAME}")
    ->setName("mrl_wp_title_login")
    ->setTitle("Enter the text under the login form header")
    ->setDescription("Enter the text under the title in the authorization form. Try to describe or tell the user the benefits of login on the site as briefly and locally as possible. ")
    ->setNamespace("authorization_login")
);

# Register the text-description field on the login page
Customizer::add( (new Option)
    ->setType("text")
    ->setDefault("Welcome to our website! We are very happy that you have an account on our portal")
    ->setName("mrl_wp_description_login")
    ->setTitle("Enter the text under the login form header")
    ->setDescription("Enter the text under the title in the authorization form. Try to describe or tell the user the benefits of login on the site as briefly and locally as possible. ")
    ->setNamespace("authorization_login")
);

### Register
# Register the text-title field on the signup page
Customizer::add( (new Option)
    ->setType("text")
    ->setDefault("Welcome to {WEBSITE_NAME}")
    ->setName("mrl_wp_title_signup")
    ->setTitle("Enter the text under the login form header")
    ->setDescription("Enter the text under the title in the authorization form. Try to describe or tell the user the benefits of login on the site as briefly and locally as possible. ")
    ->setNamespace("authorization_signup")
);

# Register the text-description field on the signup page
Customizer::add( (new Option)
    ->setType("text")
    ->setDefault("By creating an account on our site, you can manage your orders, participate in promotions, buy products in two clicks, and much more")
    ->setName("mrl_wp_description_signup")
    ->setTitle("Enter the text under the signup form header")
    ->setDescription("Enter the text under the title in the authorization form. Try to describe or tell the user the benefits of signup on the site as briefly and locally as possible. ")
    ->setNamespace("authorization_signup")
);

### Recovery password
# Register the text-title field on the signup page
Customizer::add( (new Option)
    ->setType("text")
    ->setDefault("Step by step we will restore your password")
    ->setName("mrl_wp_title_recovery_password")
    ->setTitle("Enter the text under the login form header")
    ->setDescription("Enter the text under the title in the authorization form. Try to describe or tell the user the benefits of login on the site as briefly and locally as possible. ")
    ->setNamespace("authorization_recovery_password")
);

# Register the text-description field on the signup page
Customizer::add( (new Option)
    ->setType("text")
    ->setDefault("If you forgot your password, we can quickly restore it. Enter your username and email address from your account in the form below. We will send you a link to restore your password. If the email doesn't arrive, check the spam folder in your email")
    ->setName("mrl_wp_description_recovery_password")
    ->setTitle("Enter the text under the signup form header")
    ->setDescription("Enter the text under the title in the authorization form. Try to describe or tell the user the benefits of signup on the site as briefly and locally as possible. ")
    ->setNamespace("authorization_recovery_password")
);


/**
 * WOOCOMMERCE settings
 */

Customizer::add( (new Option)
    ->setType("int")
    ->setDefault(get_option( 'woocommerce_catalog_columns', 4 ))
    ->setName("woocommerce_catalog_columns")
    ->setTitle("Product Card Column Width")
    ->setDescription("The page is divided into 12 columns. Specify the number of columns, which will occupy one product card.")
    ->setProps([
        'step' => 1,
        'min' => 1,
        'max' => 12
    ])
    ->setNamespace('woocommerce_card')
);

Customizer::add( (new Option)
    ->setType("int")
    ->setDefault(get_option( 'woocommerce_catalog_rows', 8 ))
    ->setName("woocommerce_catalog_rows")
    ->setTitle("Number of lines with product blocks on one page")
    ->setDescription("Specify the number of lines with product blocks, which will be displayed on one page of the product catalog.")
    ->setProps([
        'step' => 1,
        'min' => 1,
        'max' => 12
    ])
    ->setNamespace('woocommerce_card')
);


Customizer::add( (new Option)
    ->setType("switch")
    ->setDefault(false)
    ->setName("woocommerce_table_summary")
    ->setTitle("Summarize the cost of all goods at the end of the table")
    ->setDescription("If this option is enabled, at the end of the shopping cart table a summary of the value of all items and the total value of all purchased items with discounts and coupons will be summed up.")
    ->setNamespace('woocommerce_cart')
);

# Show slider on product list page
Customizer::add( (new Option)
    ->setType("switch")
    ->setDefault(true)
    ->setName("mrl_wp_show_carousel")
    ->setTitle("Show slider at the top of the store's page")
    ->setDescription("If this option is enabled, the product page at the top of the page will show the slider of your shares or offers. You can customize its content in the Compound Sliders tab, you can customize its appearance in this tab. ")
    ->setNamespace('woocommerce_shop')
);

