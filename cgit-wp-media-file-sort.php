<?php

/*

Plugin Name: Castlegate IT WP Media File Sort
Plugin URI: http://github.com/castlegateit/cgit-wp-media-file-sort
Description: Allow media library to be sorted by file name.
Version: 1.1
Author: Castlegate IT
Author URI: http://www.castlegateit.co.uk/
License: AGPLv3

*/

if (!defined('ABSPATH')) {
    wp_die('Access denied');
}

/** Add column to media library */
add_filter('manage_media_columns', function ($columns) {
    $columns['file_name'] = 'File name';

    return $columns;
});

/** Display file names in new media library column */
add_action('manage_media_custom_column', function ($name, $id) {
    $meta = wp_get_attachment_metadata($id);

    echo basename($meta['file']);
}, 10, 2);

/** Enable columns to be sorted by file name */
add_filter('manage_upload_sortable_columns', function ($columns) {
    $columns['file_name'] = 'name';

    return $columns;
});
