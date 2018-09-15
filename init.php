<?php
/*
Plugin Name: Students
Description: This is demo CRUD in WP
Version: 1
*/
// function to create the DB / Options / Defaults					
function ss_options_install() {

    global $wpdb;

	$table_name = $wpdb->prefix . "student";
	
    $sql = "CREATE TABLE " . $table_name . " (
		id int(11) NOT NULL AUTO_INCREMENT,
		name VARCHAR (50) NOT NULL,
		email VARCHAR(100) NOT NULL,
		PRIMARY KEY  (id)
	  );";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}

// run the install scripts upon plugin activation
register_activation_hook(__FILE__, 'ss_options_install');

//menu items
add_action('admin_menu','sinetiks_students_modifymenu');
function sinetiks_students_modifymenu() {
	
	//this is the main item for the menu
	add_menu_page('Students', //page title
	'Students', //menu title
	'manage_options', //capabilities
	'sinetiks_students_list', //menu slug
	'sinetiks_students_list' //function
	);
	
	//this is a submenu
	add_submenu_page('sinetiks_students_list', //parent slug
	'Add New Student', //page title
	'Add New', //menu title
	'manage_options', //capability
	'sinetiks_students_create', //menu slug
	'sinetiks_students_create'); //function
	
}
define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'src/students-list.php');
require_once(ROOTDIR . 'src/students-create.php');
require_once(ROOTDIR . 'src/students-update.php');
