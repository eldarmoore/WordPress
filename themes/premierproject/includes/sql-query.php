<?php
$charset_collate = $wpdb->get_charset_collate();

$sql_create_contacts = "CREATE TABLE `{$wpdb->base_prefix}contacts` (
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL UNIQUE,
	phone VARCHAR(15) NOT NULL UNIQUE,
	PRIMARY KEY (`id`)
) $charset_collate;";