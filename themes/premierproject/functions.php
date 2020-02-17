<?php

get_template_part('includes/load', 'assets');

get_template_part('includes/send', 'email');

function ValidatePhone($phone){
    if(preg_match('/^\+[0-9]{1,2}-[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $phone)) {
        return true;
    }else{
        return false;
    }
}

function ValidateName($name)
{
    if(!preg_match('/^[a-z]*$/i', $name)){
        return true;
    } else {
        return false;
    }
}

// If Logged in
add_action('wp_ajax_enquiry', 'enquiry_form');

// If not logged in
add_action('wp_ajax_nopriv_enquiry', 'enquiry_form');

function enquiry_form()
{

    $formdata = [];

    wp_parse_str($_POST['enquiry'], $formdata);

    // sanitize form values
    $formdata['name'] = ValidateName($formdata['name']);
    $formdata['email'] = sanitize_email($formdata['email']);
    $formdata['name'] = ValidatePhone($formdata['phone']);

    // Send Email
    SendEmail($formdata);

}