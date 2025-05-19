<?php
/**
 * Plugin Name:       UD Blank Plugin
 * Description:       Starter-Plugin für WordPress-Plugin-Entwicklung.
 * Version:           1.0.0
 * Author:            ulrich.digital
 * Author URI:        https://ulrich.digital/
 * License:           GPL-2.0-or-later
 * Text Domain:       ud-plugin-blank
 */

defined('ABSPATH') || exit;

/**
 * Hinweis:
 * Diese Datei dient ausschliesslich als Einstiegspunkt für das Plugin.
 */

// Alle PHP-Dateien im includes/-Ordner laden
foreach (glob(__DIR__ . '/includes/*.php') as $file) {
    require_once $file;
}
