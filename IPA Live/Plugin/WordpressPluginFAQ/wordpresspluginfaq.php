<?php

/**
 * Plugin Name: WordpressPluginFAQ
 * Plugin URI:
 * Description: This Plugin was created during my IPA
 * Version: 0.1
 * Author: Nicolas Lars Friedrich Suter
 * Author URI: http://www.onebyte.ch/
 * Text Domain: WordpressPluginFAQ
 * Domain Path: /languages/
 */

// Ist wordpress geladen? Um zu verhindern Php direkt aufruf

defined( 'ABSPATH' ) or die;

//Andere bekannte Plugins ansehen






// The following code is copied with little adjustments from the URL below.
// URL: https://www.advancedcustomfields.com/resources/including-acf-within-a-plugin-or-theme/

// Checks if a class is defined
if( !class_exists('acf')) {
// Define path and URL to the ACF plugin.
    define('MY_ACF_PATH', dirname(__FILE__) . '/includes/acf/');
    define( 'MY_ACF_URL', get_stylesheet_directory_uri() . '/includes/acf/' );

// Include the ACF plugin.
    include_once(MY_ACF_PATH . 'acf.php');

// Customize the url setting to fix incorrect asset URLs.
    add_filter('acf/settings/url', 'my_acf_settings_url');
    function my_acf_settings_url($url)
    {
        return MY_ACF_URL;
    }
    /*
    //  Hide the ACF admin menu item.
        add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
        function my_acf_settings_show_admin($show_admin)
        {
            return false;
        }*/
}

// Executes after WordPress has finished loading (before headers are sent)
/*
 *
 * Coming soon
 *
 */
add_action('init', 'create_faq_post_type');
function create_faq_post_type() {
    // WordPress function (If current user is administrator or editor)
    if (current_user_can('administrator') || current_user_can('editor')) {
        register_post_type('faq',
            array(
                'labels' => array(
                    'name' => __('FAQ'),
                    'singular_name' => __('FAQ'),
                    'add_new' => __('Neues FAQ hinzufügen'),
                    'add_new_item' => __( 'Neues FAQ hinzufügen'),
                    'edit_item' => __('FAQ bearbeiten'),
                    'all_items' => __('Übersicht'),
                    'view_item' => __('Ansehen der FAQs'),
                    'search_items' => __('Nach FAQs Suchen'),
                    'add_theme_support' => __('post-thumbnails'),
                ),
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'has_archive' => true,
                'hierarchical' => false,
                'capability_type' => __('post'),
                'taxonomies' => array('faq'),
                'public'    => true,
                'rewrite' => array('slug' => 'faq'),
                'supports' => array('title', 'editor', 'thumbnail')
            )
        );
    }
}

// Create categories
add_action( 'init', 'create_faq_category' );
function create_faq_category() {
    register_taxonomy(
        'faq-kategorien',
        'faq',
        array(
            'label'             => __( 'FAQ-Kategorien'),
            'add_new'           => __('Neue FAQ Kategorie hinzufügen'),
            'add_new_item'      => __( 'Neue FAQ Kategorie hinzufügen'),
            'rewrite'           => array( 'slug' => 'faq-kategorien' ),
            'hierarchical'      => true,
        )
    );
}

// Checks if acf is installed
if( function_exists('acf_add_local_field_group') ):
    //Should add fieldgroup
    acf_add_local_field_group(array(
        'key' => 'group_5ea922b5c5d52',
        'title' => 'FAQ',
        'fields' => array(
            array(
                'key' => 'field_5ea92305514e5',
                'label' => 'Frage',
                'name' => 'frage',
                'type' => 'text',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_5ea92383514e6',
                'label' => 'Antwort',
                'name' => 'antwort',
                'type' => 'text',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_5ea9239c514e7',
                'label' => 'Autor',
                'name' => 'autor',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'faq',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

endif;


include 'shortcode.php';

//include 'register_lang.php';
