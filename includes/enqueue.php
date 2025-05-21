<?php
/*
 * Lädt JS und CSS für Editor und Frontend 
 * - wenn keine automatische Einbindung über block.json erfolgt.
 */

defined('ABSPATH') || exit;

// Editor-Assets
add_action('enqueue_block_editor_assets', function () {
    $base = plugin_dir_url(__DIR__);
    $path = plugin_dir_path(__DIR__);

    // Wenn block.json vorhanden ist, nicht nötig
    /*
    wp_enqueue_script(
        'ud-block-editor-script',
        $base . 'build/editor-script.js',
        ['wp-blocks', 'wp-element', 'wp-editor', 'wp-components'],
        filemtime($path . 'build/editor-script.js'),
        true
    );

    wp_enqueue_style(
        'ud-block-editor-style',
        $base . 'build/editor-style.css',
        [],
        filemtime($path . 'build/editor-style.css')
    );
    */
});

// Frontend-Assets 
add_action('wp_enqueue_scripts', function () {
    $base = plugin_dir_url(__DIR__);
    $path = plugin_dir_path(__DIR__);

    // Zustätzliche js-Bibliotheken laden z. B. Isotope aus /src/js/libs/
    // wp_enqueue_script('isotope', $base . 'src/js/libs/isotope.pkgd.min.js', [], null, true);

    // Wenn block.json vorhanden ist, nicht nötig
    /*
    wp_enqueue_script(
        'ud-block-frontend-script',
        $base . 'build/frontend-script.js',
        [],
        filemtime($path . 'build/frontend-script.js'),
        true
    );

    wp_enqueue_style(
        'ud-block-fronten-style',
        $base . 'build/frontend-style.css',
        [],
        filemtime($path . 'build/frontend-style.css')
    );
 */
});
