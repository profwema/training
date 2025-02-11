<?php
//at moodle how to insert a user if not exist and enroll him in a course and group in Moodle using PHP

// Include Moodle configuration
require_once('config.php');

// Include necessary Moodle core files
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->libdir . '/filelib.php');
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . '/user/lib.php');
require_once($CFG->dirroot . '/enrol/locallib.php');
require_once($CFG->dirroot . '/group/lib.php');

// Set up necessary parameters
$username = 'newuser'; // Replace with the desired username
$password = 'password123'; // Replace with the desired password
$firstname = 'New';
$lastname = 'User';
$email = 'newuser@example.com';
$courseId = 1; // Replace with the ID of the desired course
$groupId = 2; // Replace with the ID of the desired group

// Check if the user already exists
if ($existinguser = $DB->get_record('user', array('username' => $username))) {
    $userId = $existinguser->id;
} else {
    // Create a new user
    $user = new stdClass();
    $user->username = $username;
    $user->password = hash_internal_user_password($password);
    $user->firstname = $firstname;
    $user->lastname = $lastname;
    $user->email = $email;
    $user->id = user_create_user($user);
    $userId = $user->id;
}

// Check for capabilities
if (!has_capability('moodle/course:enrolconfig', context_system::instance())) {
    print_error('errornothaveenrolconfig', 'error');
}

// Enroll the user in the course
$enrol = enrol_get_plugin('manual');
$enrolinstance = enrol_get_instance($courseId, $enrol->get_internal_name());
$enrolinstance->enrol_user($enrolinstance, $userId);

// Add the user to the group
groups_add_member($groupId, $userId);

// Output success message
echo 'User inserted/enrolled in the course and added to the group successfully.';


//at moodle how to auto login and go to certun link?

// Include Moodle configuration
require_once('config.php');

// Set up necessary parameters
$username = 'existing_user'; // Replace with the existing username
$password = 'Asd@203112564';
$redirectUrl = 'http://your-moodle-site.com/course/view.php?id=1'; // Replace with the desired link

// Authenticate the user
$auth = authenticate_user_login($username, $password);

if ($auth === true) {
    // User authentication successful
    complete_user_login($user = get_complete_user_data('username', $username));

    // Redirect the user to the desired link
    redirect($redirectUrl);
} else {
    // Authentication failed
    echo 'Authentication failed.';
}



//moodle module to add category and determine perant category by external php

// Include Moodle configuration

require_once('config.php');

// Include necessary Moodle core files
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->libdir . '/filelib.php');
require_once($CFG->dirroot . '/course/lib.php');

// Set up necessary parameters
$category = new stdClass();
$category->name = 'Your Category Name';
$category->description = 'Your category description';
$category->descriptionformat = FORMAT_HTML;

// Determine the parent category ID (set to 0 for a top-level category)
$parentCategoryID = 1; // Change this to the ID of the desired parent category

// Check for capabilities
if (!has_capability('moodle/course:create', context_system::instance())) {
    print_error('errornothavecreatecategory', 'error');
}

// Add the category
$categoryid = coursecat::create($category, $parentCategoryID);

// Output success message
echo 'Category added successfully. Category ID: ' . $categoryid;