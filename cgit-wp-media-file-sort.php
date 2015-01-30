<?php

/*

Plugin Name: Castlegate IT WP Media File Sort
Plugin URI: http://github.com/castlegateit/cgit-wp-media-file-sort
Description: Allow media library to be sorted by file name.
Version: 1.0
Author: Castlegate IT
Author URI: http://www.castlegateit.co.uk/
License: MIT

Based on <http://wordpress.stackexchange.com/questions/84030/add-file-name-column-to-media-library>
with modifications to avoid naming collisions.

*/

/**
 * Add column to media library
 */
function cgit_mfs_filename_column($cols) {
    $cols['filename'] = 'File name';
    return $cols;
}

/**
 * Display file names in column
 *
 * This function extracts the file name from the attachment URL because
 * WordPress stores the file URL, not the file name.
 */
function cgit_mfs_filename_value($column_name, $id) {
    $meta = wp_get_attachment_metadata($id);
    echo substr(strrchr($meta['file'], '/' ), 1);
}

/**
 * Allow sorting by file name column
 */
function cgit_mfs_filename_column_sortable($cols) {
    $cols['filename'] = 'name';
    return $cols;
}

/**
 * Add to init action
 */
function cgit_mfs_filename_action() {
    add_filter('manage_media_columns', 'cgit_mfs_filename_column');
    add_action('manage_media_custom_column', 'cgit_mfs_filename_value', 10, 2);
    add_filter('manage_upload_sortable_columns', 'cgit_mfs_filename_column_sortable');
}

add_action('admin_init', 'cgit_mfs_filename_action');
