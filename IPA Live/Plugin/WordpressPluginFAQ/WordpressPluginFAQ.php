<?php

/**
 * Plugin Name: WordpressPluginFAQ
 * Plugin URI:
 * Description: This Plugin was created during my IPA
 * Version: 0.1
 * Author: Nicolas Lars Friedrich Suter
 * Author URI: http://www.onebyte.ch/
 */
add_action('init', 'create_faq_post_type');
function create_faq_post_type() {
    if (current_user_can('administrator') || current_user_can('editor')) {
        register_post_type('faq',
            array(
                'labels' => array(
                    'name' => __('FAQ'),
                    'singular_name' => __('FAQ'),
                    'add_new' => __('Add new FAQ'),
                    'add_new_item' => __( 'Add New FAQ'),
                    'edit_item' => __('Edit FAQ'),
                    'all_items' => __('Overview'),
                    'view_item' => __('View FAQs'),
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


add_action( 'init', 'create_faq_category' );
function create_faq_category() {
    register_taxonomy(
        'faq-category',
        'faq',
        array(
            'label'             => __( 'FAQ-Categorys' ),
            'rewrite'           => array( 'slug' => 'faq-category' ),
            'hierarchical'      => true,
        )
    );
}


if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_5ea922b5c5d52',
        'title' => 'FAQ',
        'fields' => array(
            array(
                'key' => 'field_5ea92305514e5',
                'label' => 'Question',
                'name' => 'question',
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
                'label' => 'answer',
                'name' => 'answer',
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
                'label' => 'Author',
                'name' => 'author',
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
                    'value' => 'post',
                ),
            ),
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
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