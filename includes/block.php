<?php

/**
 * block.php – Manuelle Registrierung eines Blocks
 */

defined('ABSPATH') || exit;

function ud_register_blank_block() {
    register_block_type(__DIR__ . '/../block.json');

    /*
    register_block_type(__DIR__ . '/../block.json',[
        'render_callback' => 'mein_callback',
        ]
    );
    */
}

add_action('init', 'ud_register_blank_block');
