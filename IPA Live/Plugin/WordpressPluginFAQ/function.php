<?php

function order_notification() {
    if (!in_array('simple-custom-post-order/simple-custom-post-order.php', apply_filters('active_plugins', get_option('active_plugins')))) {
        echo '<div class="updated notice">' .
            '<p>To sort the FAQs Donwload the following <a href="https://wordpress.org/plugins/simple-custom-post-order/">Plug-In</a></p>' .
            '</div>';
    }
}

function faq_title() {
    echo '<h1 class="title">FAQs</h1>'.
        '<div class="flex-container">';
}

function faq_thumbnail() {
    if ( has_post_thumbnail() ) {
        echo '<div class="thumbnail">';
        the_post_thumbnail( 'thumbnail' );
        echo '</div>';
    }
}

function faq_author($author) {
    if ( get_field('author') ) {
        echo '<div class="author">' .
            'Author: ' .
            $author .
            '</div>';

    } else {

        echo '<div class="author">' .
            'Author: ' .
            get_the_author_meta('display_name') .
            '</div>';
    }
}
