```.browserslistrc
.github
   |-- workflows
   |   |-- php.yml
.gitignore
404.php
Binder
   |-- Component
   |   |-- Button
   |   |   |-- component.php
   |   |   |-- template.html.twig
   |   |-- Cart
   |   |   |-- component.php
   |   |   |-- template.html.twig
   |   |-- Checkbox
   |   |   |-- component.php
   |   |   |-- template.html.twig
   |   |-- Editor
   |   |   |-- component.php
   |   |   |-- template.html.twig
   |   |-- Footer
   |   |   |-- component.php
   |   |   |-- template.html.twig
   |   |-- FormField
   |   |   |-- component.php
   |   |   |-- template.html.twig
   |   |-- HTMLTag
   |   |   |-- component.php
   |   |   |-- template.html.twig
   |   |-- Input
   |   |   |-- component.php
   |   |   |-- template.html.twig
   |   |-- Label
   |   |   |-- component.php
   |   |   |-- template.html.twig
   |   |-- Navbar
   |   |   |-- Children
   |   |   |   |-- menu.php
   |   |   |-- component.php
   |   |   |-- template.html.twig
   |   |-- Notice
   |   |   |-- component.php
   |   |   |-- template.html.twig
   |   |-- Radio
   |   |   |-- component.php
   |   |   |-- template.html.twig
   |   |-- Select
   |   |   |-- component.php
   |   |   |-- template.html.twig
   |   |-- Sidebar
   |   |   |-- component.php
   |   |   |-- template.html.twig
   |   |-- Textarea
   |   |   |-- component.php
   |   |   |-- template.html.twig
   |   |-- WidgetFactory
   |   |   |-- component.php
   |   |   |-- template.html.twig
   |   |-- Woocommerce
   |   |   |-- Carousel
   |   |   |   |-- component.php
   |   |   |   |-- template.html.twig
   |   |   |-- Forms
   |   |   |   |-- Children
   |   |   |   |   |-- Billing
   |   |   |   |   |   |-- component.php
   |   |   |   |   |   |-- template.html.twig
   |   |   |   |   |-- Shipping
   |   |   |   |   |   |-- component.php
   |   |   |   |   |   |-- template.html.twig
   |   |   |-- Gallerys
   |   |   |   |-- default.php
   |   |   |-- Notes
   |   |   |   |-- default.php
   |   |   |-- Placeholders
   |   |   |   |-- Cart
   |   |   |   |   |-- default.php
   |   |   |   |-- Downloads
   |   |   |   |   |-- default.php
   |   |   |   |-- Orders
   |   |   |   |   |-- default.php
   |   |   |-- Steps
   |   |   |   |-- default.php
   |   |   |-- Table
   |   |   |   |-- Children
   |   |   |   |   |-- Cart
   |   |   |   |   |   |-- component.php
   |   |   |   |   |   |-- template.html.twig
   |   |   |   |   |-- Downloads
   |   |   |   |   |   |-- component.php
   |   |   |   |   |   |-- template.html.twig
   |   |   |   |   |-- Orders
   |   |   |   |   |   |-- component.php
   |   |   |   |   |   |-- template.html.twig
   |-- Template
   |   |-- Emptys
   |   |   |-- default.php
   |   |-- Grid
   |   |   |-- default.php
   |   |-- Headers
   |   |   |-- default.php
   |   |-- Matrix
   |   |   |-- 4x4.php
   |   |   |-- 6x6.php
   |   |   |-- template.html.twig
   |   |   |-- template.php
   |-- autoloader.php
Compound
   |-- Adapter
   |   |-- AJAX.php
   |-- Engine
   |   |-- Application.php
   |   |-- Applications
   |   |   |-- Applications
   |   |   |   |-- index.html.twig
   |   |   |-- Compound
   |   |   |   |-- Prototypes
   |   |   |   |   |-- card
   |   |   |   |   |   |-- app.twig
   |   |   |   |   |-- message
   |   |   |   |   |   |-- compound_message.twig
   |   |   |   |   |-- modal
   |   |   |   |   |   |-- compound_empty.twig
   |   |   |   |   |   |-- compound_insert.twig
   |   |   |   |   |-- spinner
   |   |   |   |   |   |-- compound.twig
   |   |   |   |   |-- table
   |   |   |   |   |   |-- native.twig
   |   |   |   |-- demos.twig
   |   |   |   |-- editor.twig
   |   |   |   |-- editor
   |   |   |   |   |-- message
   |   |   |   |   |   |-- editor_empty_props.twig
   |   |   |   |   |   |-- editor_error_preparation.twig
   |   |   |   |   |-- modal
   |   |   |   |   |   |-- edit_props.twig
   |   |   |   |   |   |-- edit_template.twig
   |   |   |   |   |   |-- insert_component.twig
   |   |   |   |   |   |-- insert_template.twig
   |   |   |   |   |-- postbox
   |   |   |   |   |   |-- attr.twig
   |   |   |   |   |   |-- meta.twig
   |   |   |   |   |-- spinner
   |   |   |   |   |   |-- editor_preparation.twig
   |   |   |   |-- index.twig
   |   |   |   |-- pages
   |   |   |   |   |-- modal
   |   |   |   |   |   |-- create_page.twig
   |   |   |   |-- start.twig
   |   |   |-- Hub
   |   |   |   |-- index.html.twig
   |   |   |-- Public
   |   |   |   |-- 404.html.twig
   |   |   |   |-- Module
   |   |   |   |   |-- Woocommerce
   |   |   |   |   |   |-- Login
   |   |   |   |   |   |   |-- login.twig
   |   |   |   |   |   |   |-- password_recovery.twig
   |   |   |   |   |   |   |-- signup.twig
   |   |   |   |   |   |-- Page
   |   |   |   |   |   |   |-- breadcrumb.twig
   |   |   |   |   |   |-- account.html.twig
   |   |   |   |   |   |-- cart.html.twig
   |   |   |   |   |   |-- category-cart.twig
   |   |   |   |   |   |-- checkout.html.twig
   |   |   |   |   |   |-- order.twig
   |   |   |   |   |   |-- product-cart.twig
   |   |   |   |   |   |-- product.twig
   |   |   |   |   |   |-- products.twig
   |   |   |   |   |   |-- profile.twig
   |   |   |   |-- canvas.html.twig
   |   |   |   |-- footer.html.twig
   |   |   |   |-- header.html.twig
   |   |   |   |-- index.html.twig
   |   |   |   |-- layout.html.twig
   |   |   |   |-- page.html.twig
   |   |   |   |-- single.html.twig
   |-- Instance
   |   |-- Component.php
   |   |-- Config.php
   |   |-- Construction.php
   |   |-- Data.php
   |   |-- Directive.php
   |   |-- Document.php
   |   |-- Field.php
   |   |-- Layout.php
   |   |-- Option.php
   |   |-- Protector.php
   |   |-- Request.php
   |   |-- Response.php
   |   |-- Strategy.php
   |   |-- Stringer.php
   |   |-- Tag.php
   |   |-- Template.php
   |-- Interface
   |   |-- IRequest.php
   |   |-- Seller.php
   |   |-- Storage.php
   |-- Module
   |   |-- Converter.php
   |   |-- Option.php
   |   |-- WP.php
   |   |-- WPGNU.php
   |-- Pattern
   |   |-- Compound
   |   |   |-- __for_develop.php
   |   |   |-- cloneTemplate.php
   |   |   |-- createPage.php
   |   |   |-- insertComponent.php
   |   |   |-- insertTemplate.php
   |   |   |-- propsPage.php
   |   |   |-- propsTemplate.php
   |   |   |-- removeTemplate.php
   |   |   |-- sortOrder.php
   |   |   |-- updatePage.php
   |   |   |-- updateProps.php
   |   |   |-- updateTemplateProps.php
   |-- Prototype
   |   |-- Pattern.php
   |-- Strategy
   |   |-- admin.php
   |-- Trait
   |   |-- __caller.php
   |   |-- __getter.php
   |   |-- __isset.php
   |   |-- __setter.php
   |   |-- __unset.php
   |-- autoloader.php
   |-- \320\241ontroller"
   |-- \320   |Apps.php"
   |-- \320   |Constructor.php"
   |-- \320   |Controller.php"
   |-- \320   |Customizer.php"
   |-- \320   |Grider.php"
   |-- \320   |Lexer.php"
   |-- \320   |Network.php"
   |-- \320   |Router.php"
   |-- \320   |Session.php"
   |-- \320   |Store.php"
   |-- \320   |TWIG.php"
   |-- \320   |TagsManager.php"
HTTP.http
Hammer&Wrench.php
Option
   |-- Authorization
   |   |-- login
   |   |   |-- mrl_wp_description_login.php
   |   |   |-- mrl_wp_title_login.php
   |   |-- recovery_password
   |   |   |-- mrl_wp_description_recovery_password.php
   |   |   |-- mrl_wp_title_recovery_password.php
   |   |-- signup
   |   |   |-- mrl_wp_description_signup.php
   |   |   |-- mrl_wp_title_signup.php
   |-- Basic
   |   |-- mrl_wp_navbar_fixed.php
   |   |-- mrl_wp_navbar_type.php
   |   |-- mrl_wp_sidebar_hide_mobile.php
   |   |-- mrl_wp_sidebar_width_1_active.php
   |   |-- mrl_wp_sidebar_width_2_active.php
   |-- Woocommerce
   |   |-- Card
   |   |   |-- woocommerce_catalog_columns.php
   |   |   |-- woocommerce_catalog_rows.php
   |   |-- Cart
   |   |   |-- woocommerce_table_summary.php
   |   |-- Shop
   |   |   |-- mrl_wp_show_carousel.php
   |-- vendor.php
Public
   |-- .ignore
   |-- css
   |   |-- admin.css
   |   |-- admin.sass
   |   |-- components
   |   |   |-- animate.css
   |   |   |-- animate.sass
   |   |   |-- blocks
   |   |   |   |-- placeholder.css
   |   |   |   |-- placeholder.sass
   |   |   |   |-- user.css
   |   |   |   |-- user.sass
   |   |   |-- bootstrap
   |   |   |   |-- container.css
   |   |   |   |-- container.sass
   |   |   |-- breadcrumds.css
   |   |   |-- breadcrumds.sass
   |   |   |-- button.css
   |   |   |-- button.sass
   |   |   |-- carousel.css
   |   |   |-- carousel.sass
   |   |   |-- cart
   |   |   |   |-- default.css
   |   |   |   |-- default.sass
   |   |   |-- checkbox.css
   |   |   |-- checkbox.sass
   |   |   |-- color.css
   |   |   |-- color.sass
   |   |   |-- container-form.css
   |   |   |-- container-form.sass
   |   |   |-- controller.css
   |   |   |-- controller.sass
   |   |   |-- datetime.css
   |   |   |-- datetime.sass
   |   |   |-- file.css
   |   |   |-- file.sass
   |   |   |-- footer.css
   |   |   |-- footer.sass
   |   |   |-- input.css
   |   |   |-- input.sass
   |   |   |-- label.css
   |   |   |-- label.sass
   |   |   |-- link.css
   |   |   |-- link.sass
   |   |   |-- logo.css
   |   |   |-- logo.sass
   |   |   |-- navbar.css
   |   |   |-- navbar.sass
   |   |   |-- note.css
   |   |   |-- note.sass
   |   |   |-- product.css
   |   |   |-- product.sass
   |   |   |-- product
   |   |   |   |-- description.css
   |   |   |   |-- description.sass
   |   |   |   |-- gallery.css
   |   |   |   |-- gallery.sass
   |   |   |   |-- price.css
   |   |   |   |-- price.sass
   |   |   |   |-- props.css
   |   |   |   |-- props.sass
   |   |   |-- prototype
   |   |   |   |-- product.css
   |   |   |   |-- product.sass
   |   |   |-- radio.css
   |   |   |-- radio.sass
   |   |   |-- range.sass
   |   |   |-- screen
   |   |   |   |-- login.css
   |   |   |   |-- login.sass
   |   |   |-- scrollbar.css
   |   |   |-- scrollbar.sass
   |   |   |-- select.css
   |   |   |-- select.sass
   |   |   |-- step.css
   |   |   |-- step.sass
   |   |   |-- subbar.css
   |   |   |-- subbar.sass
   |   |   |-- switch.css
   |   |   |-- switch.sass
   |   |   |-- textarea.css
   |   |   |-- textarea.sass
   |   |-- compound
   |   |   |-- box.css
   |   |   |-- box.sass
   |   |   |-- editor_field.css
   |   |   |-- editor_field.sass
   |   |   |-- grid
   |   |   |   |-- align.css
   |   |   |   |-- align.sass
   |   |   |   |-- color.css
   |   |   |   |-- color.sass
   |   |   |   |-- column.css
   |   |   |   |-- column.sass
   |   |   |   |-- display.css
   |   |   |   |-- display.sass
   |   |   |   |-- font.css
   |   |   |   |-- font.sass
   |   |   |   |-- grid.css
   |   |   |   |-- grid.sass
   |   |   |   |-- margin.css
   |   |   |   |-- margin.sass
   |   |   |   |-- padding.css
   |   |   |   |-- padding.sass
   |   |   |   |-- visible.css
   |   |   |   |-- visible.sass
   |   |   |   |-- width.css
   |   |   |   |-- width.sass
   |   |   |-- modal.css
   |   |   |-- modal.sass
   |   |   |-- wp-native
   |   |   |   |-- grid.css
   |   |   |   |-- grid.sass
   |   |   |   |-- modal
   |   |   |   |   |-- header.css
   |   |   |   |   |-- header.sass
   |   |   |   |-- table.css
   |   |   |   |-- table.sass
   |   |   |   |-- tag.css
   |   |   |   |-- tag.sass
   |   |-- flex
   |   |   |-- flex.css
   |   |   |-- flex.sass
   |   |-- style.css
   |   |-- style.sass
   |-- fonts
   |   |-- WooCommerce.eot
   |   |-- WooCommerce.svg
   |   |-- WooCommerce.ttf
   |   |-- WooCommerce.woff
   |   |-- glyphicons-halflings-regular.eot
   |   |-- glyphicons-halflings-regular.svg
   |   |-- glyphicons-halflings-regular.ttf
   |   |-- glyphicons-halflings-regular.woff
   |   |-- star.eot
   |   |-- star.svg
   |   |-- star.ttf
   |   |-- star.woff
   |-- img
   |   |-- Login-1.png
   |   |-- apps
   |   |   |-- hubspot_icon.png
   |   |   |-- kristen_icon.png
   |   |   |-- mailchimp_icon.jpg
   |   |   |-- robottxt_icon.png
   |   |-- covers
   |   |   |-- templates
   |   |   |   |-- template-matrix-cover-6x6.jpg
   |   |-- default
   |   |   |-- dark-product.jpg
   |   |-- forms
   |   |   |-- edit-account.jpg
   |   |   |-- edit-address.jpg
   |   |   |-- empty-props-of-component.jpg
   |   |   |-- forgot-gray.jpg
   |   |   |-- forgot.jpg
   |   |   |-- lerning.jpg
   |   |   |-- login-gray.jpg
   |   |   |-- login.jpg
   |   |   |-- register-gray.jpg
   |   |   |-- register.jpg
   |   |   |-- settings.jpg
   |   |-- icons
   |   |   |-- cart.png
   |   |   |-- comment.png
   |   |   |-- compound.png
   |   |   |-- cookies.png
   |   |   |-- download.png
   |   |   |-- order.png
   |   |   |-- rosemary_icon.svg
   |-- index.html
   |-- js
   |   |-- center.js
   |   |-- center.min.js
   |   |-- compound.js
   |   |-- compound.min.js
   |   |-- compound
   |   |   |-- form
   |   |   |   |-- insertComponent.js
   |   |   |   |-- insertComponent.min.js
   |   |   |   |-- insertTemplate.js
   |   |   |   |-- insertTemplate.min.js
   |   |   |   |-- props.js
   |   |   |   |-- props.min.js
   |   |   |   |-- propsTemplate.js
   |   |   |   |-- propsTemplate.min.js
   |   |-- org.app.js
   |   |-- org.app.js.map
   |   |-- org.app.min.js
   |   |-- woocommerceui_login.js
   |   |-- woocommerceui_login.min.js
   |   |-- woocommerceui_product.js
   |   |-- woocommerceui_product.min.js
   |   |-- woocommerceui_products.js
   |   |-- woocommerceui_products.min.js
   |   |-- woocommerceui_products.min.min.js
   |   |-- woocommerceui_recovery_password.js
   |   |-- woocommerceui_recovery_password.min.js
   |   |-- woocommerceui_signup.js
   |   |-- woocommerceui_signup.min.js
README.md
Route
   |-- axios
   |   |-- private
   |   |   |-- Compound-cloneTemplate.php
   |   |   |-- Compound-createPage.php
   |   |   |-- Compound-getMarkup.php
   |   |   |-- Compound-getPage.php
   |   |   |-- Compound-getProps.php
   |   |   |-- Compound-getTemplateProps.php
   |   |   |-- Compound-insertComponent.php
   |   |   |-- Compound-insertTemplate.php
   |   |   |-- Compound-removeTemplate.php
   |   |   |-- Compound-sortOrder.php
   |   |   |-- Compound-updatePage.php
   |   |   |-- Compound-updateProps.php
   |   |   |-- Compound-updateTemplateProps.php
   |   |-- public
   |   |   |-- HTTP.php
   |   |   |-- WCAddToCart.php
   |   |   |-- login.php
   |   |   |-- namespaces.php
   |   |   |-- options.php
   |   |   |-- product.php
   |   |   |-- recoveryPassword.php
   |   |   |-- saveOption.php
   |   |   |-- signup.php
Router.yaml
TODO.todo
archive-product.php
buddypress
   |-- activity
   |   |-- activity-loop.php
   |   |-- comment.php
   |   |-- entry.php
   |   |-- index.php
   |   |-- post-form.php
   |   |-- single
   |   |   |-- home.php
   |-- assets
   |   |-- _attachments
   |   |   |-- avatars
   |   |   |   |-- camera.php
   |   |   |   |-- crop.php
   |   |   |   |-- index.php
   |   |   |-- cover-images
   |   |   |   |-- index.php
   |   |   |-- uploader.php
   |   |-- emails
   |   |   |-- single-bp-email.php
   |   |-- embeds
   |   |   |-- activity.php
   |   |   |-- footer.php
   |   |   |-- header-activity.php
   |   |   |-- header.php
   |-- blogs
   |   |-- blogs-loop.php
   |   |-- create.php
   |   |-- index.php
   |-- common
   |   |-- search
   |   |   |-- dir-search-form.php
   |-- groups
   |   |-- create.php
   |   |-- groups-loop.php
   |   |-- index.php
   |   |-- single
   |   |   |-- activity.php
   |   |   |-- admin.php
   |   |   |-- admin
   |   |   |   |-- delete-group.php
   |   |   |   |-- edit-details.php
   |   |   |   |-- group-avatar.php
   |   |   |   |-- group-cover-image.php
   |   |   |   |-- group-settings.php
   |   |   |   |-- manage-members.php
   |   |   |   |-- membership-requests.php
   |   |   |-- cover-image-header.php
   |   |   |-- group-header.php
   |   |   |-- home.php
   |   |   |-- invites-loop.php
   |   |   |-- members.php
   |   |   |-- plugins.php
   |   |   |-- request-membership.php
   |   |   |-- requests-loop.php
   |   |   |-- send-invites.php
   |-- members
   |   |-- activate.php
   |   |-- index.php
   |   |-- members-loop.php
   |   |-- register.php
   |   |-- single
   |   |   |-- activity.php
   |   |   |-- blogs.php
   |   |   |-- cover-image-header.php
   |   |   |-- friends.php
   |   |   |-- friends
   |   |   |   |-- requests.php
   |   |   |-- groups.php
   |   |   |-- groups
   |   |   |   |-- invites.php
   |   |   |-- home.php
   |   |   |-- member-header.php
   |   |   |-- messages.php
   |   |   |-- messages
   |   |   |   |-- compose.php
   |   |   |   |-- message.php
   |   |   |   |-- messages-loop.php
   |   |   |   |-- notices-loop.php
   |   |   |   |-- single.php
   |   |   |-- notifications.php
   |   |   |-- notifications
   |   |   |   |-- feedback-no-notifications.php
   |   |   |   |-- notifications-loop.php
   |   |   |   |-- read.php
   |   |   |   |-- unread.php
   |   |   |-- plugins.php
   |   |   |-- profile.php
   |   |   |-- profile
   |   |   |   |-- change-avatar.php
   |   |   |   |-- change-cover-image.php
   |   |   |   |-- edit.php
   |   |   |   |-- profile-loop.php
   |   |   |   |-- profile-wp.php
   |   |   |-- settings.php
   |   |   |-- settings
   |   |   |   |-- capabilities.php
   |   |   |   |-- data.php
   |   |   |   |-- delete-account.php
   |   |   |   |-- general.php
   |   |   |   |-- notifications.php
   |   |   |   |-- profile.php
canvas.php
composer.json
content-product.php
content-product_cat.php
content-single-product.php
content-widget-product.php
environment.php
footer.php
functions.php
header.php
index.php
meta.php
package-lock.json
page.php
postcss.config.js
project.json
screenshot.png
single-product.php
single.php
style.css
tree.md
tsconfig.json
woocommerce
   |-- cart
   |   |-- cart-empty.php
   |   |-- cart-shipping.php
   |   |-- cart-totals.php
   |   |-- cart.php
   |   |-- cross-sells.php
   |   |-- mini-cart.php
   |   |-- proceed-to-checkout-button.php
   |   |-- shipping-calculator.php
   |-- checkout
   |   |-- cart-errors.php
   |   |-- form-billing.php
   |   |-- form-checkout.php
   |   |-- form-coupon.php
   |   |-- form-login.php
   |   |-- form-pay.php
   |   |-- form-shipping.php
   |   |-- payment-method.php
   |   |-- payment.php
   |   |-- review-order.php
   |   |-- terms.php
   |   |-- thankyou.php
   |-- global
   |   |-- breadcrumb.php
   |   |-- form-login.php
   |   |-- quantity-input.php
   |   |-- sidebar.php
   |   |-- wrapper-end.php
   |   |-- wrapper-start.php
   |-- loop
   |   |-- add-to-cart.php
   |   |-- loop-end.php
   |   |-- loop-start.php
   |   |-- no-products-found.php
   |   |-- orderby.php
   |   |-- pagination.php
   |   |-- price.php
   |   |-- rating.php
   |   |-- result-count.php
   |   |-- sale-flash.php
   |-- notices
   |   |-- error.php
   |   |-- notice.php
   |   |-- success.php
   |-- single-product
   |   |-- related.php
```