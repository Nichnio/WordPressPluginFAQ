<?php
include 'css.php'; // Inluding the CSS File
include 'function.php';

add_action( 'init', function () {
    remove_post_type_support( 'faq', 'editor' );
    add_shortcode( 'faq', function ( $atts ) {

        $args = array(
            'post_type'      => 'faq', // Custom post type Name
            'order_by'       => 'date', // How to Order. date
            'order'          => 'ASC', // Ascending
            'nopaging'       => true,
        );

        faq_title();

        $new_query = new WP_Query ( $args );
        if ( $new_query->have_posts() ) { // If there are Posts
            while ( $new_query->have_posts() ) { // While there are Posts
                $new_query->the_post();

                faq_table( $myposts, $question, $answer, $author);

            }
        }
    } );
} );

order_notification();

// Shortcode
function shortcode_faq( $atts ) {


    change_lang();

    faq_title();


        extract(shortcode_atts(array(
            'class_name'    => 'cat-post',
            'totalposts'    => '-1',
            'category'      => '',
            'thumbnail'     => 'false',
            'excerpt'       => 'true',
            'orderby'       => 'post_date'
        ), $atts));


        $args = array(
            'nopaging'       => true,
            'orderby' => $orderby,
            'post_type' => 'faq',
            'tax_query' => array(
                array(
                    'taxonomy' => 'faq-category',
                    'field' => 'slug',
                    'terms' => array($category)
                )
            ));
        $myposts = NEW WP_Query($args);

    while($myposts->have_posts()) {
        $myposts->the_post();
        faq_table($myposts, $question, $answer, $author);
    }
    add_shortcode('faq-category', 'cat_func');
}
add_shortcode( 'faq-category', 'shortcode_faq' );



if ( function_exists( 'pll_register_string' ) ) {
    include 'register_lang.php';
    register_question();
}