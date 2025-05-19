<?php
/**
 * block.php – Manuelle Registrierung eines Blocks
 *
 * Nur notwendig, wenn keine Registrierung über block.json erfolgt.
 * Hier wird register_block_type() mit eigener Konfiguration verwendet.
 */

defined('ABSPATH') || exit;
/*
function ud_register_blank_block() {
    register_block_type('ud/blank-plugin', [
        'editor_script'   => 'ud-block-editor',
        'editor_style'    => 'ud-block-editor-style',
        'style'           => 'ud-block-style',
        'script'          => 'ud-block-frontend', // optional, z. B. für JS im Frontend
        'render_callback' => null, // nur bei dynamischen Blöcken nötig
        'attributes'      => [],
        'supports'        => [
            'className' => true,
        ],
    ]);
}
add_action('init', 'ud_register_blank_block');
*/