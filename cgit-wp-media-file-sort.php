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
 * Add to init action
 */
add_action('admin_init', function() {

    // Add column to media library
    add_filter('manage_media_columns', function($cols) {
        $cols['filename'] = 'File name';
        return $cols;
    });

    // Display file names in column
    //
    // WordPress stores the file URL, not the file name
    add_action('manage_media_custom_column', function($column_name, $id) {
        $meta = wp_get_attachment_metadata($id);
        echo substr(strrchr($meta['file'], '/' ), 1);
    }, 10, 2);

    // Allow sorting by file name column
    add_filter('manage_upload_sortable_columns', function($cols) {
        $cols['filename'] = 'name';
        return $cols;
    });
});
