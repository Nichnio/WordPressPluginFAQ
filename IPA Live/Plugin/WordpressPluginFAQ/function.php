<?php

// If the Plug-In to order your Faqs is not installed show notification
// WordPress function apply_filters https://developer.wordpress.org/reference/functions/apply_filters/
function order_notification() {
    if (in_array('simple-custom-post-order/simple-custom-post-order.php', apply_filters('active_plugins', get_option('active_plugins')))) {
        echo '<div class="updated notice">' .
            '<p>Um die FAQs zu Sortieren, laden Sie folgendes <a href="https://wordpress.org/plugins/simple-custom-post-order/" target="_blank">Plug-In</a> herunter.</p>' .
            '</div>';
    }
}

// Title for Faq Pages
function faq_title() {
    echo '<h1 class="title">FAQs</h1>' .
        '<div class="flex-container">';
}

// Display Table for Faq
function faq_table($new_posts, $question, $answer, $author) {

    $question = get_field("frage");
    $answer = get_field("antwort");
    $author = get_field("autor");


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
    } else {
        echo '<div class="question">' .
            'Leider sind die Angaben nicht korrekt eingetragen. Bitte versuchen Sie es erneut.' .
            '</div><br>';
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

// Display thumbnail if existent from featured image WordPress
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

// Display author name if exists else display wordpress user name
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

