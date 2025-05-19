<?php
/*
 * Lädt JS und CSS für Editor und Frontend.
 *
 * Wird verwendet, wenn keine automatische Einbindung über block.json erfolgt.
 * - Lädt editor.js und editor.css im Block-Editor
 * - Lädt frontend.js und frontend-style.css im öffentlichen Bereich
 */

defined('ABSPATH') || exit;

// Editor-Assets (nur im Gutenberg-Editor)
add_action('enqueue_block_editor_assets', function () {
    $base = plugin_dir_url(__DIR__);
    $path = plugin_dir_path(__DIR__);

    // Wenn block.json vorhanden ist, nicht nötig
    /*
    wp_enqueue_script(
        'ud-block-editor',
        $base . 'build/editor.js',
        ['wp-blocks', 'wp-element', 'wp-editor', 'wp-components'],
        filemtime($path . 'build/editor.js'),
        true
    );

    wp_enqueue_style(
        'ud-block-editor-style',
        $base . 'build/editor.css',
        [],
        filemtime($path . 'build/editor.css')
    );
    */
});

// Frontend-Assets (nur im öffentlichen Bereich)
add_action('wp_enqueue_scripts', function () {
    $base = plugin_dir_url(__DIR__);
    $path = plugin_dir_path(__DIR__);

    // Zustätzliche js-Bibliotheken laden z. B. Isotope aus /src/js/libs/
    // wp_enqueue_script('isotope', $base . 'src/js/libs/isotope.pkgd.min.js', [], null, true);

    // Wenn block.json vorhanden ist, nicht nötig
    /*
    wp_enqueue_script(
        'ud-block-frontend',
        $base . 'build/frontend.js',
        [],
        filemtime($path . 'build/frontend.js'),
        true
    );

    wp_enqueue_style(
        'ud-block-style',
        $base . 'build/frontend-style.css',
        [],
        filemtime($path . 'build/frontend-style.css')
    );
 */
});
