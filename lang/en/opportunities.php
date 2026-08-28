<?php

return [
    'title' => 'Opportunities',
    'create_title' => 'Create New Opportunity',
    'edit_title' => 'Edit Opportunity',
    'show_title' => 'Opportunity Details',

    'descriptions' => [
        'create' => 'Fill in the details below to publish a new volunteer opportunity.',
        'edit' => 'Update the details for ":title".',
        'show' => 'Viewing information for ":title".',
        'manage' => 'Manage all registered volunteer opportunities and their details.',
        'manager' => 'Manage volunteer opportunities belonging to your teams.',
        'browse' => 'Browse available volunteer opportunities and find activities to join.',
    ],

    'actions' => [
        'back' => 'Back to Opportunities',
        'create' => 'Create Opportunity',
        'edit' => 'Edit Opportunity',
        'update' => 'Update Opportunity',
        'delete' => 'Delete',
        'view' => 'View',
        'cancel' => 'Cancel',
        'save' => 'Save Opportunity',
        'apply' => 'Apply Now',
    ],

    'fields' => [
        'title' => 'Opportunity Title',
        'team' => 'Team',
        'type' => 'Opportunity Type',
        'status' => 'Status',
        'location' => 'Location',
        'start_date' => 'Start Date',
        'end_date' => 'End Date',
        'application_deadline' => 'Application Deadline',
        'required_volunteers' => 'Required Volunteers',
        'hours' => 'Hours',
        'description' => 'Description',
        'image' => 'Opportunity Image',
        'is_active' => 'Active Opportunity',
    ],

    'placeholders' => [
        'title' => 'e.g. Community Cleanup Initiative',
        'location' => 'e.g. Amman, Jordan or Online',
        'required_volunteers' => 'e.g. 10',
        'hours' => 'e.g. 20',
        'description' => 'Detailed description of the opportunity...',
        'select_team' => '-- Select Team --',
        'select_type' => '-- Select Type --',
        'select_status' => '-- Select Status --',
    ],

    'upload' => [
        'upload_file' => 'Upload a file',
        'upload_new_file' => 'Upload a new file',
        'file_types' => 'JPG, JPEG, PNG, WEBP up to 2MB',
        'current_image' => 'Current Image',
        'replace_image' => 'Upload a new file below to replace it.',
    ],

    'types' => [
        'onsite' => 'Onsite',
        'remote' => 'Remote',
        'hybrid' => 'Hybrid',
    ],

    'statuses' => [
        'draft' => 'Draft',
        'published' => 'Published',
        'closed' => 'Closed',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
    ],

    'misc' => [
        'not_available' => 'N/A',
        'active_status' => 'Active Status',
        'active' => 'Active',
        'inactive' => 'Inactive',
        'created' => 'Created',
        'updated' => 'Updated',
        'hours_suffix' => 'Hours',
        'actions' => 'Actions',
        'active_description' => 'Keep this opportunity available and visible in the system.',
    ],

    'empty' => [
        'no_description' => 'No description provided.',
        'no_opportunities' => 'No opportunities found.',
        'create_first' => 'Create your first volunteer opportunity to get started.',
        'no_active_opportunities' => 'There are currently no active opportunities available.',
    ],

    'application' => [
        'interested' => 'Interested in this opportunity?',
        'prompt' => 'Submit your application and become part of this volunteer opportunity.',
        'closed' => 'Applications are currently closed for this opportunity.',
    ],

    'messages' => [
        'delete_confirmation' => 'Are you sure you want to delete this opportunity?',
    ],

    'sections' => [
    'basic_information' => 'Basic Information',
    'schedule_capacity' => 'Schedule & Capacity',
    'description_media' => 'Description & Media',
    'availability' => 'Opportunity Status',
    'basic_information_description' => 'Define the main details of the volunteer opportunity.',
    'schedule_capacity_description' => 'Set the timing and volunteer capacity for this opportunity.',
    'description_media_description' => 'Add a clear description and an optional image.',
    ],  

    'messages' => [
    'correct_errors' => 'Please correct the errors below.',
    'review_fields' => 'Some fields need your attention before the opportunity can be created.',
    'active_help' => 'Keep this opportunity available and visible in the system.',
    ],
];