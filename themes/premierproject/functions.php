<?php

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

get_template_part('includes/load', 'assets');

get_template_part('includes/sql', 'query');


// Create Table if not exist.
maybe_create_table('wp_contacts', $sql_create_contacts);

// If Logged in
add_action('wp_ajax_enquiry', 'enquiry_form');

// If not logged in
add_action('wp_ajax_nopriv_enquiry', 'enquiry_form');

function enquiry_form()
{
    $formdata = [];

    wp_parse_str($_POST['enquiry'], $formdata);

    // Admin email.
    $admin_email = get_option('admin_email');

    // Email headers
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'From:' . $admin_email;
    $headers[] = 'Reply-to:' . $formdata['email'];

    // Who are we sending the email to?
    $send_to = $admin_email;

    // Subject
    $subject = "Enquiry from " . $formdata['name'];

    // Message
    $message = "Enquiry from: " . $formdata['name'] . ', email: ' . $formdata['email'] . ', phone:' . $formdata['phone'];

    global $wpdb;

    $data_array = array(
        'name'  => $formdata['name'],
        'email' => $formdata['email'],
        'phone' => $formdata['phone'],
    );

    $table_name = 'wp_contacts';
    try {
        if ($wpdb->insert($table_name, $data_array, $format = NULL) && wp_mail($send_to, $subject, $message)) {
            wp_send_json_success('Data is stored and Mail was sent to the Administrator');
        } else {
            wp_send_json_error('There is an error!');
        }
    } catch (Exception $e) {
        wp_send_json_error($e->getMessage());
    }

}