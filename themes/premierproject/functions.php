<?php

get_template_part('includes/load', 'assets');

get_template_part('includes/send', 'email');

// If Logged in
add_action('wp_ajax_enquiry', 'enquiry_form');

// If not logged in
add_action('wp_ajax_nopriv_enquiry', 'enquiry_form');

function enquiry_form()
{

    $formdata = [];

    wp_parse_str($_POST['enquiry'], $formdata);

    // Send Email
    SendEmail($formdata);

}