# UD Plugin Blank

Minimalistisches Starter-Plugin für Gutenberg-Blockentwicklung mit WordPress.  
Ziel: **klare Trennung von Build-Assets, PHP-Logik und Block-Konfiguration** – ohne Ballast, aber vollständig funktionsfähig.

<pre>
ud-loop/
├── .gitattributes            → Git-Attribute, z. B. für Zeilenenden
├── .gitignore                → Ignoriert z. B. node_modules, build/, ZIPs
├── README.md                 → Projektbeschreibung & Setup-Hinweise

├── block.json                → Block-Metadaten: Name, Scripts, Styles, Attribute

├── assets/                   → Statische Dateien (Fonts, Bilder, Icons – nicht gebundelt)

├── includes/                 → PHP-Logik (modular aufgeteilt)
│   ├── api.php               → REST-API-Endpunkte (z. B. für Seiten mit Kindern)
│   ├── block.php             → Block-Registrierung inkl. Custom Styles
│   ├── enqueue.php           → Lädt JS fürs Frontend (Isotope, frontend.js)
│   ├── helpers.php           → Kontextvererbung, Blockanalyse, Teaser-Erkennung
│   └── render.php            → Dynamische Render-Logik mit WP_Query + HTML-Ausgabe

├── package.json              → NPM-Konfiguration mit Build-/Start-Skripten

├── src/                      → Quellverzeichnis für Build (JS + CSS)
│   ├── css/
│   │   ├── editor.scss       → Gutenberg-spezifisches Styling
│   │   └── frontend.scss     → Styles für die Ausgabe im Frontend
│   ├── js/
│   │   ├── editor.js         → Block-Definition (registerBlockType etc.)
│   │   ├── frontend.js       → JS fürs Frontend (z. B. Breakpoints)
│   │   ├── libs/             → Externe Bibliotheken (z. B. Isotope – nicht gebundelt)
│   │   └── utils/            → Eigene JS-Helferfunktionen (optional)

├── ud-loop.php               → Plugin-Hauptdatei, lädt alle includes/*
├── webpack.config.js         → Erweiterung der Standard-Build-Konfiguration
*/
</pre>

## 🧱 Zusammenspiel: Build-System & Plugin-Core
<pre> 
+--------------------------------------------+
| package.json                               |
| Herzstück der JavaScript-Toolchain         |
| - steuert den gesamten Build-Prozess       |
+--------------------------------------------+
              |
              v
+--------------------------------------------+
| webpack.config.js                          |
| Herzstück des Asset-Buildings              |
| - definiert, wie Code & Styles zu          |
|   finalen Dateien verarbeitet werden       |
+--------------------------------------------+
              |
              v
+--------------------------------------------+
| block.json                                 |
| Block-Beschreibung für WordPress           |
| - definiert Name, Verhalten, Assets, etc.  |
| - Bindeglied zwischen JS, CSS und PHP      |
+--------------------------------------------+
              |
              v
+--------------------------------------------+
| ud-plugin-blank.php                        |
| Plugin-Initialisierung                     |
| Einstiegsdatei für WordPress               |
| - registriert Block via block.json         |
| - lädt PHP-Logik (render.php, enqueue.php) |
+--------------------------------------------+
</pre>

## 1. package.json
Muss in den scripts-Einträgen (build, start) explizit auf webpack.config.js verweisen:
<pre>
"scripts": {
  "build": "webpack --config webpack.config.js",
  "start": "webpack --watch --config webpack.config.js"
}
</pre>

## 2. webpack.config.js
<strong>Funktioniert nur, wenn Webpack (z. B. über `@wordpress/scripts`) in der `package.json` installiert ist.</strong>

* In `entry` stehen **auch `.scss`-Dateien** – das ist normal.
* Sie werden **trotzdem zu `.css` kompiliert**, nicht zu `.js`.

* Beispiel:
```js
  entry: {
    editor: "src/js/editor.js",
    "editor-style": "src/css/editor.scss"
  }
```

* Im Output entstehen:

  * `build/editor.js`
  * `build/editor-style.css`


## 3. block.json
Muss exakt dieselben Pfade zu JS/CSS referenzieren, die Webpack erzeugt (build/editor.js, etc.).

Beispiel:
```js
    "editorStyle": "file:./build/editor.css",
    "style": "file:./build/frontend.css",
    "editorScript": "file:./build/editor.js",
    "script": "file:./build/frontend.js",
```

## 4. ud-plugin-blank.php
Diese Datei ist der Einstiegspunkt des Plugins und wird von WordPress geladen.  
Sie selbst registriert keinen Block, sondern lädt alle Dateien im `includes/`-Ordner.
