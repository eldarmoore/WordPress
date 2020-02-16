<?php

function SendEmail($formdata)
{
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

    try {
        if (wp_mail($send_to, $subject, $message)) {
            wp_send_json_success('Email sent');
        } else {
            wp_send_json_error('Email error');
        }
    } catch (Exception $e) {
        wp_send_json_error($e->getMessage());
    }
}