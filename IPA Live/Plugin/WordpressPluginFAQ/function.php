<?php

function order_notification() {
    if (!in_array('simple-custom-post-order/simple-custom-post-order.php', apply_filters('active_plugins', get_option('active_plugins')))) {
        echo '<div class="updated notice">' .
            '<p>To sort the FAQs Donwload the following <a href="https://wordpress.org/plugins/simple-custom-post-order/">Plug-In</a></p>' .
            '</div>';
    }
}

function faq_title() {
    echo '<h1 class="title">FAQs</h1>' .
        '<div class="flex-container">';
    }

function faq_table($myposts, $question, $answer, $author) {

    $question = get_field("question");
    $answer = get_field("answer");
    $author = get_field("author");


    echo '<div class="sep">' .
        '<table style="text-align: center;" class="border">' .
        '<td>' .
        '<tr>';

    if (is_string($question) && strlen($question) && is_string($answer) && strlen($answer) || is_array($answer) || !is_null($answer)) {
        echo '<div class="question">' .
            $question .
            '</div>' .
            $answer .
            '<br>';
    }

    echo '</tr>' .
        '<tr>';

    faq_thumbnail();

    echo '</tr>' .
        '<tr>';

    faq_author($author);

    echo '</tr>' .
        '</td>' .
        '</table>' .
        '</div>';
}




function faq_thumbnail() {
    if ( has_post_thumbnail() ) {
        echo '<div class="thumbnail">';
        the_post_thumbnail( 'thumbnail' );
        echo '</div>';
    }
}

function change_lang() {
    if (function_exists('pll_the_languages')) {

        pll_the_languages(array('dropdown' => 1, 'show_flags' => 1, 'show_names' => 1, 'hide_if_empty', 'hide_if_no_translation'));

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
